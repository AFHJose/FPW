<?php
// es necesario escapar los guion medio "\-"
$condiciones = array( 'usuario' => "#^\s*\S{6,}\s*$#i" ,'contraseña'=> "#^\s*\S{8,}\s*$#i", 'correo' => "#^\s*[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}\s*$#i",'precio'=>"#^\s*(\d*\D+\d*)+\s*$#");


function limpiar($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validar($dato,$tipo)
{
    global $condiciones;
    if ($dato == null or $dato=="")
    {
        return FALSE;
    }else
    {
        if(preg_match($condiciones[$tipo],$dato))
        {
            return TRUE;
        }else
        {
            return FALSE;
        }
    }
}


?>