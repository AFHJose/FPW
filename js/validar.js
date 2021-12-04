var condiciones = {
  usuario: /^\s*\S{6,}\s*$/,
  contraseña: /^\s*\S{8,}\s*$/,
  Cnueva: /^\s*\S{8,}\s*$/,
  Cactual: /^\s*\S{8,}\s*$/,
  correo: /^\s*[\w-\.]+@([\w-]+\.)+[\w-]{2,4}\s*$/
};
var errores = {
  usuario: "El usuario debe tener al menos 6 caracteres.",
  contraseña: "La contraseña debe tener al menos 8 caracteres.",
  Cnueva: "La contraseña debe tener al menos 8 caracteres.",
  Cactual: "La contraseña debe tener al menos 8 caracteres.",
  correo:"El formato del correo es incorrecto.",
  vacio: "Campo Obligatorio"
};
var obligatorio_ingreso = [
  ["ingresar",true],
  ["usuario", false],
  ["contraseña", false]
];
var obligatorio_registro = [
  ["ingresar",true],
  ["usuario", false],
  ["contraseña", false],
  ["correo", false]
];

var obligatorio_actualizar_correo = [
  ["Icorreo",true],
  ["correo", false]
];

var obligatorio_actualizar_contraseña = [
  ["contra",true],
  ["Cactual", false],
  ["Cnueva",false]
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
function hablitar_boton(id,lista) {
  j = 0;
  while (j < lista.length && lista[j][1]) {
    j++;
  }
  if (j == lista.length) {
    document.getElementById(id).disabled = false;
    document.getElementById(id).classList.replace("off", "on");
  }
}
function deshabilitar_boton(id)
{
  document.getElementById(id).disabled = true;
  document.getElementById(id).classList.replace("on", "off");
}

function validar(elemento,lista) {
  let mensajeError = document.getElementById(elemento.id + "-error");

  if (elemento.value == null || elemento.value == "") {
    mensajeError.innerText = "Campo Obligatorio";
    elemento.classList.replace("valido", "error");
    cambiar(elemento.id, false, lista);
    deshabilitar_boton(lista[0][0]);
  } else {
    if (condiciones[elemento.id].test(elemento.value)) {
      mensajeError.innerText = "";
      elemento.classList.replace("error", "valido");
      cambiar(elemento.id, true, lista);
      hablitar_boton(lista[0][0],lista);
    } else {
      mensajeError.innerText = errores[elemento.id];
      elemento.classList.replace("valido", "error");
      cambiar(elemento.id, false, lista);
      deshabilitar_boton(lista[0][0]);
    }
  }
}

