<?php 
session_start();
include "conexion.php";
include "validar.php";

$conexion = OpenCon();


if($conexion)
{
    $sql= "UPDATE ofertas SET estado='rechazada' WHERE id_oferta=".$_GET["id_oferta"];
    $conexion->query($sql);

    header("Location: http://localhost/FPW/php/propiedad-detalle.php?id_prop=".$_GET["id_prop"]);
    
    $conexion->close();


}else
{
    echo "Error conexion";
}



?>