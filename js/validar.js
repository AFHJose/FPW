var condiciones = {
  usuario: /^\s*\S{6,}\s*$/,
  contraseña: /^\s*\S{8,}\s*$/,
};
var errores = {
  usuario: "El usuario debe tener al menos 6 caracteres.",
  contraseña: "La contraseña debe tener al menos 8 caracteres.",
  vacio: "Campo Obligatorio",
};

function validar(elemento) {
  var mensajeError = document.getElementById(elemento.id + "-error");
  if (elemento.value == null || elemento.value == "") {
    mensajeError.innerText = "Campo Obligatorio";
    elemento.classList.replace("valido", "error");
    document.getElementById("ingresar").disabled = true;
    document.getElementById("ingresar").classList.replace("on", "off");
  } else {
    if (condiciones[elemento.id].test(elemento.value)) {
      mensajeError.innerText = "";
      elemento.classList.replace("error", "valido");
      document.getElementById("ingresar").disabled = false;
      document.getElementById("ingresar").classList.replace("off", "on");
    } else {
      mensajeError.innerText = errores[elemento.id];
      elemento.classList.replace("valido", "error");
      document.getElementById("ingresar").disabled = true;
      document.getElementById("ingresar").classList.replace("on", "off");
    }
  }
}
function usuario() {
  console.log(usuario);
}
console.log(usuario);
