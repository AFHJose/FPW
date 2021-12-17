<?php
session_start();

include "conexion.php";
include "validar.php";

$conexion = OpenCon();
if($conexion)
{
    if(isset($_POST["tipo"]))
    {
        $tipo=limpiar_validar($_POST["tipo"], "texto");

        $sql = "UPDATE mibadb.propiedades SET tipo=? WHERE id_prop=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("ss",$tipo, $_POST["id_prop"]);
        $status = $stmt->execute();

    }

    if(isset($_POST["dir"]))
    {
        $dir= limpiar_validar($_POST["dir"],"dir");

        $sql = "UPDATE mibadb.propiedades SET dir=? WHERE id_prop=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("ss",$dir, $_POST["id_prop"]);
        $status = $stmt->execute();

    }

    if(isset($_POST["superficie"]))
    {
        $superficie= limpiar_validar($_POST["superficie"], "superficie");

        $sql = "UPDATE mibadb.propiedades SET superficie=? WHERE id_prop=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("ss",$superficie, $_POST["id_prop"]);
        $status = $stmt->execute();

    }

    if(isset($_POST["supCubierta"]))
    {
        $supCubierta= limpiar_validar($_POST["supCubierta"], "supCubierta");

        $sql = "UPDATE mibadb.propiedades SET superficie_cubierta=? WHERE id_prop=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("ss",$supCubierta, $_POST["id_prop"]);
        $status = $stmt->execute();

    }

    if(isset($_POST["antiguedad"]))
    {
        $antiguedad= limpiar_validar($_POST["antiguedad"], "antiguedad");

        $sql = "UPDATE mibadb.propiedades SET antiguedad=? WHERE id_prop=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("ss",$antiguedad, $_POST["id_prop"]);
        $status = $stmt->execute();

    }

    if(isset($_POST["barrio"]))
    {
        $barrio=limpiar_validar($_POST["barrio"], "texto");

        $sql = "UPDATE mibadb.propiedades SET barrio=? WHERE id_prop=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("ss",$barrio, $_POST["id_prop"]);
        $status = $stmt->execute();

    }

    if(isset($_POST["ambientes"]))
    {
        $ambientes=limpiar_validar($_POST["ambientes"], "numero");

        $sql = "UPDATE mibadb.propiedades SET ambientes=? WHERE id_prop=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("ss",$ambientes, $_POST["id_prop"]);
        $status = $stmt->execute();

    }
    if(isset($_POST["baños"]))
    {
        $baños=limpiar_validar($_POST["baños"], "numero");

        $sql = "UPDATE mibadb.propiedades SET baños=? WHERE id_prop=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("ss",$baños, $_POST["id_prop"]);
        $status = $stmt->execute();

    }

    if(isset($_POST["moneda"]))
    {
        $moneda=limpiar_validar($_POST["moneda"], "texto");
        if ($moneda=="peso")
        {
            $dolar="0";
        }else if($moneda=="dolar")
        {
            $dolar="1";
        }

        $sql = "UPDATE mibadb.propiedades SET dolar=? WHERE id_prop=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("ss",$dolar, $_POST["id_prop"]);
        $status = $stmt->execute();

    }

    if(isset($_POST["precio"]))
    {
        $precio=limpiar_validar($_POST["precio"], "precio");
        
        $tipoPublicacion = limpiar_validar($_POST["tipoPublicacion"], "texto");

        if($tipoPublicacion=="venta")
        {
            $venta=$precio;
            $alquiler="0";

        }else if($tipoPublicacion=="alquiler")
        {
            $alquiler=$precio;
            $venta="0";
        }

        $sql = "UPDATE mibadb.propiedades SET venta=? , alquiler=? WHERE id_prop=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("sss",$venta,$alquiler, $_POST["id_prop"]);
        $status = $stmt->execute();

    }

    $id_usuario= $_SESSION["id_usuario"];

    if(isset($_POST["autor"]))
    {
        $autor=limpiar_validar($_POST["autor"], "texto");

        
    
        if($id_usuario=="1")
        {
            $autor="miba";
            $certificada="1";
        }else{
            $certificada="0";
        }
        $sql = "UPDATE mibadb.propiedades SET autor=? , certificada=? WHERE id_prop=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("sss",$autor,$certificada, $_POST["id_prop"]);
        $status = $stmt->execute();

    }

    if($_POST["comodidades"]=="si")
    {
        if(isset($_POST["aire"]) and $_POST["aire"]=="tiene")
        {
            $aire=1;
        }else{
            $aire=0;
        }
    
        if(isset($_POST["balcon"]) and $_POST["balcon"]=="tiene")
        {
            $balcon=1;
        }else{
            $balcon=0;
        }
    
        if(isset($_POST["pileta"]) and $_POST["pileta"]=="tiene")
        {
            $pileta=1;
        }else{
            $pileta=0;
        }
    
        if(isset($_POST["jardin"]) and $_POST["jardin"]=="tiene")
        {
            $jardin=1;
        }else{
            $jardin=0;
        }
    
        if(isset($_POST["gym"]) and $_POST["gym"]=="tiene")
        {
            $gym=1;
        }else{
            $gym=0;
        }
    
        if(isset($_POST["estacionamiento"]) and $_POST["estacionamiento"]=="tiene")
        {
            $estacionamiento=1;
        }else{
            $estacionamiento=0;
        }

        $sql = "UPDATE mibadb.propiedades SET aire=? , balcon=? , pileta=? , jardin=? , gym=? , estacionamiento=? WHERE id_prop=?";
        $stmt= $conexion->prepare($sql);
        $stmt->bind_param("iiiiiis",$aire,$balcon,$pileta, $jardin, $gym, $estacionamiento, $_POST["id_prop"]);
        $status = $stmt->execute();
    }

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
   
                //ubicar la imagen actual
                $sql="SELECT * FROM propiedades WHERE id_prop=".$_POST["id_prop"];
                $resultado=$conexion->query($sql)->fetch_assoc();
                $img_path=$resultado["img_path"];
                //borrar la imagen actual
                unlink($img_path);

                //mover y renombrar el archivo
                if(move_uploaded_file($_FILES['img']['tmp_name'],$img_path))
                {

                    header("Location: http://localhost/FPW/php/index.php");

                }else
                {
                    echo "Error mover archivo";
                }

    
            }else
            {
                echo "Error tamaño archivo";
            }
        }else
        {
            echo "Error de extension";
        }

    }

    header("Location: http://localhost/FPW/php/propiedad-detalle.php?id_prop=".$_POST["id_prop"]);

}else{
    echo "Error conexion DB";
}


?>