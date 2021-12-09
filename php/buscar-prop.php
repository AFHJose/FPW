<?php 
session_start();
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
$modos["barrio"]=array("ninguno"=>"",
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
            
            if($cat=="precio")
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
                }
                else if($min=="")
                {
                    $out="venta <=".$max;
                }else if($max=="")
                {
                    $out="venta >=".$min;
                }else
                {
                    $out="((venta BETWEEN ".$min." AND ".$max.") AND alquiler=0) OR ((alquiler BETWEEN ".$min." AND ".$max.") AND venta=0)";
                }
                

                if($opciones=="")
                {
    
                    $opciones.=" ".$out." ";
                }else
                {
                    $opciones.=" AND ".$out;
                }
                
            }else if($cat=="autor")
            {
                




                $out="";

                if($opciones=="")
                {
    
                    $opciones.=" ".$out." ";
                }else
                {
                    $opciones.=" AND ".$out;
                }




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