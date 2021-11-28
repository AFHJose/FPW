<?php 
include 'connection.php';

$conexion = OpenCon();

if($conexion)
{
    if($_GET["modo"]=="primeros")
    {
        $sql = "Select * FROM propiedades WHERE propiedad_id BETWEEN 1 AND 12";
        $resultado = $conexion->query($sql);
    
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[strval( $prop["propiedad_id"] ) ] = $prop;
        }

        echo json_encode($propiedades);

    }
    else if($_GET["modo"]=="Casa")
    {

        $sql = "Select * FROM propiedades WHERE tipo='Casa'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (tipo='Casa') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop;
                $count+=1; 
            }
        }

        echo json_encode($propiedades);

    }
    else if($_GET["modo"]=="Departamento")
    {

        $sql = "Select * FROM propiedades WHERE tipo='Departamento'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (tipo='Departamento') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="Salon")
    {

        $sql = "Select * FROM propiedades WHERE tipo='Salon'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (tipo='Salon') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="Complejo turistico")
    {

        $sql = "Select * FROM propiedades WHERE tipo='Complejo turistico'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (tipo='Complejo turistico') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="Villa del lago")
    {

        $sql = "Select * FROM propiedades WHERE ubicacion='Villa del lago'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (ubicacion='Villa del lago') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="La isla sur")
    {

        $sql = "Select * FROM propiedades WHERE ubicacion='La isla sur'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (ubicacion='La isla sur') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="La isla norte")
    {

        $sql = "Select * FROM propiedades WHERE ubicacion='La isla norte'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (ubicacion='La isla norte') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="Centro")
    {

        $sql = "Select * FROM propiedades WHERE ubicacion='Centro'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (ubicacion='Centro') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="La Pasarela")
    {

        $sql = "Select * FROM propiedades WHERE ubicacion='La Pasarela'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (ubicacion='La Pasarela') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="Radal")
    {

        $sql = "Select * FROM propiedades WHERE ubicacion='Radal'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (ubicacion='Radal') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="Alquilada")
    {

        $sql = "Select * FROM propiedades WHERE estado='Alquilada'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (estado='Alquilada') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="Disponible para Alquilar")
    {

        $sql = "Select * FROM propiedades WHERE estado='Disponible para Alquilar'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (estado='Disponible para Alquilar') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="Disponible para vender")
    {

        $sql = "Select * FROM propiedades WHERE estado='Disponible para vender'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (estado='Disponible para vender') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="Monoambiente")
    {

        $sql = "Select * FROM propiedades WHERE ambientes='Monoambiente'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (ambientes='Monoambiente') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="2 ambientes")
    {

        $sql = "Select * FROM propiedades WHERE ambientes='2 ambientes'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (ambientes='2 ambientes') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="3 ambientes")
    {

        $sql = "Select * FROM propiedades WHERE ambientes='3 ambientes'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (ambientes='3 ambientes') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="4 o más ambientes")
    {

        $sql = "Select * FROM propiedades WHERE ambientes='4 o más ambientes'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (ambientes='4 o más ambientes') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="Sin estacionamiento")
    {

        $sql = "Select * FROM propiedades WHERE estacionamiento='Sin estacionamiento'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (estacionamiento='Sin estacionamiento') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="1 espacio")
    {

        $sql = "Select * FROM propiedades WHERE estacionamiento='1 espacio'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (estacionamiento='1 espacio') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="2 espacios")
    {

        $sql = "Select * FROM propiedades WHERE estacionamiento='2 espacios'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (estacionamiento='2 espacios') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="3 espacios")
    {

        $sql = "Select * FROM propiedades WHERE estacionamiento='3 espacios'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (estacionamiento='3 espacios') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }
    else if($_GET["modo"]=="4 o más espacios")
    {

        $sql = "Select * FROM propiedades WHERE estacionamiento='4 o más espacios'";
        $resultado = $conexion->query($sql);
        
        $count=1;
        while($prop = $resultado->fetch_assoc()) {
            $propiedades[$count] = $prop; 
            $count+=1;
        }
        if($count<13)
        {
            $missing = (13-$count);
            $sql = "Select * FROM propiedades WHERE NOT (estacionamiento='4 o más espacios') LIMIT $missing";
            $resultado = $conexion->query($sql);
            
            while($prop = $resultado->fetch_assoc()) {
                $propiedades[$count] = $prop; 
                $count+=1;
            }
        }

        echo json_encode($propiedades);
        
    }

    $conexion->close();
}
else
{
    echo "error de conexion";
}


?>