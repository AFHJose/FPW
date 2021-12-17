function ocultar_oferta(id) {
    let prop = document.getElementById(String(id) + "-o");
    prop.classList.replace("show", "hide");
  }
function mostrar_oferta(id) {
let prop = document.getElementById(String(id) + "-o");
prop.classList.replace("hide", "show");
}
function asignar_oferta(id, oferta) {

    document.getElementById(String(id) + "-creacion-mini").innerText= oferta["creacion"];
    document.getElementById(String(id) + "-creacion-grande").innerText= oferta["creacion"];

    if(oferta["dolar"]=="1")
    {
        var moneda = " USD";
    }else {
      var moneda = " ARS";
    }

    document.getElementById(String(id) + "-precio-mini").innerText= oferta["precio"]+moneda;
    document.getElementById(String(id) + "-precio-grande").innerText= oferta["precio"]+moneda;


    document.getElementById(String(id) + "-termina-mini").innerText= oferta["termina"];
    document.getElementById(String(id) + "-termina-grande").innerText= oferta["termina"];

    document.getElementById(String(id) + "-estado-mini").innerText= oferta["estado"];

    document.getElementById(String(id) + "-autor-grande").innerText= oferta["usuario"];

    document.getElementById(String(id) + "-contacto-correo").innerText= oferta["correo"];

    
}

function buscar_azar(modo,id_prop)
{
    var req = new XMLHttpRequest();
    req.onload = function () {
        if (this.responseText != "vacio") {
          //console.log(this.responseText);
          respuesta = JSON.parse(this.responseText);
          vacio(false);
    
          for (let x = 0; x < respuesta.length; x++) {
            mostrar_oferta(x);
            asignar(x, respuesta[x]);
          }
          for (let x = respuesta.length; x < 6; x++) {
            ocultar_oferta(x);
          }
        } else {
          //vacio(true);
        }
      };

      req.open("GET", "buscar-prop.php?modo=" + modo +"&id_prop="+id_prop);
      req.send();
}