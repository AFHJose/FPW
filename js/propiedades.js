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
    "tipo":[["compra",false],["alquiler",false]],
    "inmueble":[["casa",false],["departamento",false],["oficina",false],["cochera",false],["terreno",false]],
    "moneda":[["pesos",false],["dolares",false]],
    "ambientes":[["uno",false],["dos",false],["tres",false],["cuatro",false]],
    "baños":[["uno",false],["dos",false],["tres",false]],
    "aire":[["tiene",false]],
    "balcon":[["tiene",false]],
    "pileta":[["tiene",false]],
    "jardin":[["tiene",false]],
    "gym":[["tiene",false]],
    "estacionamiento":[["tiene",false]],
    "barrio":[
    ["Agronomía",false],
    ["Almagro",false],
    ["Balvanera",false],
    ["Barracas",false],
    ["Belgrano",false],
    ["Boedo",false],
    ["Caballito",false],
    ["Chacarita",false],
    ["Coghlan",false],
    ["Colegiales",false],
    ["Constitución",false],
    ["Flores",false],
    ["Floresta",false],
    ["La Boca",false],
    ["La Paternal",false],
    ["Liniers",false],
    ["Mataderos",false],
    ["Monte Castro",false],
    ["Montserrat",false],
    ["Nueva Pompeya",false],
    ["Nuñez",false],
    ["Palermo",false],
    ["Parque Avellaneda",false],
    ["Parque Chacabuco",false],
    ["Parque Chas",false],
    ["Parque Patricios",false],
    ["Puerto Madero",false],
    ["Recoleta",false],
    ["Retiro",false],
    ["Saavedra",false],
    ["San Cristóbal",false],
    ["San Nicolás",false],
    ["San Telmo",false],
    ["Versalles",false],
    ["Villa Crespo",false],
    ["Villa Devoto",false],
    ["Villa General Mitre",false],
    ["Villa Lugano",false],
    ["Villa Luro",false],
    ["Villa Ortúzar",false],
    ["Villa Pueyrredón",false],
    ["Villa Real",false],
    ["Villa Riachuelo",false],
    ["Villa Santa Rita",false],
    ["Villa Soldati",false],
    ["Villa Urquiza",false],
    ["Villa del Parque",false],
    ["Vélez Sarsfield",false],
    ],
    "precio":["rango",false]

}

function ocultar(id)
{
    let prop = document.getElementById(String(id)+"-a");
    prop.classList.replace("show","hide");
}
function mostrar(id)
{
    let prop = document.getElementById(String(id)+"-a");
    prop.classList.replace("hide","show");
}


function asignar(id,propiedad)
{

    document.getElementById(String(id)+"-img").src=propiedad["img_path"];
    if(propiedad["dolar"]=="1")
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

function barrios(elemento)
{
    let id =elemento.id+"-"+elemento.options[elemento.selectedIndex].value;
    //console.log(id);
    prop_consulta(id);
}
function rango_precio(elemento)
{
    
    let min = document.getElementById(elemento.id+"-min").value;
    let max = document.getElementById(elemento.id+"-max").value;

    if(min=="" || min==null || /^\s*\D+\s*$/.test(min))
    {
        min="0";
    }
    if(max=="" || max==null || /^\s*\D+\s*$/.test(max))
    {
        max="0";
    }
    
    let datos ="precio-"+min+"-"+max;
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
    if(cat!="barrio" && cat!="precio")
    {
        checkbox(id);
    }
    if(cat=="precio")
    {
        categorias[cat][0][1]=true;

    }else
    {

        for(let x=0;x<categorias[cat].length;x++)
        {

            if(categorias[cat][x][0]==modo)
            {
                if(categorias[cat][x][1])
                {

                    categorias[cat][x][1]=false;
                    
                }else
                {
                    categorias[cat][x][1]=true;

                }
                
            }else 
            {
                if(categorias[cat][x][1])
                {
                    categorias[cat][x][1]=false;
                    if(cat!="barrio" && cat!="precio")
                    {
                        checkbox(cat+"-"+categorias[cat][x][0]);
                    }
                    
                }
                
            }
        }

    }

  
    var req = new XMLHttpRequest();
            
    req.onload = function()
    {
    
    if(this.responseText!="vacio")
    {
        //console.log(this.responseText);
        respuesta = JSON.parse(this.responseText);
        
    
        for(let x=0;x<respuesta.length;x++)
        {
            mostrar(x);
            asignar(x,respuesta[x]);
        }
        for(let x=respuesta.length;x<9;x++)
        {
            //falta mensaje no se encotraron resultados en el html
            ocultar(x);
        }
    }else 
    {
        for(let x=8;x>=0;x--)
        {
            ocultar(x);
        }
    }

    }

    var get="";

    let k=0;
    for(let opcion in categorias)
    {
        for(let x=0;x<categorias[opcion].length;x++)
        {
            if(categorias[opcion][x][1] && opcion!="precio")
            {
                
                if(get=="")
                {
                    get+="opcion-"+String(k)+"="+opcion+"-"+categorias[opcion][x][0];
                }else
                {
                    get+="&opcion-"+String(k)+"="+opcion+"-"+categorias[opcion][x][0];
                }
                k++;
            }else if(categorias[opcion][x][1] && opcion=="precio")
            {

            }
        }
        
        
    }
    if(get=="")
    {
        get="azar";
    }

    //console.log(get);
    req.open("GET","buscar-prop.php?"+get);
    req.send();
    
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

prop_consulta("tipo-compra");