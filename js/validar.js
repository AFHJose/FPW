var condiciones = {
  usuario: /^\s*\S{6,}\s*$/,
  contraseña: /^\s*\S{8,}\s*$/,
  correo: /^\s*[\w-\.]+@([\w-]+\.)+[\w-]{2,4}\s*$/
};
var errores = {
  usuario: "El usuario debe tener al menos 6 caracteres.",
  contraseña: "La contraseña debe tener al menos 8 caracteres.",
  correo:"El formato del correo es incorrecto.",
  vacio: "Campo Obligatorio"
};
var obligatorio_ingreso = [
  ["usuario", false],
  ["contraseña", false]
];
var obligatorio_registro = [
  ["usuario", false],
  ["contraseña", false],
  ["correo", false]
];

var obligatorio_actualizar_correo = [
  ["correo", false]
];
function cambiar(id, valor, lista) {
  i = 0;
  while (i < lista.length) {
    if (lista[i][0] == id) {
      lista[i][1] = valor;

      i = lista.length;
    } else {
      i++;
    }
  }
}
function hablitar_boton(lista) {
  j = 0;
  while (j < lista.length && lista[j][1]) {
    j++;
  }
  console.log(j);
  if (j == lista.length) {
    document.getElementById("ingresar").disabled = false;
    document.getElementById("ingresar").classList.replace("off", "on");
  }
}
function deshabilitar_boton()
{
  document.getElementById("ingresar").disabled = true;
  document.getElementById("ingresar").classList.replace("on", "off");
}

function validar(elemento,lista) {
  var mensajeError = document.getElementById(elemento.id + "-error");
  if (elemento.value == null || elemento.value == "") {
    mensajeError.innerText = "Campo Obligatorio";
    elemento.classList.replace("valido", "error");
    cambiar(elemento.id, false, lista);
    deshabilitar_boton();
  } else {
    if (condiciones[elemento.id].test(elemento.value)) {
      mensajeError.innerText = "";
      elemento.classList.replace("error", "valido");
      cambiar(elemento.id, true, lista);
      hablitar_boton(lista);
    } else {
      mensajeError.innerText = errores[elemento.id];
      elemento.classList.replace("valido", "error");
      cambiar(elemento.id, false, lista);
      deshabilitar_boton();
    }
  }
}
