<?php 
session_start();
include "conexion.php";
include "validar.php";

$conexion = OpenCon();
$modos["autor"]=array("inmobiliaria"=>'autor=\'inmobiliaria\'',"propietario"=>'autor=\'propietario\'',"miba"=>'autor=\'miba\'');
if(isset($_SESSION["id_usuario"]))
{
    $modos["autor"]["usuario"]='id_usuario='.$_SESSION["id_usuario"];
}
$modos["antiguedad"]=array("10"=>'antiguedad<=10',"50"=>'antiguedad<=50',"100"=>'antiguedad<=100',"150"=>'antiguedad<=150',"200"=>'antiguedad>=150');
$modos["certificacion"]=array("miba"=>'certificada=1');
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
$modos["azar"]="SELECT * FROM propiedades WHERE activa=1 ORDER BY RAND() LIMIT 12";
$modos["barrio"]=array("ninguno"=>"TRUE",
"Agronomía"=>'barrio=\'Agronomía\'',
"Almagro"=>'barrio=\'Almagro\'',
"Balvanera"=>'barrio=\'Balvanera\'',
"Barracas"=>'barrio=\'Barracas\'',
"Belgrano"=>'barrio=\'Belgrano\'',
"Boedo"=>'barrio=\'Boedo\'',
"Caballito"=>'barrio=\'Caballito\'',
"Chacarita"=>'barrio=\'Chacarita\'',
"Coghlan"=>'barrio=\'Coghlan\'',
"Colegiales"=>'barrio=\'Colegiales\'',
"Constitución"=>'barrio=\'Constitución\'',
"Flores"=>'barrio=\'Flores\'',
"Floresta"=>'barrio=\'Floresta\'',
"La Boca"=>'barrio=\'La Boca\'',
"La Paternal"=>'barrio=\'La Paternal\'',
"Liniers"=>'barrio=\'Liniers\'',
"Mataderos"=>'barrio=\'Mataderos\'',
"Monte Castro"=>'barrio=\'Monte Castro\'',
"Montserrat"=>'barrio=\'Montserrat\'',
"Nueva Pompeya"=>'barrio=\'Nueva Pompeya\'',
"Nuñez"=>'barrio=\'Nuñez\'',
"Palermo"=>'barrio=\'Palermo\'',
"Parque Avellaneda"=>'barrio=\'Parque Avellaneda\'',
"Parque Chacabuco"=>'barrio=\'Parque Chacabuco\'',
"Parque Chas"=>'barrio=\'Parque Chas\'',
"Parque Patricios"=>'barrio=\'Parque Patricios\'',
"Puerto Madero"=>'barrio=\'Puerto Madero\'',
"Recoleta"=>'barrio=\'Recoleta\'',
"Retiro"=>'barrio=\'Retiro\'',
"Saavedra"=>'barrio=\'Saavedra\'',
"San Cristóbal"=>'barrio=\'San Cristóbal\'',
"San Nicolás"=>'barrio=\'San Nicolás\'',
"San Telmo"=>'barrio=\'San Telmo\'',
"Versalles"=>'barrio=\'Versalles\'',
"Villa Crespo"=>'barrio=\'Villa Crespo\'',
"Villa Devoto"=>'barrio=\'Villa Devoto\'',
"Villa General Mitre"=>'barrio=\'Villa General Mitre\'',
"Villa Lugano"=>'barrio=\'Villa Lugano\'',
"Villa Luro"=>'barrio=\'Villa Luro\'',
"Villa Ortúzar"=>'barrio=\'Villa Ortúzar\'',
"Villa Pueyrredón"=>'barrio=\'Villa Pueyrredón\'',
"Villa Real"=>'barrio=\'Villa Real\'',
"Villa Riachuelo"=>'barrio=\'Villa Riachuelo\'',
"Villa Santa Rita"=>'barrio=\'Villa Santa Rita\'',
"Villa Soldati"=>'barrio=\'Villa Soldati\'',
"Villa Urquiza"=>'barrio=\'Villa Urquiza\'',
"Villa del Parque"=>'barrio=\'Villa del Parque\'',
"Vélez Sarsfield"=>'barrio=\'Vélez Sarsfield\'',
);
if($conexion)
{
    if(isset($_GET["azar"]))
    {
        $resultado = $conexion->query($modos["azar"]);
    }else 
    {   $offset=0;
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
                if($txt[$j]=="-" AND $flag)
                {
                    $flag=FALSE;
                    continue;
                }
                if($flag)
                {
                    $cat.=$txt[$j];
                }else 
                {
                    $key.=$txt[$j];
                }
            }
            
            if($cat=="precio" OR $cat=="superficie" OR $cat=="supCubierta")
            {
                
                $min="";
                $max="";
                $flag=TRUE;
                for($j=0;$j<strlen($key);$j++)
                {
                    
                    if($key[$j]=="-" AND $flag)
                    {
                        $flag=FALSE;
                        continue;
                    }
                    if($flag)
                    {
                        $min.=$key[$j];
                    }else 
                    {
                        $max.=$key[$j];
                    }
                }
                
                if(validar($min,'precio'))
                {
                    $min="";
                }else if (validar($max,'precio'))
                {
                    $max="";
                }
                if($min=="" AND $max=="")
                {
                    $out="";
                }else if($cat=="precio")
                {

                    if($min=="")
                    {
                        $out="venta <=".$max;
                    }else if($max=="")
                    {
                        $out="venta >=".$min;
                    }else
                    {
                        $out="((venta BETWEEN ".$min." AND ".$max.") AND alquiler=0) OR ((alquiler BETWEEN ".$min." AND ".$max.") AND venta=0)";
                    }
                }else if($cat=="superficie")
                {
                    if($min=="")
                    {
                        $out="superficie <=".$max;
                    }else if($max=="")
                    {
                        $out="superficie >=".$min;
                    }else
                    {
                        $out="superficie BETWEEN ".$min." AND ".$max."";
                    }
                }else if($cat=="supCubierta")
                {
                    if($min=="")
                    {
                        $out="superficie_cubierta <=".$max;
                    }else if($max=="")
                    {
                        $out="superficie_cubierta >=".$min;
                    }else
                    {
                        $out="superficie_cubierta BETWEEN ".$min." AND ".$max."";
                    }
                }
                

                if($opciones=="")
                {
    
                    $opciones.=" ".$out." ";
                }else
                {
                    $opciones.=" AND ".$out;
                }
                
            }else if($cat=="pagina")
            {
                
                $offset=strval(12*(intval($key)-1));      
                         
            }else
            {

                if($opciones=="")
                {
    
                    $opciones.=" ".$modos[$cat][$key]." ";
                }else
                {
                    $opciones.=" AND ".$modos[$cat][$key];
                }
            }

            $i++;
        }
        

        if($opciones=="")
        {
            $resultado = $conexion->query("SELECT * FROM propiedades WHERE activa=1 ORDER BY id_prop LIMIT 12 OFFSET ".$offset);
        }else{

            $resultado = $conexion->query("SELECT * FROM propiedades WHERE ".$opciones." AND activa=1 ORDER BY id_prop LIMIT 12 OFFSET ".$offset);
        }

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