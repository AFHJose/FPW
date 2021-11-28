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
    echo "Error de conexion";
}




?>