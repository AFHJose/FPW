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
  </head>
  <body>
    <header class="cabecera">
      <div class="portada">
        <a class="portada-enlace" href="http://localhost/FPW/html/index.html"
          ><h1 class="portada-texto">Mercado Inmobiliario Buenos Aires</h1></a
        >
      </div>

      <div class="menu-contenedor">
        <nav class="nav">
          <ul class="menu">
            <li class="menu-enlance">
              <a><span>Comprar </span></a>
            </li>
            <li class="menu-enlance">
              <a><span>Alquilar </span></a>
            </li>
            <li class="menu-enlance">
              <a><span>Vender </span></a>
            </li>
            <li class="menu-enlance">
              <a><span>Servicios administrativos </span></a>
            </li>
          </ul>
        </nav>
        <ul class="cuenta">
          <?php
            
            if(!isset($_COOKIE["miba"]))
            {
              // borrar variables
              session_unset();
              // destruir la session
              session_destroy();
            }else if (isset($_SESSION["id_usuario"]) AND hash("sha3-512",$_SESSION["id_usuario"]) == $_COOKIE["miba"])
            {
              $usuario = $_SESSION["usuario"];
              echo <<<HEREDOC
               <li class="menu-enlace"> <span>$usuario</span></li>
               HEREDOC;
            }else
            {
              // borrar variables
              session_unset();
              // destruir la session
              session_destroy();
              echo <<<HEREDOC
              <li class="menu-enlance cuenta-ingreso">
                <a class="cabecera-enlace" href="login.html"
                  ><span>Ingresar </span></a
                >
              </li>
              <li class="menu-enlance cuenta-registro">
                <a><span>Crear cuenta</span></a>
              </li>
              HEREDOC;
            }
            

          
          ?>
        </ul>
      </div>
    </header>
    <main>
      <section class="propuestas">
        <div class="propuestas-info">
          <h2 class="propuestas-titulo">¿Cuanto queres pagar?</h2>
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
          <a class="mas-info-contenedor"
            ><span class="mas-info">Mas informacion</span></a
          >
        </div>

        <img
          class="propuestas-img"
          src="../assets/img/trato.jpg"
          alt="negociar"
        />
      </section>

      <section class="propuestas">
        <div class="propuestas-info">
          <h2 class="propuestas-titulo">¿Todo en orden?</h2>
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
          <a class="mas-info-contenedor"
            ><span class="mas-info">Mas informacion</span></a
          >
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
            operaciones a lo largo del año o incluso cuando es apropiado
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
          <a class="mas-info-contenedor"
            ><span class="mas-info">Mas informacion</span></a
          >
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
            locacion tradicionales con un plazo minimo de tres años, como
            contratos temporarios con un plazo maximo de tres meses. Este
            servicio permite que el propietario obtenega y disfrute de su renta
            sin tener que preocuparse por los detalles.
          </p>
          <a class="mas-info-contenedor"
            ><span class="mas-info">Mas informacion</span></a
          >
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
          <a class="mas-info-contenedor"
            ><span class="mas-info">Mas informacion</span></a
          >
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
