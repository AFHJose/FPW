<?php 
session_start();
include "conexion.php";
include "validar.php";
$conexion = OpenCon();

if($conexion)
{
    if(isset($_POST['correo']))
    {

        //limpiar variables eliminando espacios, comillas, simbolos html
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
            $resultado = array( 'estado' => false ,'correo'=>$correo );
            echo json_encode($resultado);
        }
    }else if(isset($_POST['actual']) AND isset($_POST['nueva']))
    {
        //limpiar variables eliminando espacios, comillas, simbolos html
        $actual = limpiar($_POST['actual']);
        $nueva = limpiar($_POST['nueva']);
        //comprobar que las variables tengan la forma correcta con un regex
        if (!validar($actual,"contraseña"))
        {
            $correo=null;

        }else if(!validar($nueva,"contraseña"))
        {
            $nueva=null;
        }

        if($actual AND $nueva)
        {
            if($_SESSION["contraseña"] == $actual)
            {

            // utilizar prepare como manera de filtrar posible codigo sql malicioso
            // actualizar la contraseña
            $sql = "UPDATE mibadb.usuarios SET contraseña=? WHERE id_usuario=?";
            $stmt= $conexion->prepare($sql);
            $stmt->bind_param("ss",$nueva, $_SESSION["id_usuario"]);
            $status = $stmt->execute();
            $resultado = array( 'estado' => $status);

            if($status)
            {
                $_SESSION["contraseña"]=$nueva;
            }
            echo json_encode($resultado);

            }else
            {
                $resultado = array( 'estado' => false);
                echo json_encode($resultado);
            }
        }
    }

    

    $conexion->close();
}
else
{
    $resultado = array( 'estado' => false);
    echo json_encode($resultado);
}



?>