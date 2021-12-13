var categorias = {
  pagina: [["1", true]],
  tipo: [
    ["compra", false],
    ["alquiler", false],
  ],
  inmueble: [
    ["casa", false],
    ["departamento", false],
    ["oficina", false],
    ["cochera", false],
    ["terreno", false],
  ],
  moneda: [
    ["pesos", false],
    ["dolares", false],
  ],
  ambientes: [
    ["uno", false],
    ["dos", false],
    ["tres", false],
    ["cuatro", false],
  ],
  baños: [
    ["uno", false],
    ["dos", false],
    ["tres", false],
  ],
  aire: [["tiene", false]],
  balcon: [["tiene", false]],
  pileta: [["tiene", false]],
  jardin: [["tiene", false]],
  gym: [["tiene", false]],
  estacionamiento: [["tiene", false]],
  barrio: [
    ["Ninguno", false],
    ["Agronomía", false],
    ["Almagro", false],
    ["Balvanera", false],
    ["Barracas", false],
    ["Belgrano", false],
    ["Boedo", false],
    ["Caballito", false],
    ["Chacarita", false],
    ["Coghlan", false],
    ["Colegiales", false],
    ["Constitución", false],
    ["Flores", false],
    ["Floresta", false],
    ["La Boca", false],
    ["La Paternal", false],
    ["Liniers", false],
    ["Mataderos", false],
    ["Monte Castro", false],
    ["Montserrat", false],
    ["Nueva Pompeya", false],
    ["Nuñez", false],
    ["Palermo", false],
    ["Parque Avellaneda", false],
    ["Parque Chacabuco", false],
    ["Parque Chas", false],
    ["Parque Patricios", false],
    ["Puerto Madero", false],
    ["Recoleta", false],
    ["Retiro", false],
    ["Saavedra", false],
    ["San Cristóbal", false],
    ["San Nicolás", false],
    ["San Telmo", false],
    ["Versalles", false],
    ["Villa Crespo", false],
    ["Villa Devoto", false],
    ["Villa General Mitre", false],
    ["Villa Lugano", false],
    ["Villa Luro", false],
    ["Villa Ortúzar", false],
    ["Villa Pueyrredón", false],
    ["Villa Real", false],
    ["Villa Riachuelo", false],
    ["Villa Santa Rita", false],
    ["Villa Soldati", false],
    ["Villa Urquiza", false],
    ["Villa del Parque", false],
    ["Vélez Sarsfield", false],
  ],
  precio: [["rango", false]],
  superficie: [["rango", false]],
  supCubierta: [["rango", false]],
  autor: [
    ["usuario", false],
    ["propietario", false],
    ["inmobiliaria", false],
    ["miba", false],
  ],
  certificacion: [["miba", false]],
  antiguedad: [
    ["10", false],
    ["50", false],
    ["100", false],
    ["150", false],
    ["200", false],
  ],
};
/*
En pagina 1 desaparece el boton anterior
En la ultima pagina desaparece el boton siguiente
VAR CANTIDAD DE PAGINAS 
VAR PAGINA ACTUAL
BOTONES CON (ACTUAL+1)*12 O(ACTUAL-1)*12
UTILIZAR ORDER BY PROP ID, LIMIT 12 y OFFSET ACTUAL*12 EN SQL PARA FILTRAR LOS RESULTADOS
ENVIAR LA QUERY COMPLETA CADA VEZ QUE SE APRIETA EL BOTON, LA PAGINA ES UNA OPCION MAS
ACTUALIZACION DE VARIABLE PAGINA ACTUAL 
ACTUALIZACION DE VARIABLE TOTAL DE RESULTADOS
CASO ESPECIAL SIN RESULTADOS
resetear CANTIDAD y ACTUAL cuando cambia la QUERY

*/

function actualizar_pag(modo) {
  let show = document.getElementById("resultados-cantidad");
  if (modo) {
    categorias["pagina"][0][0] = String(
      parseInt(categorias["pagina"][0][0]) + 1
    );
  } else {
    categorias["pagina"][0][0] = String(
      parseInt(categorias["pagina"][0][0]) - 1
    );
  }
  show.innerText = categorias["pagina"][0][0] + " DE 30";
}

