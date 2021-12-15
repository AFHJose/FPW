<?php
include "conexion.php";


$conexion= OpenCon();

if($conexion)
{
    $sql="SELECT MAX(id_prop) FROM propiedades;";
    if($id_prop = $conexion->query($sql))
    {
    $id_prop= $id_prop->fetch_assoc();
    $id_prop=strval(intval($id_prop["MAX(id_prop)"])+1);
    

    }else{
        echo "error query en proximo id_prop";
    }
    
    
    
    

}else{
    echo "Error conexion";
}

?>