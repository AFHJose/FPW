<?php
session_start()
?>
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
    <link rel="stylesheet" type="text/css" href="../css/crear-prop.css" />
    <script src="../js/validar.js"></script>
    <script src="../js/dinamico.js"></script>
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
    <main class="main-index">
      <form class="prop-formulario" action="../php/crear_prop_db.php" method="post" enctype="multipart/form-data">
        <h2 class="formulario-titulo texto-30">Publicar una propiedad</h2>

        <div class="prop-formulario-nucleo">
          <label class="formulario-etiqueta texto-20" for="autor">Publica:</label>
          <select id="autor" name="autor" class="formulario-entrada texto-20">         
            <option value="propietario">Propietario</option>
            <option value="inmobiliaria">Inmobiliaria</option>
          </select>

          <label class="formulario-etiqueta texto-20" for="tipo">Tipo de propiedad:</label>
          <select onchange="tipo_propiedad(this)" class="formulario-entrada texto-20" name="tipo" id="tipo">
              <option value="Casa">Casa</option>
              <option value="Departamento">Departamento</option>
              <option value="Oficina">Oficina</option>
              <option value="Cochera">Cochera</option>
              <option value="Terreno">Terreno</option>
          </select>

          <label class="formulario-etiqueta texto-20" for="dir">Direccion:</label>
          <input
            onblur="validar_colapse(this,obligatorio_prop)"
            placeholder="Ingrese la direccion"
            type="text"
            id="dir"
            class="formulario-entrada texto-20 valido"
            name="dir"
          />
          <span class="formulario-error texto-18 colapse" id="dir-error"></span>

          <label class="formulario-etiqueta texto-20" for="barrio">Barrio:</label>
            <select id="barrio" name="barrio" class="formulario-entrada texto-20">         
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

          <label class="formulario-etiqueta texto-20" for="superficie">Superficie:</label>
          <input
            onblur="validar_colapse(this,obligatorio_prop)"
            placeholder="Ingrese la superficie total"
            type="text"
            id="superficie"
            class="formulario-entrada texto-20 valido"
            name="superficie"
          />
          <span class="formulario-error texto-18 colapse" id="superficie-error"></span>

          <label class="formulario-etiqueta texto-20"> Moneda:</label>
          <div class="formulario-radio-contenedor" >
            <div class="formulario-radio-contenedor-par">
              <input class="formulario-radio-boton" name="moneda" value="peso" type="radio" id="peso" checked>
              <label class="texto-20" for="peso">Peso</label>
            </div>
            <div class="formulario-radio-contenedor-par">
              <input class="formulario-radio-boton" name="moneda" value="dolar" type="radio" id="dolar">
              <label class="texto-20" for="dolar">Dolar</label>
            </div>
          </div>

          <label class="formulario-etiqueta texto-20"> Tipo de publicacion:</label>
          <div class="formulario-radio-contenedor" >
            <div class="formulario-radio-contenedor-par">
              <input class="formulario-radio-boton" name="tipoPublicacion" value="venta" type="radio" id="venta" checked>
              <label class="texto-20" for="venta">Venta</label>
            </div>
            <div class="formulario-radio-contenedor-par">
              <input class="formulario-radio-boton" name="tipoPublicacion" value="alquiler" type="radio" id="alquiler" >
              <label class="texto-20" for="alquiler">Alquiler</label>
            </div>
          </div>

          <label class="formulario-etiqueta texto-20" for="precio">Precio:</label>
          <input
            onblur="validar_colapse(this,obligatorio_prop)"
            placeholder="Ingrese el precio"
            type="text"
            id="precio"
            class="formulario-entrada texto-20 valido"
            name="precio"
          />
          <span class="formulario-error texto-18 colapse" id="precio-error"></span>

          <div class="formulario-carga-img" >
              
            <label class="formulario-etiqueta texto-20" for="img">Imagen:</label>
            <input onchange="archivo_cargado(obligatorio_prop)" class="formulario-entrada texto-20" type="file" name="img" id="img" accept="image/jpeg , image/jpg, image/gif , image/png">
            
          </div>
          <span class="condiciones-img">Hasta 20 mb, Formatos aceptados: .jpeg .jpg .gif .png</span>
        
        </div>

        <div id="general" class="prop-formulario-sub grid">
          
          <label class="formulario-etiqueta texto-20" for="supCubierta">Superficie cubierta:</label>
          <input
            onblur="validar_supC(this,obligatorio_prop)"
            placeholder="Ingrese la superficie cubierta"
            type="text"
            id="supCubierta"
            class="formulario-entrada texto-20 valido"
            name="supCubierta"
          />
          <span class="formulario-error texto-18 colapse" id="supCubierta-error"></span>

          <label class="formulario-etiqueta texto-20" for="antiguedad">Antiguedad:</label>
          <input
            onblur="validar_antiguedad(this,obligatorio_prop)"
            placeholder="Ingrese la fecha de construcción"
            type="text"
            id="antiguedad"
            class="formulario-entrada texto-20 valido"
            name="antiguedad"
          />
          <span class="formulario-error texto-18 colapse" id="antiguedad-error"></span>


          <label class="formulario-etiqueta texto-20" for="ambientes">Ambientes:</label>
          <select id="ambientes" name="ambientes" class="formulario-entrada texto-20">
            <option value="1">Uno</option>
            <option value="2">Dos</option>
            <option value="3">Tres</option>
            <option value="4">Cuatro o más</option>
          </select>

          <label class="formulario-etiqueta texto-20" for="baños">Baños:</label>
          <select id="baños" name="baños" class="formulario-entrada texto-20">
            <option value="1">Uno</option>
            <option value="2">Dos</option>
            <option value="3">Tres o más</option>
          </select>

          <label class="formulario-etiqueta texto-20"> Comodidades:</label>
          <div class="formulario-radio-contenedor" >
            <div class="formulario-radio-contenedor-par">
              <input class="formulario-radio-boton" name="aire" value="tiene" type="checkbox" id="aire" >
              <label class="texto-18" for="aire">Aire acondicionado</label>
            </div>
            <div class="formulario-radio-contenedor-par">
              <input class="formulario-radio-boton" name="balcon" value="tiene" type="checkbox" id="balcon" >
              <label class="texto-20" for="balcon">Balcon</label>
            </div>
          </div>
          <div class="formulario-radio-contenedor" >
            <div class="formulario-radio-contenedor-par">
              <input class="formulario-radio-boton" name="pileta" value="tiene" type="checkbox" id="pileta" >
              <label class="texto-20" for="pileta">Pileta</label>
            </div>
            <div class="formulario-radio-contenedor-par">
              <input class="formulario-radio-boton" name="jardin" value="tiene" type="checkbox" id="Jardin" >
              <label class="texto-20" for="Jardin">Jardin</label>
            </div>
          </div>
          <div class="formulario-radio-contenedor" >
            <div class="formulario-radio-contenedor-par">
              <input class="formulario-radio-boton" name="gym" value="tiene" type="checkbox" id="gym" >
              <label class="texto-20" for="gym">Gimnasio</label>
            </div>
            <div class="formulario-radio-contenedor-par">
              <input class="formulario-radio-boton" name="estacionamiento" value="tiene" type="checkbox" id="estacionamiento" >
              <label class="texto-20" for="estacionamiento">Estacionamiento</label>
            </div>
          </div>
          
        </div>

        
        <div id="cochera" class="prop-formulario-sub colapse">
          
          <label class="formulario-etiqueta texto-20" for="supCubiertaC">Superficie cubierta:</label>
          <input
            onblur="validar_supC(this,obligatorio_prop)"
            placeholder="Ingrese la superficie cubierta"
            type="text"
            id="supCubiertaC"
            class="formulario-entrada texto-20 valido"
            name="supCubierta"
          />
          <span class="formulario-error texto-18 colapse" id="supCubiertaC-error"></span>

          <label class="formulario-etiqueta texto-20" for="antiguedadC">Antiguedad:</label>
          <input
            onblur="validar_antiguedad(this,obligatorio_prop)"
            placeholder="Ingrese la fecha de construcción"
            type="text"
            id="antiguedadC"
            class="formulario-entrada texto-20 valido"
            name="antiguedad"
          />
          <span class="formulario-error texto-18 colapse" id="antiguedadC-error"></span>

        </div>


        <div class="formulario-botones">
          <input
            type="submit"
            id="ingresar"
            class="ingreso-boton off"
            value="Crear publicacion"
            disabled
          />
        </div>
      </form>
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