<?php

include 'connection.php';

$conexion = OpenCon();

if($conexion)
{

    $sql= "SELECT admin_id FROM administradores WHERE usuario='".$_POST["usuario"]."'";

    $resultado = ($conexion->query($sql))->fetch_assoc();

    $sql= "INSERT INTO propiedades (admin_id,tipo,ubicacion,estado,ambientes,estacionamiento,dir,img) VALUES ('".$resultado["admin_id"]."','".$_POST["tipo"]."','".$_POST["ubi"]."','".$_POST["estado"]."','".$_POST["ambientes"]."','".$_POST["estacionamiento"]."','".$_POST["dir"]."','".$_POST["img"]."')";

    $conexion->query($sql);

    if($conexion)
    {
        include "../html/main.html";
    }
    else
    {
        include "../html/crear-prop.html";
    }
    

    $conexion->close();
}
else
{
    echo "error de conexion";
}

?>