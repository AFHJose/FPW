function menu() {
  var menu = document.getElementById("cuenta-menu");
  if (menu.classList.contains("show")) {
    menu.classList.replace("show", "hide");
  } else {
    menu.classList.replace("hide", "show");
  }
}

function mostrar_formulario(id_texto, id_formulario) {
  var form = document.getElementById(id_formulario);
  var show = document.getElementById(id_texto);
  if (form.classList.contains("colapse")) {
    form.classList.replace("colapse", "expand");
    show.classList.replace("expand", "colapse");
  } else {
    form.classList.replace("expand", "colapse");
    show.classList.replace("colapse", "expand");
  }
}
function mostrar_ocultar(id, clase) {
  var hide = document.getElementById(id);
  if (hide.classList.contains("colapse")) {
    hide.classList.replace("colapse", clase);
  } else {
    hide.classList.replace(clase, "colapse");
  }
}
function correo_actualizar() {
  var req = new XMLHttpRequest();
  data = document.getElementById("correo").value;
  req.onload = function () {
    mostrar_formulario("correo-show", "correo-form");
    respuesta = JSON.parse(this.responseText);
    if (respuesta.estado) {
      document.getElementById("correo-texto").innerHTML = respuesta.correo;
    } else {
      console.log("error en update correo");
    }
  };
  req.open("POST", "update.php");
  req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  req.send("correo=" + data);
}

function contra_actualizar() {
  var req = new XMLHttpRequest();
  let actual = document.getElementById("Cactual").value;
  let nueva = document.getElementById("Cnueva").value;
  req.onload = function () {
    mostrar_formulario("contra-show", "contra-form");
    console.log(this.responseText);
    respuesta = JSON.parse(this.responseText);
    if (respuesta.estado) {
      console.log("exito en update contra");
    } else {
      console.log("error en update contra");
    }
  };
  req.open("POST", "update.php");
  req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  req.send("actual=" + actual + "&nueva=" + nueva);
}
function eliminar() {
  var req = new XMLHttpRequest();
  req.onload = function () {
    mostrar_formulario("eliminar-show", "eliminar-form");
    respuesta = JSON.parse(this.responseText);
    if (respuesta.estado) {
      console.log("exito en eliminar cuenta");
      window.location.href = "index.php";
    } else {
      console.log("error en eliminar cuenta");
    }
  };
  req.open("GET", "borrar.php");

  req.send();
}

function modificar_dato(elemento)
{
  var ids = elemento.id.split("-");
  var id=ids[0]+"-"+ids[1];
  if(ids[1]=="radioBin")
  {
    var opcionUno = document.getElementById(ids[2]);
    var opcionDos = document.getElementById(ids[3]);
  }else if(ids[1]=="texto")
  {
    var mensajeError= document.getElementById(ids[0]+"-error");
  }
  mostrar_ocultar(id+"-mostrar", "grid");
  mostrar_ocultar(id+"-cambiar", "grid");
  if(document.getElementById(id+"-cambiar").classList.contains("colapse"))
  {
    if(ids[1]=="radioBin")
    {
      opcionUno.disabled=true;
      opcionDos.disabled=true;
    }else{
      document.getElementById(ids[0]).disabled=true;

      if(ids[1]=="texto")
      {
        mensajeError.classList.replace("flex","colapse");
      }

    }
    
  }else{
    if(ids[1]=="radioBin")
    {
      opcionUno.disabled=false;
      opcionDos.disabled=false;
    }
    else{

      document.getElementById(ids[0]).disabled=false;
  
      if(ids[1]=="texto")
      {
        if(mensajeError.innerText!="")
        {
          mensajeError.classList.replace("colapse","flex");
        }
      }
    }

  }

}
