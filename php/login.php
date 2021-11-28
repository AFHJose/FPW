<?php 
include "conexion.php";

$conexion = OpenCon();

if($conexion)
{

   // $sql = "Select * FROM usuarios WHERE usuario = '".$_POST["usuario"]. "' AND contraseña='".$_POST["contraseña"]."' AND activo=1";
    $sql = "select * from usuarios where usuario ='".$_POST["usuario"]."'";
    $resultado = $conexion->query($sql);
    $entrada = $resultado->fetch_assoc();

    if ($entrada)
    {
        echo $entrada["correo"];
        /*
        $sql= "SELECT * FROM info_contacto WHERE contacto_id=".$entrada["contacto_id"];
        $usuario = ($conexion->query($sql))->fetch_assoc();
        include "../html/main.html";
        */

    } 
    else 
    {
        echo "ERROR";
        //include "../html/login.html";
    }
    

    $conexion->close();
}
else
{
    echo "error de conexion";
}




?>