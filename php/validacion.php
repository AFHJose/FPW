<?php
$condiciones['usuario'] = /^\s*\S{6,}\s*$/;
$condiciones['contraseña'] = /^\s*\S{8,}\s*$/;

function testinput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validar($dato,$tipo)
{
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