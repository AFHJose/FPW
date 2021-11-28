<?php 
include 'connection.php';

$conexion = OpenCon();

if($conexion)
{

    $sql = "UPDATE propiedades SET tipo='".$_GET["tipo"]."',ubicacion='".$_GET["ubicacion"]."',estado='".$_GET["estado"]."',ambientes='".$_GET["ambientes"]."',estacionamiento='".$_GET["estacionamiento"]."' WHERE dir='".$_GET["dir"]."'";
    echo $sql;
    $conexion->query($sql);

    $conexion->close();

}
else
{
    echo "error de conexion";
}


?>