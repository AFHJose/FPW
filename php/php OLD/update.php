<?php 
include 'connection.php';

$conexion = OpenCon();

if($conexion)
{

    $sql = "SELECT contacto_id FROM administradores WHERE usuario='".$_GET["usuario"]."'";
    $resultado = ($conexion->query($sql))->fetch_assoc();

    $sql = "UPDATE info_contacto SET nombre='".$_GET["nombre"]."',apellido='".$_GET["apellido"]."',correo='".$_GET["correo"]."',telefono=".$_GET["telefono"]." WHERE contacto_id=".$resultado["contacto_id"];
    $conexion->query($sql);

    $sql ="SELECT nombre, apellido, correo, telefono FROM info_contacto WHERE contacto_id =".$resultado["contacto_id"];
    $resultado = ($conexion->query($sql))->fetch_assoc();

    echo json_encode($resultado);
    
    $conexion->close();

}
else
{
    echo "error de conexion";
}


?>