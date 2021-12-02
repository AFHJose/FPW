function menu() {
  var menu = document.getElementById("cuenta-menu");
  if (menu.classList.contains("show")) {
    menu.classList.replace("show", "hide");
  } else {
    menu.classList.replace("hide", "show");
  }
}
