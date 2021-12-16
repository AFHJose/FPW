<?php 
session_start();
include "conexion.php";
include "validar.php";
$conexion = OpenCon();

if($conexion)
{
    // utilizar prepare como manera de filtrar posible codigo sql malicioso
    // actualizar la contraseña
    $sql = "UPDATE mibadb.propiedades SET activa=0 WHERE id_prop=?";
    $stmt= $conexion->prepare($sql);
    $stmt->bind_param("s", $_GET["id_prop"]);
    $status = $stmt->execute();

    if(!$status)
    {
        echo "Error al eliminar propiedad";

    }else{
        header("Location: http://localhost/FPW/php/index.php");
    }
    

    $conexion->close();
}
else
{
    echo "Error conexion";
}



?>