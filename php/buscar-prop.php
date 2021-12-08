<?php 
include "conexion.php";
include "validar.php";

$conexion = OpenCon();

if($conexion)
{
    if($_GET["mode"]=="random")
    {

        $sql = "SELECT * FROM propiedades WHERE activa=1 ORDER BY RAND() LIMIT 9";
        $resultado = $conexion->query($sql);
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