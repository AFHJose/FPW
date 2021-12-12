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
    <link rel="stylesheet" type="text/css" href="../css/prop.css" />
    <link rel="stylesheet" type="text/css" href="../css/prop-d.css" />
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
    <main class="main-prop-d">

        <div class="prop-d-contenedor">

          <img class="prop-d-img" src="..\assets\usuarios\7\96\1.jpg">
          <section class="prop-d-texto" >
              <h3 class="caracteristicas">Caracteristicas:</h3>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta top-left border">Direccion:</span>
                <span class="prop-d-valor top-right border">Av. Santa Fe 3500, Palermo, Capital Federal</span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Ambientes:</span>
                <span class="prop-d-valor center-right border">Uno</span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Baños:</span>
                <span class="prop-d-valor center-right border">Uno</span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Aire acondicionado:</span>
                <span class="prop-d-valor center-right border">Tiene</span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Balcon:</span>
                <span class="prop-d-valor center-right border">NO Tiene</span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Pileta:</span>
                <span class="prop-d-valor center-right border">Tiene</span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Jardin:</span>
                <span class="prop-d-valor center-right border">NO Tiene</span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Gimnasio:</span>
                <span class="prop-d-valor center-right border">Tiene</span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta bot-left border">Estacionamiento:</span>
                <span class="prop-d-valor bot-right border">Tiene</span>
              </div>

          </section>
          <section class="prop-d-precio">
            <h2 class="prop-d-titulo texto-30">CASA EN VENTA</h2>
            <div class="prop-d-dato">
              <span class="texto-izq texto-24">Administrador:</span>
              <span class="texto-der texto-24">Abisha</span>
            </div>
            <div class="prop-d-dato">
              <span class="texto-izq texto-20">Precio:</span>
              <span class="texto-der texto-20">100K USD</span>
            </div>
            <div class="prop-d-dato">
              <span class="texto-izq texto-20">Certificacion MIBA:</span>
              <span class="texto-der texto-20">No Tiene</span>
            </div>
              
            <div class="centrar-boton"><button class="boton contacto">Contactar Administrador</button></div>
          </section>
          <section class="ofertas-section">
            <div class="ofertas-filtros">
              <h3 class="ofertas">Ofertas:</h3>
              <button class="boton">Vigentes</button>
              <button class="boton">Vencidas</button>
              <button class="boton">Rechazadas</button>
              <form>
                <label>Ordenar por:</label>
                <select>
                  <option>Creacion </option>
                  <option>Dolares</option>
                  <option>Pesos</option>
                  <option>Propiedades</option>
                  <option>Vencimiento</option>
                </select>
              </form>
            </div>
            <secti class="prop-d-ofertas-contenedor">
              <div class="prop-d-oferta grid">
                <span class="prop-d-oferta-titulo">Creacion:</span>
                <span class="prop-d-oferta-titulo">Valor:</span>
                <span class="prop-d-oferta-titulo">Vencimiento:</span>
                <span class="prop-d-oferta-titulo">Estado:</span>
              </div>
              <button id="o-1" onclick="mostrar_ocultar('o-1-d','flex')" class="prop-d-oferta efecto-hover grid ">
                <span>11/12/2021</span>
                <span>50K USD 3 Propiedades</span>
                <span>30/12/2021</span>
                <span>VIGENTE</span>
              </button>
              <div id="o-1-d" class="prop-d-oferta-detalle colapse">
                <div class="prop-d-dato">
                  <span class="oferta-detalles-titulo center border">Detalles de la oferta:</span>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Autor:</span>
                  <span class="prop-d-valor center-right border">Omar</span>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Dinero:</span>
                  <span class="prop-d-valor center-right border">50K USD</span>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Dinero:</span>
                  <span class="prop-d-valor center-right border">5M ARS</span>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Propiedad:</span>
                  <a><span class="prop-d-valor center-right border">Casa 100m2 en mitre 1500, belgrano, caba</span></a>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Propiedad:</span>
                  <a><span class="prop-d-valor center-right border">Depto 60m2 en mitre 1500, belgrano, caba</span></a>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta bot-left border">Propiedad:</span>
                  <a><span class="prop-d-valor bot-right border">Terreno 40m2 en mitre 1500, belgrano, caba</span></a>
                </div>
                <div class="centrar-boton"><button class="boton contacto">Contactar Oferente</button></div>
                
              </div>


              <button id="o-1" onclick="mostrar_ocultar('o-2-d','flex')" class="prop-d-oferta efecto-hover grid ">
                <span>11/12/2021</span>
                <span>50K USD 3 Propiedades</span>
                <span>30/12/2021</span>
                <span>VIGENTE</span>
              </button>
              <div id="o-2-d" class="prop-d-oferta-detalle colapse">
                <div class="prop-d-dato">
                  <span class="oferta-detalles-titulo center border">Detalles de la oferta:</span>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Autor:</span>
                  <span class="prop-d-valor center-right border">Omar</span>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Dinero:</span>
                  <span class="prop-d-valor center-right border">50K USD</span>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Dinero:</span>
                  <span class="prop-d-valor center-right border">5M ARS</span>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Propiedad:</span>
                  <a><span class="prop-d-valor center-right border">Casa 100m2 en mitre 1500, belgrano, caba</span></a>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Propiedad:</span>
                  <a><span class="prop-d-valor center-right border">Depto 60m2 en mitre 1500, belgrano, caba</span></a>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta bot-left border">Propiedad:</span>
                  <a><span class="prop-d-valor bot-right border">Terreno 40m2 en mitre 1500, belgrano, caba</span></a>
                </div>
                <div class="centrar-boton"><button class="boton contacto">Contactar Oferente</button></div>
                
              </div>


              <button id="o-1" onclick="mostrar_ocultar('o-3-d','flex')" class="prop-d-oferta efecto-hover grid ">
                <span>11/12/2021</span>
                <span>50K USD 3 Propiedades</span>
                <span>30/12/2021</span>
                <span>VIGENTE</span>
              </button>
              <div id="o-3-d" class="prop-d-oferta-detalle colapse">
                <div class="prop-d-dato">
                  <span class="oferta-detalles-titulo center border">Detalles de la oferta:</span>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Autor:</span>
                  <span class="prop-d-valor center-right border">Omar</span>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Dinero:</span>
                  <span class="prop-d-valor center-right border">50K USD</span>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Dinero:</span>
                  <span class="prop-d-valor center-right border">5M ARS</span>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Propiedad:</span>
                  <a><span class="prop-d-valor center-right border">Casa 100m2 en mitre 1500, belgrano, caba</span></a>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta center-left border">Propiedad:</span>
                  <a><span class="prop-d-valor center-right border">Depto 60m2 en mitre 1500, belgrano, caba</span></a>
                </div>
                <div class="prop-d-dato">
                  <span class="prop-d-etiqueta bot-left border">Propiedad:</span>
                  <a><span class="prop-d-valor bot-right border">Terreno 40m2 en mitre 1500, belgrano, caba</span></a>
                </div>
                <div class="centrar-boton"><button class="boton contacto">Contactar Oferente</button></div>
                
              </div>
            
          </section>  
            </div>
           

        </div>
          

    <!--

      <div class="test">

        <form action="crear_prop.php" method="post" enctype="multipart/form-data">
          <input type="file" name="img">
          <input type="submit" name="prop" value="nueva_prop">
        </form>
    -->


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