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
    "tipo":[["compra-azar",true],["alquiler-azar",false]],
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



function prop_consulta(id)
{
    
    
    var cat="";
    var modo="";
    var i =0;
    var flag=true;
    while (i<id.length)
    {
        if(id[i]=="-" && flag)
        {
            i++;
            flag=false;
        }
        if(flag)
        {

            cat+=id[i];
        }else 
        {
            modo+=id[i];
        }
        

        i++;
        
    }
    
    checkbox(id);
    for(let x=0;x<categorias[cat].length;x++)
    {

        if(categorias[cat][x][0]==modo)
        {
            if(categorias[cat][x][1])
            {

                radio(categorias[cat],modo,false);
                
                var sql = "buscar-prop.php?mode=azar";
                
            }else
            {
                radio(categorias[cat],modo,true);
                
                var sql = "buscar-prop.php?mode="+modo;


            }
            
            var req = new XMLHttpRequest();
            
            req.onload = function()
            {
        
            respuesta = JSON.parse(this.responseText);
        
        
            for(let x=0;x<9;x++)
            {
                asignar(x,respuesta[x]);
            }
        
            }
            req.open("GET",sql);
            req.send();
        }
    }
    
}


function checkbox(id)
{
    let on = document.getElementById(id+"-on");
    let off = document.getElementById(id+"-off");
    if (on.classList.contains("checkbox-show")) {
        on.classList.replace("checkbox-show","checkbox-hide");
        off.classList.replace("checkbox-hide","checkbox-show");
      } else {
        off.classList.replace("checkbox-show","checkbox-hide");
        on.classList.replace("checkbox-hide","checkbox-show");
      }
}


function radio(categoria,id,set)
{
    for(let x =0;x<categoria.length;x++)
    {
        if(categoria[x][0]==id)
        {
            categoria[x][1]=set;
        }else
        {
            categoria[x][1]=!set;
        }
    }
}

prop_consulta("tipo-compra-azar");