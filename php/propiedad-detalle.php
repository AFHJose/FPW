<?php
session_start();
include "conexion.php";
$conexion = OpenCon();
if($conexion)
{
  $sql="SELECT * FROM propiedades INNER JOIN usuarios ON propiedades.id_usuario = usuarios.id_usuario WHERE id_prop=".$_GET["id_prop"];
  $resultado=$conexion->query($sql)->fetch_assoc();
}

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

          <img class="img-section" src=<?php echo "\"". $resultado["img_path"]."\""; ?> >
          <section class="caracteristicas-section fondo-blanco-borde-gris" >
              <h3 class="texto-24">Caracteristicas:</h3>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta top-left border">Superficie Cubierta:</span>
                <span class="prop-d-valor top-right border"><?php if($resultado["tipo"]!="Terreno"){echo $resultado["superficie_cubierta"]." m<sup>2</sup>";}else{echo "-";} ?> </span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Ambientes:</span>
                <span class="prop-d-valor center-right border"><?php if($resultado["tipo"]!="Terreno" AND $resultado["tipo"]!="Cochera"){echo $resultado["ambientes"];}else{echo "-";} ?></span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Baños:</span>
                <span class="prop-d-valor center-right border"><?php if($resultado["tipo"]!="Terreno" AND $resultado["tipo"]!="Cochera"){echo $resultado["baños"];}else{echo "-";} ?></span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Antiguedad:</span>
                <span class="prop-d-valor center-right border"><?php if($resultado["tipo"]!="Terreno"){echo $resultado["antiguedad"]." años";}else{echo"-";} ?></span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Aire acondicionado:</span>
                <span class="prop-d-valor center-right border"><?php if($resultado["aire"]==1 AND $resultado["tipo"]!="Terreno" AND $resultado["tipo"]!="Cochera"){echo "Tiene";}else{echo "No tiene";}?></span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Balcon:</span>
                <span class="prop-d-valor center-right border"><?php if($resultado["balcon"]==1 AND $resultado["tipo"]!="Terreno" AND $resultado["tipo"]!="Cochera"){echo "Tiene";}else{echo "No tiene";}?></span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Pileta:</span>
                <span class="prop-d-valor center-right border"><?php if($resultado["pileta"]==1 AND $resultado["tipo"]!="Terreno" AND $resultado["tipo"]!="Cochera"){echo "Tiene";}else{echo "No tiene";}?></span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Jardin:</span>
                <span class="prop-d-valor center-right border"><?php if($resultado["jardin"]==1 AND $resultado["tipo"]!="Terreno" AND $resultado["tipo"]!="Cochera"){echo "Tiene";}else{echo "No tiene";}?></span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta center-left border">Gimnasio:</span>
                <span class="prop-d-valor center-right border"><?php if($resultado["gym"]==1 AND $resultado["tipo"]!="Terreno" AND $resultado["tipo"]!="Cochera"){echo "Tiene";}else{echo "No tiene";}?></span>
              </div>
              <div class="prop-d-dato">
                <span class="prop-d-etiqueta bot-left border">Estacionamiento:</span>
                <span class="prop-d-valor bot-right border"><?php if($resultado["estacionamiento"]==1 AND $resultado["tipo"]!="Terreno" AND $resultado["tipo"]!="Cochera"){echo "Tiene";}else{echo "No tiene";}?></span>
              </div>

          </section>
          <section class="precio-section fondo-blanco-borde-gris">
            <h2 class="precio-txt alinear-texto-izq texto-30"><?php if($resultado["venta"]!=0){echo strtoupper($resultado["tipo"])." EN VENTA";}else{echo strtoupper($resultado["tipo"])." EN ALQUILER";}?></h2>
            <div class="prop-d-dato">
              <span class="texto-izq texto-36 top-left border">Precio:</span>
              <span class="texto-der texto-36 top-right border"> 
                <?php 
              if($resultado["dolar"]==1){
                $moneda=" USD";

              }else{
                $moneda=" ARS";
              }
              if($resultado["venta"]!=0)
              {
                echo $resultado["venta"].$moneda;
              }else{
                echo $resultado["alquiler"].$moneda;
              }
              ?>
              </span>
            </div>
            <div class="prop-d-dato">
              <span class="texto-izq texto-20 center-left border">Superficie:</span>
              <span class="texto-der texto-20 center-right border"><?php echo $resultado["superficie"]; ?> m<sup>2</sup></span>
            </div>
            <div class="prop-d-dato">
              <span class="texto-izq texto-20 center-left border">Direccion:</span>
              <span class="texto-der texto-20 center-right border"><?php echo $resultado["dir"]; ?></span>
            </div>
            <div class="prop-d-dato">
              <span class="texto-izq texto-20 center-left border">Barrio:</span>
              <span class="texto-der texto-20 center-right border"><?php echo $resultado["barrio"]; ?></span>
            </div>
            <div class="prop-d-dato">
              <span class="texto-izq texto-20 center-left border">Publica:</span>
              <span class="texto-der texto-20 center-right border"><?php echo $resultado["usuario"]; ?></span>
            </div>
            <div class="prop-d-dato">
              <span class="texto-izq texto-20 center-left border">Autor:</span>
              <span class="texto-der texto-20 center-right border"><?php echo $resultado["autor"]; ?></span>
            </div>

            <div class="prop-d-dato">
              <span class="texto-izq texto-20 bot-left border">Certificacion MIBA:</span>
              <span class="texto-der texto-20 bot-right border"><?php if($resultado["certificada"]==1){echo "Tiene";}else{echo "No tiene";}?></span>
            </div>
            <?php
              if($resultado["id_usuario"]==$_SESSION["id_usuario"])
              {
                echo <<<HEREDOC
                <div class="botones-usuario">
                <a href="prop-mod.php?id_prop=$_GET[id_prop]" class="boton">Modificar Publicacion</a>
                <a href="borrar_prop.php?id_prop=$_GET[id_prop]" class="boton">Eliminar Publicacion</a>
                </div>

                HEREDOC;
              }else
              {
                echo <<<HEREDOC
                <div class="centrar-boton"><button class="boton contacto">Contactar <?php echo $resultado[usuario]; ?></button></div>
                HEREDOC;
              }


            ?>
            
          </section>
          <section class="ofertas-section fondo-blanco-borde-gris">
            <h3 class="texto-24">Propuestas:</h3>
            <div class="ofertas-filtros">
              <button class="boton">Vigentes</button>
              <button class="boton">Vencidas</button>
              <button class="boton">Rechazadas</button>
            </div>
              <form class="ofertas-ordenar">
                <label class="ofertas-ordenar-etiqueta texto-20" for="ordenar">Ordenar por:</label>
                <select class="ofertas-ordenar-categoria texto-16" id="ordenar-cat" name="ordenar-cat">
                  <option>Fecha de creacion </option>
                  <option>Monto en dolares</option>
                  <option>Monto en pesos</option>
                  <option>Cantidad de propiedades</option>
                  <option>Fecha de vencimiento</option>
                </select>
                
                <select class="ofertas-ordenar-categoria texto-16" id="ordenar-modo" name="ordenar-modo">
                  <option>Ascendiente</option>
                  <option>Descendiente</option>
   
                </select>
              </form>
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