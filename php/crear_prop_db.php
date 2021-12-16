<?php
session_start();

include "conexion.php";
include "validar.php";



$conexion = OpenCon();
if($conexion)
{
    $dir= limpiar_validar($_POST["dir"],"dir");

    $superficie= limpiar_validar($_POST["superficie"], "superficie");

    $tipo=limpiar_validar($_POST["tipo"], "texto");

    $supCubierta= limpiar_validar($_POST["supCubierta"], "supCubierta");

    $antiguedad= limpiar_validar($_POST["antiguedad"], "antiguedad");

    $precio=intval(limpiar_validar($_POST["precio"], "precio"));

    $autor=limpiar_validar($_POST["autor"], "texto");

    $barrio=limpiar_validar($_POST["barrio"], "texto");

    $ambientes=intval(limpiar_validar($_POST["ambientes"], "numero"));

    $baños=intval(limpiar_validar($_POST["baños"], "numero"));

    $moneda=limpiar_validar($_POST["moneda"], "texto");

    if ($moneda=="peso")
    {
        $dolar=0;
    }else if($moneda=="dolar")
    {
        $dolar=1;
    }

    $tipoPublicacion = limpiar_validar($_POST["tipoPublicacion"], "texto");

    if($tipoPublicacion=="venta")
    {
        $venta=$precio;
        $alquiler=0;

    }else if($tipoPublicacion=="alquiler")
    {
        $alquiler=$precio;
        $venta=0;
    }

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

    $id_usuario= $_SESSION["id_usuario"];

    if($id_usuario=="1")
    {
        $autor="miba";
        $certificada=1;
    }else{
        $certificada=0;
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
                //obtener el maximo id actual y sumarle uno para saber el id de la propiedad a crear y 
                //utilizarlo para crear la carpeta donde se guardan las imagenes
                $sql="SELECT MAX(id_prop) FROM propiedades;";
                if($id_prop = $conexion->query($sql))
                {
                $id_prop= $id_prop->fetch_assoc();
                $id_prop=strval(intval($id_prop["MAX(id_prop)"])+1);
            
                }else{
                    echo "error query en proximo id_prop";
                }
                
                $img_dir ="../assets/usuarios/".$id_usuario."/".$id_prop;
                $img_path="../assets/usuarios/".$id_usuario."/".$id_prop."/1.".$path['extension'];
                
                // crear las carpetas necesarias con todos los permisos habilidatos de manera recursiva
                if(mkdir($img_dir,"0777",true))
                {
                    //mover y renombrar el archivo
                    if(move_uploaded_file($_FILES['img']['tmp_name'],$img_path))
                    {
                        $id_usuario=intval($id_usuario);
                        //echo "EXITO ";
                        // utilizar prepare como manera de filtrar posible codigo sql malicioso
                        $sql = "INSERT INTO mibadb.propiedades (id_usuario,img_path,dir,barrio,tipo,ambientes,baños,venta,alquiler,dolar,aire,balcon,pileta,jardin,gym,estacionamiento,superficie,superficie_cubierta,certificada,antiguedad,autor) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                        $stmt= $conexion->prepare($sql);
                        $stmt->bind_param("issssiiiiiiiiiiiiiiis",$id_usuario,$img_path,$dir,$barrio,$tipo,$ambientes,$baños,$venta,$alquiler,$dolar,$aire,$balcon,$pileta,$jardin,$gym,$estacionamiento,$superficie,$supCubierta,$certificada,$antiguedad,$autor);
                        $stmt->execute();

                        header("Location: http://localhost/FPW/php/index.php");

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
    

}else{
    echo "Error conexion DB";
}



?>