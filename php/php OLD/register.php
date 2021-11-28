<?php

include 'connection.php';

$conexion = OpenCon();

if($conexion)
{

    $sql = "SELECT * FROM administradores WHERE usuario = '".$_POST["usuario"]. "'";

    $resultado = $conexion->query($sql);
    $entrada = $resultado->fetch_assoc();

    if ($entrada["activo"])
    {
        
        echo "ERROR: USUARIO YA EXISTE";

    }
    elseif( ! $entrada["activo"])
    {
        $sql = "UPDATE administradores SET activo=1 ,contraseña='".$_POST["contraseña"]."' WHERE usuario='".$_POST["usuario"]."'";
        $conexion->query($sql);

        $sql = "SELECT contacto_id FROM administradores WHERE usuario='".$_POST["usuario"]."'";
        $resultado = $conexion->query($sql);

        $sql ="UPDATE info_contacto SET nombre='".$_POST["nombre"]."' , apellido='".$_POST["apellido"]."', correo='".$_POST["correo"]."', telefono='".$_POST["telefono"]."' WHERE contacto_id=".($resultado->fetch_assoc()["contacto_id"]);
        $conexion->query($sql);

        echo "CUENTA RESTAURADA";
    }
    else 
    {
        $sql="INSERT INTO info_contacto (nombre,apellido,correo,telefono) VALUES ('".$_POST["nombre"]."','".$_POST["apellido"]."','".$_POST["correo"]."',".$_POST["telefono"].")";
        $conexion->query($sql);

        $sql="SELECT contacto_id FROM info_contacto WHERE nombre='".$_POST["nombre"]."'AND apellido='".$_POST["apellido"]."'AND correo='".$_POST["correo"]."'AND telefono=".$_POST["telefono"];
        $resultado = $conexion->query($sql);
        $contacto_id = $resultado->fetch_assoc()["contacto_id"];

        $sql="INSERT INTO administradores (contacto_id , usuario , contraseña , activo) VALUES ($contacto_id,'".$_POST["usuario"]. "','".$_POST["contraseña"]."',1)";
        $conexion->query($sql);

        echo "REGISTRO EXITOSO";
    }
    

    $conexion->close();
}
else
{
    echo "error de conexion";
}

?>