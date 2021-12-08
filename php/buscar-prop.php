<?php 
include "conexion.php";
include "validar.php";

$conexion = OpenCon();
$modos["tipo"]=array("compra"=>'venta!=0',"alquiler"=>'alquiler!=0');
$modos["inmueble"]=array("casa"=>'tipo=\'Casa\'',"departamento"=>'tipo=\'Departamento\'',"oficina"=>'tipo=\'Oficina\'',"cochera"=>'tipo=\'Cochera\'',"terreno"=>'tipo=\'Terreno\'');
$modos["moneda"]=array("pesos"=>'dolar=0',"dolares"=>'dolar=1');
$modos["ambientes"]=array("uno"=>'ambientes=1',"dos"=>'ambientes=2',"tres"=>'ambientes=3',"cuatro"=>'ambientes=4');
$modos["baños"]=array("uno"=>'baños=1',"dos"=>'baños=2',"tres"=>'baños=3');
$modos["aire"]=array("tiene"=>'aire=1');
$modos["balcon"]=array("tiene"=>'balcon=1');
$modos["pileta"]=array("tiene"=>'pileta=1');
$modos["jardin"]=array("tiene"=>'jardin=1');
$modos["gym"]=array("tiene"=>'gym=1');
$modos["estacionamiento"]=array("tiene"=>'estacionamiento=1');
$modos["azar"]="SELECT * FROM propiedades WHERE activa=1 ORDER BY RAND() LIMIT 9";

if($conexion)
{
    if(isset($_GET["azar"]))
    {
        $resultado = $conexion->query($modos["azar"]);
    }else 
    {
        $opciones="";
        $i=0;
        while(isset($_GET["opcion-".strval($i)]))
        {
            $txt=$_GET["opcion-".strval($i)];
            $cat="";
            $key="";
            $flag=TRUE;
            for($j=0;$j<strlen($txt);$j++)
            {
                if($txt[$j]=="-")
                {
                    $flag=FALSE;
                    $j++;
                }
                if($flag)
                {
                    $cat.=$txt[$j];
                }else 
                {
                    $key.=$txt[$j];
                }
            }
            if($opciones=="")
            {

                $opciones.=$modos[$cat][$key];
            }else
            {
                $opciones.=" AND ".$modos[$cat][$key];
            }

            $i++;
        }

        $resultado = $conexion->query("SELECT * FROM propiedades WHERE ".$opciones." AND activa=1 ORDER BY RAND() LIMIT 9");
        
        
    }


    $i=0;
    while($entrada = $resultado->fetch_assoc())
    {
        $entradas[$i]=$entrada;
        $i++;
    }
    if($i==0)
    {
        $out = "vacio";
    }else 
    {
        $out = json_encode($entradas);
    }

    echo $out;

    $conexion->close();
}
else
{
    echo "Error de conexion";
}




?>