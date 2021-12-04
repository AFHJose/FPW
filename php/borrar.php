<?php 
session_start();
include "conexion.php";
include "validar.php";
$conexion = OpenCon();

if($conexion)
{
    // utilizar prepare como manera de filtrar posible codigo sql malicioso
    // actualizar la contraseña
    $sql = "UPDATE mibadb.usuarios SET activa=0 WHERE id_usuario=?";
    $stmt= $conexion->prepare($sql);
    $stmt->bind_param("s", $_SESSION["id_usuario"]);
    $status = $stmt->execute();

    if($status)
    {
        session_unset();
        session_destroy();
        setcookie("miba", "", time() - 86400, "/");

        $resultado = array( 'estado' => $status);
        echo json_encode($resultado);

    }else{
        $resultado = array( 'estado' => false);
        echo json_encode($resultado);
    }
    

    $conexion->close();
}
else
{
    $resultado = array( 'estado' => false);
    echo json_encode($resultado);
}



?>