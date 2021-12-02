function menu() {
  var menu = document.getElementById("cuenta-menu");
  if (menu.classList.contains("show")) {
    menu.classList.replace("show", "hide");
  } else {
    menu.classList.replace("hide", "show");
  }
}
function actualizar_correo()
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
