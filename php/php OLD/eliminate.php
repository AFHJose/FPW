<?php 
include 'connection.php';

$conexion = OpenCon();

if($conexion)
{

    $sql = "UPDATE administradores SET activo=0 WHERE usuario='".$_GET["usuario"]."'";
    $conexion->query($sql);
    $conexion->close();

}
else
{
    echo "error de conexion";
}


?>