<?php 
include "conexion.php";
include "validar.php";

$conexion = OpenCon();
$modos["compra-azar"]="SELECT * FROM propiedades WHERE venta!=0 AND activa=1 ORDER BY RAND() LIMIT 9";
$modos["alquiler-azar"]="SELECT * FROM propiedades WHERE alquiler!=0 AND activa=1 ORDER BY RAND() LIMIT 9";
$modos["azar"]="SELECT * FROM propiedades WHERE activa=1 ORDER BY RAND() LIMIT 9";

if($conexion)
{
    if(isset($_GET["mode"]))
    {

        $resultado = $conexion->query($modos[$_GET["mode"]]);
        $i=0;
        while($entrada = $resultado->fetch_assoc())
        {
            $entradas[$i]=$entrada;
            $i++;
        }
    
        $out = json_encode($entradas);
    
        echo $out;
    }

    $conexion->close();
}
else
{
    echo "Error de conexion";
}




?>