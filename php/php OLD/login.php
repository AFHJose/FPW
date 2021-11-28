<?php 
include 'connection.php';

$conexion = OpenCon();

if($conexion)
{

    $sql = "Select * FROM administradores WHERE usuario = '".$_POST["usuario"]. "' AND contraseña='".$_POST["contraseña"]."' AND activo=1";

    $resultado = $conexion->query($sql);
    $entrada = $resultado->fetch_assoc();

    if ($entrada)
    {
        $sql= "SELECT * FROM info_contacto WHERE contacto_id=".$entrada["contacto_id"];
        $usuario = ($conexion->query($sql))->fetch_assoc();
        include "../html/main.html";

    } 
    else 
    {
        include "../html/login.html";
    }
    

    $conexion->close();
}
else
{
    echo "error de conexion";
}


?>