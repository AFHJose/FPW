var condiciones = {
  usuario: /^\s*\S{6,}\s*$/,
  contraseña: /^\s*\S{8,}\s*$/
};
var errores = {
  usuario: "El usuario debe tener al menos 6 caracteres.",
  contraseña: "La contraseña debe tener al menos 8 caracteres.",
  vacio: "Campo Obligatorio"
};
var obligatorio_ingreso = [
  ["usuario", false],
  ["contraseña", false]
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
  while ( j < lista.length && lista[j][1]) {
    j++;
  }
  console.log(j);
  if (j == lista.length) {

    document.getElementById("ingresar").disabled = false;
    document.getElementById("ingresar").classList.replace("off", "on");
  }
}

function validar(elemento) {
  var mensajeError = document.getElementById(elemento.id + "-error");
  if (elemento.value == null || elemento.value == "") {
    mensajeError.innerText = "Campo Obligatorio";
    elemento.classList.replace("valido", "error");
    cambiar(elemento.id, false, obligatorio_ingreso);
  } else {
    if (condiciones[elemento.id].test(elemento.value)) {
      mensajeError.innerText = "";
      elemento.classList.replace("error", "valido");
      cambiar(elemento.id, true, obligatorio_ingreso);
      hablitar_boton(obligatorio_ingreso);
    } else {
      mensajeError.innerText = errores[elemento.id];
      elemento.classList.replace("valido", "error");
      cambiar(elemento.id, false, obligatorio_ingreso);
    }
  }
}
