<?php 
include "conexion.php";
include "validar.php";

$conexion = OpenCon();

if($conexion)
{
    //limpiar variables escapando char de html, eliminando espacio y char especiales y \ extras
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
    //comprobar que las entradas pasen las pruebas
    if($contraseña AND $usuario)
    {
        // utilizar prepare como manera de filtrar posible codigo sql malicioso
        $sql = "SELECT * FROM usuarios WHERE usuario=? AND contraseña=? AND activa=1";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("ss",$usuario,$contraseña);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $entrada = $resultado->fetch_assoc();
    }

    if ($entrada)
    {
        // crear una cookie con un hash del id del usuario
        $user = hash("sha3-512",$entrada["id_usuario"]);
        setcookie("miba", $user, time()+ 86400, "/");

        //crear una session con la informacion del usuario
        session_start();
        $_SESSION["id_usuario"] = $entrada["id_usuario"];
        $_SESSION["usuario"] = $entrada["usuario"];
        $_SESSION["correo"] = $entrada["correo"];

        //agregar el archivo a mostrar

        header("Location: http://localhost/FPW/php/index.php");

        /*
        include "../html/main.html";
        */

    } 
    else 
    {
        header("Location: http://localhost/FPW/html/login.html");

    }
    

    $conexion->close();
}
else
{
    echo "Error de conexion";
}




?>