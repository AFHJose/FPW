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

document.getElementById(String(0)+"-img").src=propiedad["img_path"];
if(propiedad["dolar"])
{
    var moneda= "USD ";
}else
{
    var moneda = "ARS";
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
document.getElementById(String(0)+"-precio").textContent= moneda + precio;
document.getElementById(String(0)+"-estado").innerHTML=propiedad["tipo"]+" "+estado;

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
document.getElementById(String(0)+"-tamaño").innerHTML=ambientes+", "+baños;

document.getElementById(String(0)+"-dir").innerHTML=propiedad["dir"]+", "+propiedad["barrio"]+", Capital Federal";