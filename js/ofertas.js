var pagina=1;
var ultima_busqueda =["azar",document.getElementById("id_prop").getAttribute("content")];
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

    document.getElementById(String(id) + "-rechazar").href= "rechazar_oferta.php?id_prop="+ultima_busqueda[1]+"&id_oferta="+oferta["id_oferta"];

    
}

function buscar_oferta(modo,id_prop)
{
    var req = new XMLHttpRequest();
    req.onload = function () {
        
        //console.log(this.responseText);
        if(this.responseText!="vacio")
        {

            respuesta = JSON.parse(this.responseText);
            for (let x = 0; x < respuesta.length; x++) {
            mostrar_oferta(x);
            asignar_oferta(x, respuesta[x]);
            }
            for (let x = respuesta.length; x < 6; x++) {
            ocultar_oferta(x);
            }
        }else{
            for (let x = 0; x < 6; x++) {
            ocultar_oferta(x);
            }

        }
        
    }
    //console.log(modo);
    //console.log(id_prop);
    req.open("GET", "buscar-oferta.php?offset="+String(pagina)+"&modo=" + modo +"&id_prop="+id_prop);
    req.send();
    ultima_busqueda[0]=modo;

}


function actualizar_pag_oferta(modo) {
    let show = document.getElementById("resultados-cantidad");
    if (modo) {
        pagina++;
      if (pagina == 2) {
        mostrar_ocultar("resultados-anterior", "block");
      }
    } else {
        pagina--;
      if (pagina == 1) {
        mostrar_ocultar("resultados-anterior", "block");
      }
    }
    show.innerText = "Pagina " + String(pagina);
    buscar_oferta(ultima_busqueda[0],ultima_busqueda[1]);
  }

function boton_crear(boton)
{
    var formulario = document.getElementById("crear-oferta");
    
    if(formulario.classList.contains("colapse"))
    {
        formulario.classList.replace("colapse","flex");
        boton.innerText="Cancelar";
    }else
    {
        formulario.classList.replace("flex","colapse");
        boton.innerText="Crear propuesta";
    }
}
function validar_precio_oferta(elemento)
{
    if(! /^\s*(\d{1,})\s*$/.test(elemento.value))
    {
        elemento.value="";
    }
}
buscar_oferta("azar",document.getElementById("id_prop").getAttribute("content"));