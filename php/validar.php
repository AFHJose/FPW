<?php
// es necesario escapar los guion medio "\-"
$condiciones = array( 'usuario' => "#^\s*\S{6,}\s*$#i" ,'contraseña'=> "#^\s*\S{8,}\s*$#i", 'correo' => "#^\s*[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}\s*$#i",'precio'=>"#^\s*(\d*\D+\d*)+\s*$#", 'dir'=>"#^(\s*[A-Za-z]+\s*)+(\s*\d{1,4}\s*){1}$#",'superficie'=>"#^\s*\d+\s*$#",'supCubierta'=>"#^\s*\d+\s*$#",'antiguedad'=>"#^\s*(\d{1,3})\s*$#",'precio'=>"#^\s*(\d{1,})\s*$#",'texto'=>"#[A-Za-z]+#",'numero'=>"#\d+#");


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

function limpiar_validar($dato,$tipo)
{
    global $condiciones;
    $dato= limpiar($dato);
    if ($dato == null or $dato=="" or !preg_match($condiciones[$tipo],$dato))
    {
        return null;
    }else
    {
        return $dato;
    }
}




?>