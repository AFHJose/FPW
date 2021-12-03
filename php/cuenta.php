<?php
session_start()
?>
<!-- Abrir pagina con live server 127.0.0.1:5500/html/index.html -->
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>INDEX-TEST</title>
    <link rel="stylesheet" type="text/css" href="../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../css/index.css" />
    <link rel="stylesheet" type="text/css" href="../css/cuenta.css" />
    <link rel="stylesheet" type="text/css" href="../css/login.css" />
    <script src="../js/validar.js"></script>
    <script src="../js/dinamico.js"></script>
    <script src="../js/usuario.js"></script>
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
              <a class="enlace-boton"><span class="enlace-texto">Comprar </span></a>
            </li>
            <li>
              <a class="enlace-boton"><span class="enlace-texto">Alquilar </span></a>
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
              <a href="../html/cuenta-nueva.html"class="enlace-boton"><span class="enlace-texto">Crear cuenta</span></a>
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
                <li class="cuenta-menu-item" ><a class="enlace-boton"><span class="enlace-texto">Cuenta</span></a></li>
                <li class="cuenta-menu-item" ><a class="enlace-boton"><span class="enlace-texto">Propiedades</span></a></li>
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
    <main>
     <div class="panel-cuenta">
        <h2 id="usuario" class="usuario">Usuario: <?php echo ($_SESSION["usuario"]); ?></h2>

        
        <div class="correo expand" id="correo-show">
            <span class="texto-grande etiqueta-actualizar-correo">Correo:</span>
            <span id="correo-texto" class="texto-grande entrada-actualizar-correo "><?php echo ($_SESSION["correo"]); ?></span>
            <div class="botones-actualizar-correo"><a href="javascript:correo_formulario();"><span class="boton">Cambiar Correo</span></a></div>      
        </div>

        <form class="correo colapse" id="correo-form" action="javascript:correo_actualizar();" method="post">
            <label class="texto-grande etiqueta-actualizar-correo" for="correo">Correo:</label>
            <input
            onblur="validar(this,obligatorio_actualizar_correo)"
            placeholder="Ingrese su correo"
            type="text"
            id="correo"
            class="entrada-actualizar-correo valido"
            name="correo"
            />
            <span class="error-actualizar-correo" id="correo-error"></span>
            <div class="botones-actualizar-correo">
            <input
                type="submit"
                id="ingresar"
                class="ingreso-boton off"
                value="Actualizar"
                disabled
            />
            <a href="javascript:test();"><span class="boton" >Cancelar</span></a>
            </div>
            </form>
        <div class="contraseña"><a><span>Cambiar contraseña</span></a></div>
        <a><span>Mis Propiedades</span></a>
        <a><span>Mis Ofertas</span></a>
        <div class="eliminar"><a><span>Eliminar Cuenta</span></a></div>



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