function constructor_get(id) {
  var get = "";

  if (id != "azar") {
    let k = 0;
    for (let opcion in categorias) {
      for (let x = 0; x < categorias[opcion].length; x++) {
        if (categorias[opcion][x][1]) {
          if (get == "") {
            get +=
              "opcion-" +
              String(k) +
              "=" +
              opcion +
              "-" +
              categorias[opcion][x][0];
          } else {
            get +=
              "&opcion-" +
              String(k) +
              "=" +
              opcion +
              "-" +
              categorias[opcion][x][0];
          }
          k++;
        }
      }
    }
  }
  if (get == "") {
    get = "azar";
  }
  return get;
}
function ocultar(id) {
  let prop = document.getElementById(String(id) + "-a");
  prop.classList.replace("show", "hide");
}
function mostrar(id) {
  let prop = document.getElementById(String(id) + "-a");
  prop.classList.replace("hide", "show");
}
function vacio(modo) {
  let vacio = document.getElementById("vacio");
  let resultados = document.getElementById("resultados");
  if (modo) {
    if (vacio.classList.contains("colapse")) {
      vacio.classList.replace("colapse", "expand");
      resultados.classList.replace("expand", "colapse");
    }
  } else {
    if (resultados.classList.contains("colapse")) {
      resultados.classList.replace("colapse", "expand");
      vacio.classList.replace("expand", "colapse");
    }
  }
}
function mostrar_todo() {
  for (let cat in categorias) {
    for (let i = 0; i < categorias[cat].length; i++) {
      if (
        categorias[cat][i][1] &&
        cat != "barrio" &&
        cat != "precio" &&
        cat != "superficie" &&
        cat != "supCubierta"
      ) {
        checkbox(cat + "-" + categorias[cat][i][0]);
        categorias[cat][i][1] = false;
      } else if (categorias[cat][i][1] && cat == "barrio") {
        categorias[cat][i][1] = false;
      } else if (categorias[cat][i][1] && cat == "precio") {
        categorias[cat][i][1] = false;
        document.getElementById("precio-min").value = null;
        document.getElementById("precio-max").value = null;
        document.getElementById("precio-filtro").innerText = "";
      } else if (categorias[cat][i][1] && cat == "superficie") {
        categorias[cat][i][1] = false;
        document.getElementById("superficie-min").value = null;
        document.getElementById("superficie-max").value = null;
        document.getElementById("superficie-filtro").innerText = "";
      } else if (categorias[cat][i][1] && cat == "supCubierta") {
        categorias[cat][i][1] = false;
        document.getElementById("supCubierta-min").value = null;
        document.getElementById("supCubierta-max").value = null;
        document.getElementById("supCubierta-filtro").innerText = "";
      }
    }
  }
  prop_consulta("azar");
}

function asignar(id, propiedad) {
  document.getElementById(String(id) + "-img").src = propiedad["img_path"];
  if (propiedad["dolar"] == "1") {
    var moneda = "USD ";
  } else {
    var moneda = "ARS ";
  }
  if (propiedad["venta"] == "0") {
    var estado = "en alquiler";
    var precio = propiedad["alquiler"];
  } else {
    var estado = "en venta";
    var precio = propiedad["venta"];
  }
  document.getElementById(String(id) + "-precio").textContent = moneda + precio;
  document.getElementById(String(id) + "-estado").innerHTML =
    propiedad["tipo"] + " " + estado;

  document.getElementById(String(id) + "-tamaño").innerHTML =
    propiedad["superficie"] + " m<sup>2</sup>";

  document.getElementById(String(id) + "-dir").innerHTML =
    propiedad["dir"] + ", " + propiedad["barrio"] + ", Capital Federal";
}

function barrios(elemento) {
  let id = elemento.id + "-" + elemento.options[elemento.selectedIndex].value;
  //console.log(id);
  prop_consulta(id);
}

function validar_precio(elemento) {
  let valor = document.getElementById(elemento.id).value;

  if (valor == "" || valor == null || /^\s*(\d*\D+\d*)+\s*$/.test(valor)) {
    document.getElementById(elemento.id).value = null;
  }
}

