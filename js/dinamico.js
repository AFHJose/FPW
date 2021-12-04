function menu() {
  var menu = document.getElementById("cuenta-menu");
  if (menu.classList.contains("show")) {
    menu.classList.replace("show", "hide");
  } else {
    menu.classList.replace("hide", "show");
  }
}
function correo_formulario()
{
  var form = document.getElementById("correo-form");
  var show = document.getElementById("correo-show");
  if (form.classList.contains("colapse")) {
    form.classList.replace("colapse","expand");
    show.classList.replace("expand","colapse");
  } else {
    form.classList.replace("expand","colapse");
    show.classList.replace("colapse","expand");
  }

}
function correo_actualizar()
{
  var req = new XMLHttpRequest();
  data = document.getElementById("correo").value;
  req.onload = function()
  {
    correo_formulario();
    respuesta = JSON.parse(this.responseText);
    if(respuesta.estado)
    {
      document.getElementById("correo-texto").innerHTML=respuesta.correo;
    }else{
      console.log("error en update correo");
    }

  }
  req.open("POST","update.php");
  req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  req.send("correo="+data);
}
function contra_formulario()
{
  var form = document.getElementById("contra-form");
  var show = document.getElementById("contra-show");
  if (form.classList.contains("colapse")) {
    form.classList.replace("colapse","expand");
    show.classList.replace("expand","colapse");
  } else {
    form.classList.replace("expand","colapse");
    show.classList.replace("colapse","expand");
  }

}
function contra_actualizar()
{
  var req = new XMLHttpRequest();
  let actual = document.getElementById("Cactual").value;
  let nueva = document.getElementById("Cnueva").value;
  req.onload = function()
  {
    contra_formulario()
    console.log(this.responseText);
    respuesta = JSON.parse(this.responseText);
    if(respuesta.estado)
    {
      console.log("exito en update contra");
    }else{
      console.log("error en update contra");
    }

  }
  req.open("POST","update.php");
  req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  req.send("actual="+actual+"&nueva="+nueva);
}