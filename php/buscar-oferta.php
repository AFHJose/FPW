<?php 

include "conexion.php";

$conexion = OpenCon();

if($conexion)
{
    if($_GET["modo"]=="azar")
    {
        $sql="SELECT * FROM ofertas INNER JOIN usuarios ON ofertas.id_usuario = usuarios.id_usuario WHERE id_prop=".$_GET["id_prop"]." ORDER BY RAND() LIMIT 6 OFFSET 0";
    }


    $resultado= $conexion->query($sql);

    
    $i=0;
    while($entrada = $resultado->fetch_assoc())
    {
        $entradas[$i]=$entrada;
        $i++;
    }
    if($i==0)
    {
        $out = "vacio";
    }else 
    {
        $out = json_encode($entradas);
    }

    echo $out;

    $conexion->close();


}else
{
    echo "Error conexion";
}



?>