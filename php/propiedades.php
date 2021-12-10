<?php
session_start()
?>
<!-- Abrir pagina con live server 127.0.0.1:5500/html/index.html -->
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php
    if($_GET["modo"]=="compra")
    {
      echo '<meta id="load" name="modo" content="tipo-compra"/>';
    }else if($_GET["modo"]=="alquiler")
    {
      echo '<meta id="load" name="modo" content="tipo-alquiler"/>';
    }else if($_GET["modo"]=="usuario")
    {
      echo '<meta id="load" name="modo" content="autor-usuario"/>';
    }
    ?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>INDEX-TEST</title>
    <link rel="stylesheet" type="text/css" href="../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../css/index.css" />
    <link rel="stylesheet" type="text/css" href="../css/cuenta.css" />
    <link rel="stylesheet" type="text/css" href="../css/login.css" />
    <link rel="stylesheet" type="text/css" href="../css/prop.css" />
    <script src="../js/validar.js"></script>
    <script src="../js/dinamico.js"></script>
    <script src="../js/usuario.js"></script>
    <script  defer src="../js/propiedades.js"></script>
  </head>
  <body>
    <header class="cabecera">
      <div class="portada">
        <a class="portada-enlace" href="index.php"
          ><h1 class="portada-texto">Mercado Inmobiliario Buenos Aires</h1></a
        >
      </div>

      <div class="menu-contenedor">
        <nav class="nav">
          <ul class="menu">
          <li>
            <a href="propiedades.php?modo=compra" class="enlace-boton"><span class="enlace-texto">Comprar </span></a>
          </li>
          <li>
            <a href="propiedades.php?modo=alquiler" class="enlace-boton"><span class="enlace-texto">Alquilar </span></a>
          </li>
            <li>
              <a class="enlace-boton"><span class="enlace-texto">Vender </span></a>
            </li>
            <li>
              <a class="enlace-boton"><span class="enlace-texto">Servicios administrativos </span></a>
            </li>
          </ul>
        </nav>

        <?php
          
          // solo se reconoce al usuario como registrado si existe una cookie con el hash apropiado, existe una session y
          //una variable de la session procesada con hash() coincide con el hash de la cookie
          
          $invitado =<<<HEREDOC
          <ul class="cuenta-invitado">
          <li >
            <a class="enlace-boton" href="../html/login.html"
              ><span class="enlace-texto">Ingresar </span></a
            >
          </li>
          <li >
            <a href="../html/cuenta-nueva.html"class="enlace-boton"><span class="enlace-texto">Registrarse</span></a>
          </li>
          </ul>
          HEREDOC;
          if(!isset($_COOKIE["miba"]))
          {
            // borrar variables
            session_unset();
            // destruir la session
            session_destroy();
            //presentar pagina como invitado
            echo $invitado;

          }else if(!isset($_SESSION["id_usuario"]))
          {
            //borrar la cookie
            setcookie("miba", "", time() - 86400, "/");
            //presentar pagina como invitado
            echo $invitado;

          }else if (isset($_SESSION["id_usuario"]) AND hash("sha3-512",$_SESSION["id_usuario"]) == $_COOKIE["miba"])
          {
            $usuario_nombre = $_SESSION["usuario"];
            echo <<<HEREDOC
            <div class="cuenta-registrado">

            <a class="enlace-boton" href="javascript:menu();"><svg class="icono-cuenta" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 128c39.77 0 72 32.24 72 72S295.8 272 256 272c-39.76 0-72-32.24-72-72S216.2 128 256 128zM256 448c-52.93 0-100.9-21.53-135.7-56.29C136.5 349.9 176.5 320 224 320h64c47.54 0 87.54 29.88 103.7 71.71C356.9 426.5 308.9 448 256 448z"/></svg><span class="enlace-texto">$usuario_nombre</span> <svg  class="icono-flecha" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 246.6l-127.1 128C176.4 380.9 168.2 384 160 384s-16.38-3.125-22.63-9.375l-127.1-128C.2244 237.5-2.516 223.7 2.438 211.8S19.07 192 32 192h255.1c12.94 0 24.62 7.781 29.58 19.75S319.8 237.5 310.6 246.6z"/></svg></svg></a>
            <ul class="cuenta-menu hide" id="cuenta-menu">
              <li class="cuenta-menu-item" ><a href="cuenta.php" class="enlace-boton"><span class="enlace-texto">Cuenta</span></a></li>
              <li class="cuenta-menu-item" ><a href="propiedades.php?modo=usuario"  class="enlace-boton"><span class="enlace-texto">Propiedades</span></a></li>
              <li class="cuenta-menu-item" ><a class="enlace-boton"><span class="enlace-texto">Ofertas</span></a></li>
              <li class="cuenta-menu-item" ><a href="javascript:salir();" class="enlace-boton"><span class="enlace-texto">Salir</span></a></li>
            </ul>
    
            </div>

            HEREDOC;
          }else
          {
            // borrar variables
            session_unset();
            // destruir la session
            session_destroy();
            //borrar la cookie
            setcookie("miba", "", time() - 86400, "/");
            //presentar pagina como invitado
            echo $invitado;
          }
          
        ?>
        </ul>
      </div>
    </header>
    <main class="prop-mostrar">
      <!--

        <form class="buscar">
          <input class="buscar-entrada" placeholder="Ingrese " type="text">
          <div class="boton-contenedor">
            
            <input class="buscar-boton"type="submit">
          </div>
        </form>
      -->
          <aside class="buscar-contenedor">
              <h2>Buscador</h2>
              <ul >
                <li>
                <h3 class="buscar-titulo">Autor:</h3>
                <ul>
                  <?php
                  if (isset($_SESSION["id_usuario"]) AND hash("sha3-512",$_SESSION["id_usuario"]) == $_COOKIE["miba"])
                  {
                    echo <<<HEREDOC

                    <li class="buscar-opcion">
                      <svg id="autor-usuario-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="autor-usuario-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="autor-usuario" class="buscar-opcion-boton">Mis publicaciones</buton>
                    </li>
                    HEREDOC;
                  }
                  
                  
                  ?>
                  <li class="buscar-opcion">
                    <svg id="autor-propietario-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                    <svg id="autor-propietario-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                    <buton onclick="prop_consulta(this.id)" id="autor-propietario" class="buscar-opcion-boton">Propietario</buton>
                  </li>
                  <li class="buscar-opcion">
                    <svg id="autor-inmobiliaria-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                    <svg id="autor-inmobiliaria-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                    <buton onclick="prop_consulta(this.id)" id="autor-inmobiliaria" class="buscar-opcion-boton">Inmobiliaria</buton>
                  </li>
                </ul>
                </li>
                <li>
                  <h3 class="buscar-titulo">Tipo de publicacion:</h3>
                  <ul>
                    <li class="buscar-opcion">
                      <svg id="tipo-compra-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="tipo-compra-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton id="tipo-compra" onclick="prop_consulta(this.id)"  class="buscar-opcion-boton">Venta</buton>
                    </li>
                    <li class="buscar-opcion">
                      <svg id="tipo-alquiler-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="tipo-alquiler-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton id="tipo-alquiler" onclick="prop_consulta(this.id)"  class="buscar-opcion-boton">Alquiler</buton>
                    </li>
                  
                  </ul>
                </li>
                <li>
                  <h3 class="buscar-titulo">Inmueble:</h3>
                  <ul>
                    <li class="buscar-opcion">
                      <svg id="inmueble-departamento-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="inmueble-departamento-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="inmueble-departamento" class="buscar-opcion-boton">Departamento</buton>
                    </li>
                    <li class="buscar-opcion">
                      <svg  id="inmueble-casa-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg   id="inmueble-casa-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="inmueble-casa" class="buscar-opcion-boton">Casa</buton>
                    </li>
                    <li class="buscar-opcion">
                      <svg id="inmueble-terreno-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="inmueble-terreno-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="inmueble-terreno"  class="buscar-opcion-boton">Terreno</buton>
                    </li>
                    <li class="buscar-opcion">
                      <svg id="inmueble-oficina-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="inmueble-oficina-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="inmueble-oficina"  class="buscar-opcion-boton">Oficina</buton>
                    </li>
                    <li class="buscar-opcion">
                      <svg id="inmueble-cochera-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="inmueble-cochera-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="inmueble-cochera" class="buscar-opcion-boton">Cochera</buton>
                    </li>
                  
                  </ul>
                </li>


                <li>
                  <h3 class="buscar-titulo">Moneda:</h3>
                  <ul>
                    <li class="buscar-opcion">
                      <svg id="moneda-pesos-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="moneda-pesos-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="moneda-pesos" class="buscar-opcion-boton">Pesos</buton>
                    </li>
                    <li class="buscar-opcion">
                      <svg id="moneda-dolares-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="moneda-dolares-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="moneda-dolares" class="buscar-opcion-boton">Dolares</buton>
                    </li>
                  
                  </ul>
                </li>
                <li>
                  <h3 class="buscar-titulo">Precio:</h3>
                  <form class="buscar-precio">  
                    <span class="precio-filtro" id="precio-filtro"></span>
                    <input onblur="validar_precio(this)" class="buscar-precio-entrada" placeholder="Minimo" type="text" name="min" id="precio-min">
                    <input onblur="validar_precio(this)" class="buscar-precio-entrada" placeholder="Maximo" type="text" name="max" id="precio-max">
                    <buton onclick="rango_precio(this)" id="precio" class="buscar-precio-boton">Buscar</buton>
                  </form>
                </li>

                <li>
                  <h3 class="buscar-titulo">Barrio:</h3>
                  <form>
                    <select id="barrio" onchange="barrios(this)" name="barrio" class="buscar-barrio">
                    <option value="Ninguno">Ninguno</option>
                    <option value="Agronomía">Agronomía</option>
                    <option value="Almagro">Almagro</option>
                    <option value="Balvanera">Balvanera</option>
                    <option value="Barracas">Barracas</option>
                    <option value="Belgrano">Belgrano</option>
                    <option value="Boedo">Boedo</option>
                    <option value="Caballito">Caballito</option>
                    <option value="Chacarita">Chacarita</option>
                    <option value="Coghlan">Coghlan</option>
                    <option value="Colegiales">Colegiales</option>
                    <option value="Constitución">Constitución</option>
                    <option value="Flores">Flores</option>
                    <option value="Floresta">Floresta</option>
                    <option value="La Boca">La Boca</option>
                    <option value="La Paternal">La Paternal</option>
                    <option value="Liniers">Liniers</option>
                    <option value="Mataderos">Mataderos</option>
                    <option value="Monte Castro">Monte Castro</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Nueva Pompeya">Nueva Pompeya</option>
                    <option value="Nuñez">Nuñez</option>
                    <option value="Palermo">Palermo</option>
                    <option value="Parque Avellaneda">Parque Avellaneda</option>
                    <option value="Parque Chacabuco">Parque Chacabuco</option>
                    <option value="Parque Chas">Parque Chas</option>
                    <option value="Parque Patricios">Parque Patricios</option>
                    <option value="Puerto Madero">Puerto Madero</option>
                    <option value="Recoleta">Recoleta</option>
                    <option value="Retiro">Retiro</option>
                    <option value="Saavedra">Saavedra</option>
                    <option value="San Cristóbal">San Cristóbal</option>
                    <option value="San Nicolás">San Nicolás</option>
                    <option value="San Telmo">San Telmo</option>
                    <option value="Versalles">Versalles</option>
                    <option value="Villa Crespo">Villa Crespo</option>
                    <option value="Villa Devoto">Villa Devoto</option>
                    <option value="Villa General Mitre">Villa General Mitre</option>
                    <option value="Villa Lugano">Villa Lugano</option>
                    <option value="Villa Luro">Villa Luro</option>
                    <option value="Villa Ortúzar">Villa Ortúzar</option>
                    <option value="Villa Pueyrredón">Villa Pueyrredón</option>
                    <option value="Villa Real">Villa Real</option>
                    <option value="Villa Riachuelo">Villa Riachuelo</option>
                    <option value="Villa Santa Rita">Villa Santa Rita</option>
                    <option value="Villa Soldati">Villa Soldati</option>
                    <option value="Villa Urquiza">Villa Urquiza</option>
                    <option value="Villa del Parque">Villa del Parque</option>
                    <option value="Vélez Sarsfield">Vélez Sarsfield</option>

                    </select>
                  </form>
                </li>
                
                <li>
                  <h3 class="buscar-titulo">Ambientes:</h3>
                  <ul>
                    <li class="buscar-opcion">
                      <svg id="ambientes-uno-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="ambientes-uno-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="ambientes-uno" class="buscar-opcion-boton">1 ambiente</buton>
                    </li>
                    <li class="buscar-opcion">
                      <svg id="ambientes-dos-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="ambientes-dos-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="ambientes-dos" class="buscar-opcion-boton">2 ambientes</buton>
                    </li>
                    <li class="buscar-opcion">
                      <svg id="ambientes-tres-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="ambientes-tres-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="ambientes-tres" class="buscar-opcion-boton">3 ambientes</buton>
                    </li>
                    <li class="buscar-opcion">
                      <svg id="ambientes-cuatro-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="ambientes-cuatro-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="ambientes-cuatro"  class="buscar-opcion-boton">4 o más ambientes</buton>
                    </li>
                  
                  </ul>
                </li>
                <li>
                  <h3 class="buscar-titulo">Baños:</h3>
                  <ul>
                    <li class="buscar-opcion">
                      <svg id="baños-uno-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="baños-uno-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="baños-uno" class="buscar-opcion-boton">1 baño</buton>
                    </li>
                    <li class="buscar-opcion">
                      <svg id="baños-dos-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="baños-dos-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="baños-dos" class="buscar-opcion-boton">2 baños</buton>
                    </li>
                    <li class="buscar-opcion">
                      <svg id="baños-tres-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="baños-tres-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="baños-tres" class="buscar-opcion-boton">3 o más baños</buton>
                    </li>
                  
                  </ul>
                </li>

                <li>
                  <h3 class="buscar-titulo">Comodidades:</h3>
                  <ul>
                    <li class="buscar-opcion">
                      <svg id="aire-tiene-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="aire-tiene-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="aire-tiene" class="buscar-opcion-boton">Aire acondicionado</buton>
                    </li>
                    <li class="buscar-opcion">
                      <svg id="balcon-tiene-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="balcon-tiene-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="balcon-tiene" class="buscar-opcion-boton">Balcon</buton>
                    </li>

                    <li class="buscar-opcion">
                      <svg id="pileta-tiene-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="pileta-tiene-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="pileta-tiene" class="buscar-opcion-boton">Pileta</buton>
                    </li>
                    
                    <li class="buscar-opcion">
                      <svg id="jardin-tiene-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="jardin-tiene-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="jardin-tiene" class="buscar-opcion-boton">Jardin</buton>
                    </li>
                    
                    <li class="buscar-opcion">
                      <svg id="gym-tiene-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="gym-tiene-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="gym-tiene" class="buscar-opcion-boton">Gimnasio</buton>
                    </li>
                    
                    <li class="buscar-opcion">
                      <svg id="estacionamiento-tiene-off" class="checkbox-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <svg id="estacionamiento-tiene-on" class="checkbox-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.0.0-beta3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2021 Fonticons, Inc. --><path d="M335 175L224 286.1L176.1 239c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l64 64C211.7 341.7 217.8 344 224 344s12.28-2.344 16.97-7.031l128-128c9.375-9.375 9.375-24.56 0-33.94S344.4 165.7 335 175zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/></svg>
                      <buton onclick="prop_consulta(this.id)" id="estacionamiento-tiene" class="buscar-opcion-boton">Estacionamiento</buton>
                    </li>
                  
                  </ul>
                </li>



              </ul>
          </aside>
          <section id="vacio"  class="prop-vacio colapse">
            <h2 class="prop-vacio-titulo">Lo sentimos, no encontramos resultados que cumplan con tus parametros de busqueda</h2>
            <span class="prop-vacio-msj">Podes probar con otra combinacion de parametros o quitar todos los filtros:</span>
            <div class="prop-vacio-boton"><button onclick="mostrar_todo()" class=" boton">Mostrar todo</button></div>
          </section>
          
          <section id="resultados"class="prop-contenedor expand">

            <ol  class="prop-fila ">
              <li> 
                <a id="0-a" href="propiedad-detalle.php" class="prop show">

                  <img id="0-img" class="prop-img" alt="propiedad" src="..\assets\usuarios\7\96\1.jpg"/>
                  <div class="prop-info">
                    <span id="0-precio" class="prop-txt-precio ">USD 100k</span>
                    <span id="0-estado" class="prop-txt ">Departamento en venta</span>
                    <span id="0-tamaño" class="prop-txt ">2 ambientes, 1 baño</span>
                    <span id="0-dir" class="prop-txt ">Av. Santa Fe 3500, Palermo, Capital Federal</span>
                    
                    
                  </div>
                </a>
              </li>

              <li> 
                <a id="1-a" href="#" class="prop show">

                  <img id="1-img" class="prop-img" alt="propiedad" src="..\assets\usuarios\7\96\1.jpg"/>
                  <div class="prop-info">
                    <span id="1-precio" class="prop-txt-precio ">USD 100k</span>
                    <span id="1-estado" class="prop-txt ">Departamento en venta</span>
                    <span id="1-tamaño" class="prop-txt ">2 ambientes, 1 baño</span>
                    <span id="1-dir" class="prop-txt ">Av. Santa Fe 3500, Palermo, Capital Federal</span>
                    
                    
                  </div>
                </a>
              </li>
              <li> 
                <a id="2-a" href="#" class="prop show">

                  <img id="2-img" class="prop-img" alt="propiedad" src="..\assets\usuarios\7\96\1.jpg"/>
                  <div class="prop-info">
                    <span id="2-precio" class="prop-txt-precio ">USD 100k</span>
                    <span id="2-estado" class="prop-txt ">Departamento en venta</span>
                    <span id="2-tamaño" class="prop-txt ">2 ambientes, 1 baño</span>
                    <span id="2-dir" class="prop-txt ">Av. Santa Fe 3500, Palermo, Capital Federal</span>
                    
                    
                  </div>
                </a>
              </li>

            </ol>
            <ol  class="prop-fila ">
              <li> 
                <a id="3-a" href="#" class="prop show">

                  <img id="3-img" class="prop-img" alt="propiedad" src="..\assets\usuarios\7\96\1.jpg"/>
                  <div class="prop-info">
                    <span id="3-precio" class="prop-txt-precio ">USD 100k</span>
                    <span id="3-estado" class="prop-txt ">Departamento en venta</span>
                    <span id="3-tamaño" class="prop-txt ">2 ambientes, 1 baño</span>
                    <span id="3-dir" class="prop-txt ">Av. Santa Fe 3500, Palermo, Capital Federal</span>
                    
                    
                  </div>
                </a>
              </li>

              <li> 
                <a id="4-a" href="#" class="prop show">

                  <img id="4-img" class="prop-img" alt="propiedad" src="..\assets\usuarios\7\96\1.jpg"/>
                  <div class="prop-info">
                    <span id="4-precio" class="prop-txt-precio ">USD 100k</span>
                    <span id="4-estado" class="prop-txt ">Departamento en venta</span>
                    <span id="4-tamaño" class="prop-txt ">2 ambientes, 1 baño</span>
                    <span id="4-dir" class="prop-txt ">Av. Santa Fe 3500, Palermo, Capital Federal</span>
                    
                    
                  </div>
                </a>
              </li>
              <li> 
                <a id="5-a" href="#" class="prop show">

                  <img id="5-img" class="prop-img" alt="propiedad" src="..\assets\usuarios\7\96\1.jpg"/>
                  <div class="prop-info">
                    <span id="5-precio" class="prop-txt-precio ">USD 100k</span>
                    <span id="5-estado" class="prop-txt ">Departamento en venta</span>
                    <span id="5-tamaño" class="prop-txt ">2 ambientes, 1 baño</span>
                    <span id="5-dir" class="prop-txt ">Av. Santa Fe 3500, Palermo, Capital Federal</span>
                    
                    
                  </div>
                </a>
              </li>

            </ol>
            <ol  class="prop-fila ">
              <li> 
                <a id="6-a" href="#" class="prop show">

                  <img id="6-img" class="prop-img" alt="propiedad" src="..\assets\usuarios\7\96\1.jpg"/>
                  <div class="prop-info">
                    <span id="6-precio" class="prop-txt-precio ">USD 100k</span>
                    <span id="6-estado" class="prop-txt ">Departamento en venta</span>
                    <span id="6-tamaño" class="prop-txt ">2 ambientes, 1 baño</span>
                    <span id="6-dir" class="prop-txt ">Av. Santa Fe 3500, Palermo, Capital Federal</span>
                    
                    
                  </div>
                </a>
              </li>

              <li> 
                <a id="7-a" href="#" class="prop show">

                  <img id="7-img" class="prop-img" alt="propiedad" src="..\assets\usuarios\7\96\1.jpg"/>
                  <div class="prop-info">
                    <span id="7-precio" class="prop-txt-precio ">USD 100k</span>
                    <span id="7-estado" class="prop-txt ">Departamento en venta</span>
                    <span id="7-tamaño" class="prop-txt ">2 ambientes, 1 baño</span>
                    <span id="7-dir" class="prop-txt ">Av. Santa Fe 3500, Palermo, Capital Federal</span>
                    
                    
                  </div>
                </a>
              </li>
              <li> 
                <a id="8-a" href="#" class="prop show">

                  <img id="8-img" class="prop-img" alt="propiedad" src="..\assets\usuarios\7\96\1.jpg"/>
                  <div class="prop-info">
                    <span id="8-precio" class="prop-txt-precio ">USD 100k</span>
                    <span id="8-estado" class="prop-txt ">Departamento en venta</span>
                    <span id="8-tamaño" class="prop-txt ">2 ambientes, 1 baño</span>
                    <span id="8-dir" class="prop-txt ">Av. Santa Fe 3500, Palermo, Capital Federal</span>
                    
                    
                  </div>
                </a>
              </li>

            </ol>
          </section>
                
            

              











    <!--

      <div class="test">

        <form action="crear_prop.php" method="post" enctype="multipart/form-data">
          <input type="file" name="img">
          <input type="submit" name="prop" value="nueva_prop">
        </form>
    -->


      </div>
    </main>
    <footer>
      <div class="pie">
        <ul>
          <li><h3>Contacto:</h3></li>
          <li class="pie-info">Telefono: 011 1234567</li>
          <li class="pie-info">Correo: contacto@miba.com</li>
          <li class="pie-info">
            Direccion oficinas: Bartolomé Mitre 1500,CABA
          </li>
        </ul>
        <ul>
          <li><h3>Redes Sociales:</h3></li>
          <li class="pie-info">
            <a class="pie-enlace" target="_blank" href="https://twitter.com/"
              >Twitter</a
            >
          </li>
          <li class="pie-info">
            <a
              class="pie-enlace"
              target="_blank"
              href="https://www.facebook.com/"
              >Facebook</a
            >
          </li>
          <li class="pie-info">
            <a
              class="pie-enlace"
              target="_blank"
              href="https://www.instagram.com/"
              >Instagram</a
            >
          </li>
          <li class="pie-info">
            <a
              class="pie-enlace"
              target="_blank"
              href="https://www.linkedin.com/"
              >Linkedin</a
            >
          </li>
        </ul>
        <ul>
          <li><h3>Empresa:</h3></li>
          <li class="pie-info">
            <a class="pie-enlace">Politica de privacidad</a>
          </li>
          <li class="pie-info"><a class="pie-enlace">Terminos de uso</a></li>
          <li class="pie-info">
            <a class="pie-enlace">Preguntas frecuentes</a>
          </li>
        </ul>
      </div>
      <p class="copyright">Copyright © 2019-2021 MIBA S.R.L.</p>
    </footer>
  </body>
</html>