<?php
session_start();

include "conexion.php";
include "validar.php";

// comprobar que se cargo el archivo
if(isset($_FILES['img']) AND $_FILES['img']['error']== UPLOAD_ERR_OK)
{
    $path = pathinfo($_FILES['img']['name']);
    //comprobar si el archivo tiene la extension correcta
    if ( in_array(strtolower($path['extension']),array("jpeg","jpg","png","gif")))
    {

        //comprobar que el archivo tiene un tamaño apropiado 0b a 20Mb
        if($_FILES['img']['size']>0 AND $_FILES['img']['size']< 20971520)
        {
            $usuario="admin";
            $prop ="casa";
            $ubicacion="../assets/usuarios/".$usuario."/".$prop;
            
            if(mkdir($ubicacion,"0777",true))
            {
                if(move_uploaded_file($_FILES['img']['tmp_name'],$ubicacion."/".$path['basename']))
                {
                    echo "EXITO ";
                }else
                {
                    echo "Error mover archivo";
                }
            }else 
            {
                echo "Error crear directorio";
            }
   
        }else
        {
            echo "Error tamaño archivo";
        }
    }else
    {
        echo "Error de extension";
    }





}else
{
    echo "Error carga archivo";
}





?>