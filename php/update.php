<?php 
session_start();
include "conexion.php";
include "validar.php";
$conexion = OpenCon();

if($conexion)
{
    //limpiar variables escapando char de html, eliminando espacio y char especiales y \ extras
    $correo = limpiar($_POST['correo']);
    //comprobar que las variables tengan la forma correcta con un regex
    if (!validar($correo,"correo"))
    {
        $correo=null;
    }
    //comprobar que las entradas pasen las pruebas
    if($correo)
    {
        
        // utilizar prepare como manera de filtrar posible codigo sql malicioso
        // actualizar el correo
        $sql = "UPDATE mibadb.usuarios SET correo=? WHERE id_usuario=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("ss",$correo, $_SESSION["id_usuario"]);
        $status = $stmt->execute();

        if($status == false)
        {   
            $resultado = array( 'estado' => false ,'correo'=>$correo );
            echo json_encode($resultado);
        }else
        {
            $_SESSION["correo"]=$correo;
            $resultado = array( 'estado' => true ,'correo'=>$correo );
            echo json_encode($resultado);
        }


    }else{
        echo "Error de formato";
    }

    

    $conexion->close();
}
else
{
    echo "Error de conexion";
}



?>