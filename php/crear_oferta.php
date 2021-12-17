<?php 
session_start();
include "conexion.php";
include "validar.php";

$conexion = OpenCon();


if($conexion)
{
    
    $precio=limpiar_validar($_POST["precio"], "precio");
    $creacion=date("Y/m/d");
    if(isset($_POST["dolares"]))
    {
        $dolar=1;
    }else
    {
        $dolar=0;
    }
    
    
    $sql = "INSERT INTO mibadb.ofertas (id_usuario, id_prop, dolar, precio, creacion, termina, estado) VALUES (?,?,?,?,?,?,'vigente')";
    $stmt= $conexion->prepare($sql);
    $stmt->bind_param("ssisss",$_SESSION["id_usuario"],$_POST["id_prop"],$dolar,$precio,$creacion,$_POST["termina"]);
    $stmt->execute();

    header("Location: http://localhost/FPW/php/propiedad-detalle.php?id_prop=".$_POST["id_prop"]);
    
    $conexion->close();


}else
{
    echo "Error conexion";
}



?>