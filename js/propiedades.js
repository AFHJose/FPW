/*
var propiedad = {
    "id_prop":"",
    "id_usuario":"",
    "img_path": "..\\assets\\usuarios\\82\\12\\1.jpg",
    "dir":" Pueblo Miraflores 1236",
    "barrio":"Villa Ortúzar",
    "tipo": "Departamento",
    "ambientes": "1",
    "baños": "2",
    "venta":"0",
    "alquiler":"65865",
    "dolar":true,
    "aire":"0",
    "balcon":"1",
    "pileta":"1",
    "jardin":"0",
    "gym":"1",
    "estacionamiento":"0",
 
  };
*/
var categorias=
{
    "tipo":[["compra-azar",false],["alquiler-azar",false]],
}


function asignar(id,propiedad)
{
    document.getElementById(String(id)+"-img").src=propiedad["img_path"];
    if(propiedad["dolar"]=="0")
    {
        var moneda= "USD ";
    }else
    {
        var moneda = "ARS ";
    }
    if(propiedad["venta"]=="0")
    {
        var estado = "en alquiler";
        var precio = propiedad["alquiler"];
    }else
    {
        var estado = "en venta";
        var precio = propiedad["venta"];
    }
    document.getElementById(String(id)+"-precio").textContent= moneda + precio;
    document.getElementById(String(id)+"-estado").innerHTML=propiedad["tipo"]+" "+estado;

    if(propiedad["ambientes"]=="1")
    {
        var ambientes = "1 ambiente";
    }else
    {
        var ambientes = propiedad["ambientes"]+" ambientes";
    }
    if(propiedad["baños"]=="1")
    {
        var baños = "1 baño";
    }else
    {
        var baños = propiedad["ambientes"]+" baños";
    }
    document.getElementById(String(id)+"-tamaño").innerHTML=ambientes+", "+baños;

    document.getElementById(String(id)+"-dir").innerHTML=propiedad["dir"]+", "+propiedad["barrio"]+", Capital Federal";
}



function prop_consulta(modo)
{
  var req = new XMLHttpRequest();
  
  req.onload = function()
  {
    
    respuesta = JSON.parse(this.responseText);
    
    
    for(let x=0;x<9;x++)
    {
        asignar(x,respuesta[x]);
    }
    
  }
  req.open("GET","buscar-prop.php?mode="+modo);
  req.send();
}


function checkbox(elem)
{
    let on = document.getElementById(elem.id+"-on");
    let off = document.getElementById(elem.id+"-off");
    if (on.classList.contains("checkbox-show")) {
        on.classList.replace("checkbox-show","checkbox-hide");
        off.classList.replace("checkbox-hide","checkbox-show");
      } else {
        off.classList.replace("checkbox-show","checkbox-hide");
        on.classList.replace("checkbox-hide","checkbox-show");
      }
}


function radio(categoria,id)
{
    for(let x =0;x<categoria.length;x++)
    {
        if(categoria[x][0]==id)
        {
            categoria[x][1]=true;
        }else
        {
            categoria[x][1]=false;
        }
    }
}

prop_consulta("compra-azar")