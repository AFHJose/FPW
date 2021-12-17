<?php 

include "conexion.php";

$conexion = OpenCon();

if($conexion)
{
    if($_GET["modo"]=="azar")
    {
        $sql="SELECT * FROM ofertas INNER JOIN usuarios ON ofertas.id_usuario = usuarios.id_usuario WHERE id_prop=".$_GET["id_prop"]." ORDER BY RAND() LIMIT 6 OFFSET ".strval((intval($_GET["offset"])-1)*6);
    }
    if($_GET["modo"]=="vigente")
    {
        $sql="SELECT * FROM ofertas INNER JOIN usuarios ON ofertas.id_usuario = usuarios.id_usuario WHERE id_prop=".$_GET["id_prop"]." AND estado='vigente' ORDER BY id_oferta LIMIT 6 OFFSET ".strval((intval($_GET["offset"])-1)*6);
    }
    if($_GET["modo"]=="vencida")
    {
        $sql="SELECT * FROM ofertas INNER JOIN usuarios ON ofertas.id_usuario = usuarios.id_usuario WHERE id_prop=".$_GET["id_prop"]." AND estado='expirada' ORDER BY id_oferta LIMIT 6 OFFSET ".strval((intval($_GET["offset"])-1)*6);
    }
    if($_GET["modo"]=="rechazada")
    {
        $sql="SELECT * FROM ofertas INNER JOIN usuarios ON ofertas.id_usuario = usuarios.id_usuario WHERE id_prop=".$_GET["id_prop"]." AND estado='rechazada' ORDER BY id_oferta LIMIT 6 OFFSET ".strval((intval($_GET["offset"])-1)*6);
    }

   
    $resultado= $conexion->query($sql);
    $i=0;
    while($entrada = $resultado->fetch_assoc())
    {
        $entradas[$i]=$entrada;
        $i++;
    }
    
    if($resultado->num_rows==0)
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