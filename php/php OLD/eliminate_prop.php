<?php 
include 'connection.php';

$conexion = OpenCon();

if($conexion)
{

    $sql = "DELETE FROM propiedades WHERE dir='".$_GET["dir"]."';";
    $conexion->query($sql);
    $conexion->close();

}
else
{
    echo "error de conexion";
}


?>