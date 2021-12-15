<?php 
include "conexion.php";
include "validar.php";

$conexion = OpenCon();

if($conexion)
{
    //limpiar variables eliminando espacios, comillas, simbolos html
    $usuario = limpiar($_POST['usuario']);
    //comprobar que las variables tengan la forma correcta con un regex
    if (!validar($usuario,"usuario"))
    {
        $usuario=null;
    }
    $contraseña = limpiar($_POST['contraseña']);
    if (!validar($contraseña,"contraseña"))
    {
        $contraseña=null;
    }
    $correo = limpiar($_POST['correo']);
    if (!validar($correo,"correo"))
    {
        $correo=null;
    }
    //comprobar que las entradas pasen las pruebas
    if($contraseña AND $usuario AND $correo)
    {
        //determinar si existe una cuenta registrada con el mismo usuario
        // utilizar prepare como manera de filtrar posible codigo sql malicioso
        $sql = "SELECT * FROM usuarios WHERE usuario=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("s",$usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $entrada = $resultado->fetch_assoc();


        if ($entrada)
        {
    
            header("Location: http://localhost/FPW/html/cuenta-nueva.html");
    
        } 
        else 
        {
        // utilizar prepare como manera de filtrar posible codigo sql malicioso
        $sql = "INSERT INTO mibadb.usuarios (usuario,contraseña,correo) VALUES (?,?,?)";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("sss",$usuario,$contraseña,$correo);
        $stmt->execute();
        header("Location: http://localhost/FPW/php/index.php");
    
        }
    }

    

    $conexion->close();
}
else
{
    echo "Error de conexion";
}




?>