function rango_precio(elemento) {
  validar_precio(document.getElementById(elemento.id + "-min"));
  validar_precio(document.getElementById(elemento.id + "-max"));
  let min = document.getElementById(elemento.id + "-min").value;
  let max = document.getElementById(elemento.id + "-max").value;

  let filtro = document.getElementById(elemento.id + "-filtro");
  console.log(min);
  console.log(max);
  if (min != null && min != "" && max != null && max != "") {
    filtro.innerText = "Desde " + min + " y Hasta " + max;
  } else if (min != null && min != "") {
    filtro.innerText = "Desde " + min;
  } else if (max != null && max != "") {
    filtro.innerText = "Hasta " + max;
  } else if ((max == null || max == "") && (min == null || min == "")) {
    filtro.innerText = "";
  }
  prop_consulta(elemento.id + "-" + min + "-" + max);
}

function prop_consulta(id) {
  if (id != "azar") {
    var cat = "";
    var modo = "";

    var i = 0;
    var flag = true;
    while (i < id.length) {
      if (id[i] == "-" && flag) {
        i++;
        flag = false;
      }
      if (flag) {
        cat += id[i];
      } else {
        modo += id[i];
      }

      i++;
    }
    if (
      cat != "barrio" &&
      cat != "precio" &&
      cat != "superficie" &&
      cat != "supCubierta"
    ) {
      checkbox(id);
    }
    if (
      (cat == "precio" || cat == "superficie" || cat == "supCubierta") &&
      modo != "-"
    ) {
      categorias[cat][0][1] = true;
      categorias[cat][0][0] = modo;
    } else if (
      (cat == "precio" || cat == "superficie" || cat == "supCubierta") &&
      modo == "-"
    ) {
      categorias[cat][0][1] = false;
    } else {
      for (let x = 0; x < categorias[cat].length; x++) {
        if (categorias[cat][x][0] == modo) {
          if (categorias[cat][x][1]) {
            categorias[cat][x][1] = false;
          } else {
            categorias[cat][x][1] = true;
          }
        } else {
          if (categorias[cat][x][1]) {
            categorias[cat][x][1] = false;
            if (cat != "barrio") {
              checkbox(cat + "-" + categorias[cat][x][0]);
            }
          }
        }
      }
    }
  }

  var req = new XMLHttpRequest();

  req.onload = function () {
    if (this.responseText != "vacio") {
      console.log(this.responseText);
      respuesta = JSON.parse(this.responseText);
      vacio(false);

      for (let x = 0; x < respuesta.length; x++) {
        mostrar(x);
        asignar(x, respuesta[x]);
      }
      for (let x = respuesta.length; x < 12; x++) {
        ocultar(x);
      }
    } else {
      vacio(true);
    }
  };
  var get = constructor_get(id);
  /*
  var get = "";

  if (id != "azar") {
    let k = 0;
    for (let opcion in categorias) {
      for (let x = 0; x < categorias[opcion].length; x++) {
        if (categorias[opcion][x][1]) {
          if (get == "") {
            get +=
              "opcion-" +
              String(k) +
              "=" +
              opcion +
              "-" +
              categorias[opcion][x][0];
          } else {
            get +=
              "&opcion-" +
              String(k) +
              "=" +
              opcion +
              "-" +
              categorias[opcion][x][0];
          }
          k++;
        }
      }
    }
  }
  if (get == "") {
    get = "azar";
  }
*/
  console.log(get);
  req.open("GET", "buscar-prop.php?" + get);
  req.send();
}

function checkbox(id) {
  let on = document.getElementById(id + "-on");
  let off = document.getElementById(id + "-off");
  if (on.classList.contains("checkbox-show")) {
    on.classList.replace("checkbox-show", "checkbox-hide");
    off.classList.replace("checkbox-hide", "checkbox-show");
  } else {
    off.classList.replace("checkbox-show", "checkbox-hide");
    on.classList.replace("checkbox-hide", "checkbox-show");
  }
}

prop_consulta(document.getElementById("load").getAttribute("content"));
