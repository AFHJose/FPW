<?php 

include 'connection.php';

$conexion = OpenCon();

if($conexion)
{

    $sql = "Select * FROM administradores WHERE usuario = '".$_GET["usuario"]. "'";

    $resultado = $conexion->query($sql);
    $entrada = $resultado->fetch_assoc();

    include "../html/crear-prop.html";
    

    $conexion->close();
}
else
{
    echo "error de conexion";
}









?>