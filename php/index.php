<?php
session_start();
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
              <a href="propiedades.php?modo=compra" class="enlace-boton"><span class="enlace-texto">Comprar </span></a>
            </li>
            <li>
              <a href="propiedades.php?modo=alquiler" class="enlace-boton"><span class="enlace-texto">Alquilar </span></a>
            </li>
            <?php
              if(isset($_SESSION["id_usuario"]))
              {
                echo <<<HEREDOC
                <li>
                  <a href="crear_prop.php"class="enlace-boton"><span class="enlace-texto">Publicar </span></a>
                </li>

                HEREDOC;
              }

            ?>
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
    <main class="main-index">
      <section class="propuestas">
        <div class="propuestas-info">
          <h2 class="propuestas-titulo">??Cuanto queres pagar?</h2>
          <p class="propuestas-texto">
            Digamos que encontraste la propiedad perfecta para tus necesidades,
            esta en una ubicacion conveniente, es lo suficientemente grande para
            que vivas comodo y ademas tiene esos extras que para voz marcan la
            diferencia como un gimnasio, una pileta, un garaje o incluso hasta
            un salon de eventos.Pero el precio publicado no es lo que podes o
            queres pagar.
          </p>
          <p class="propuestas-texto">
            En MIBA tenemos un sistema que permite publicar ofertas tanto en
            dinero como en propiedades acercando posiciones entre compradores y
            vendedores, generando un espacio de discusion y negociacion que
            ayuda a concretar mas tratos.
          </p>
        </div>

        <img
          class="propuestas-img"
          src="../assets/img/trato.jpg"
          alt="negociar"
        />
      </section>

      <section class="propuestas">
        <div class="propuestas-info">
          <h2 class="propuestas-titulo">??Todo en orden?</h2>
          <p class="propuestas-texto">
            A la hora de comprar un propiedad es importante comprobar que este
            en buenas condiciones, desde lo aparente como la pintura, las
            paredes y la griferia.Hasta aquello que requiere una mirada mas
            detallista como el estado de las instalaciones de agua, luz, gas e
            internet. Como tambien controlar que no hayan problemas legales o
            impositivos que puedan afectar el valor de la misma.
          </p>
          <p class="propuestas-texto">
            MIBA ofrece un servicio de revision exhaustiva y una certificacion
            que garantiza la buena condicion de la propiedad aportanto
            transparencia a los tratos y tranquilidad a los compradores.
          </p>

        </div>
        <img
          class="propuestas-img"
          src="../assets/img/Certificado.jpg"
          alt="negociar"
        />
      </section>

      <section class="propuestas">
        <div class="propuestas-info">
          <h2 class="propuestas-titulo">Para los profesionales</h2>
          <p class="propuestas-texto">
            Como operador en el mercado inmobiliario es importante estar bien
            informado a la hora de tomar decisiones. Ya sea para determinar
            cuando un precio es atractivo basandose en operaciones concretadas
            para propiedades similares o para elegir cuando es el momento
            apropiado para vender utilizando informacion sobre el volumnen de
            operaciones a lo largo del a??o o incluso cuando es apropiado
            invertir en construccion al ver que la oferta en una zona particular
            desaparece y los precios se disparan.
          </p>
          <p class="propuestas-texto">
            MIBA ofrece un servicio de subscripcion el cual otorga accesso a
            todas las estadisticas de las operaciones en la pagina desde el
            comienzo de la misma, ademas de un resumen mensual sobre el estado
            del mercado inmobiliario en Buenos Aires escrito por expertos del
            area y fundamentado en datos estadisticos.
          </p>

        </div>
        <img
          class="propuestas-img"
          src="../assets/img/datos.jpg"
          alt="negociar"
        />
      </section>

      <section class="propuestas">
        <div class="propuestas-info">
          <h2 class="propuestas-titulo">Servicios administrativos</h2>
          <p class="propuestas-texto">
            Alquilar una propiedad es una manera simple y confiable de obtener
            un ingreso pasivo, pero el mantenimiento de la misma y el trato con
            los inquilinos requiere tiempo y puede ser una fuente de estres
            indeseada.
          </p>
          <p class="propuestas-texto">
            MIBA ofrece un servicio de administracion de propiedades donde nos
            encargamos de todas las complicaciones tanto legales como practicas
            asociadas a alquilar una propiedad, manejamos tanto contratos de
            locacion tradicionales con un plazo minimo de tres a??os, como
            contratos temporarios con un plazo maximo de tres meses. Este
            servicio permite que el propietario obtenega y disfrute de su renta
            sin tener que preocuparse por los detalles.
          </p>

        </div>
        <img
          class="propuestas-img"
          src="../assets/img/oficina.jpg"
          alt="negociar"
        />
      </section>

      <section class="propuestas ultima">
        <div class="propuestas-info">
          <h2 class="propuestas-titulo">Vendemos por voz</h2>
          <p class="propuestas-texto">
            El mercado inmobiliario cambia de manera constante, evaluar cuando
            es el momento apropiado para vender, cual es el precio correcto y
            negociar tratos con particulares es un proceso que demanda tiempo y
            dedicacion.
          </p>
          <p class="propuestas-texto">
            MIBA se ofrece a manejar la venta de sus propiedades buscando el
            mejor trato posible segun sus preferencias.
          </p>

        </div>
        <img
          class="propuestas-img"
          src="../assets/img/venta.jpg"
          alt="negociar"
        />
      </section>
    </main>
    <footer>
      <div class="pie">
        <ul>
          <li><h3>Contacto:</h3></li>
          <li class="pie-info">Telefono: 011 1234567</li>
          <li class="pie-info">Correo: contacto@miba.com</li>
          <li class="pie-info">
            Direccion oficinas: Bartolom?? Mitre 1500,CABA
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
      <p class="copyright">Copyright ?? 2019-2021 MIBA S.R.L.</p>
    </footer>
  </body>
</html>
