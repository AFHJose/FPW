<?php

//include 'db_connection.php'; en otros script de php para acceder a estas funciones siempre y cuando esten en la misma carpeta

    function OpenCon()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mibadb";

        $conn = new mysqli($servername, $username, $password,$dbname);

        if ($conn->connect_error) 
        {
            //echo "Connection failed: " . $conn->connect_error;
            return NULL;
        }
        else
        {
            return $conn;
        }

    }


?>