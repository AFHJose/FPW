
function llenar_main(string)
{
    //console.log(string);

    var pedido = new XMLHttpRequest();

    pedido.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            var datos = JSON.parse(this.responseText);
            var index = 1;

            //console.log(datos);

            for (prop in datos)
            {
                if(index<13)
                {
                    var item = document.getElementById(index.toString()).childNodes;

                    for(dato in datos[prop])
                    {

                        if (dato=="img")
                        {
                            item[1].src = datos[prop][dato];
                        }
                        else if(dato=="tipo")
                        {
                            item[3].childNodes[3].innerHTML = datos[prop][dato];
                        }
                        else if(dato=="ubicacion")
                        {
                            item[3].childNodes[7].innerHTML = datos[prop][dato];
                        }
                        else if(dato=="estado")
                        {
                            item[3].childNodes[11].innerHTML = datos[prop][dato];
                        }
                        else if(dato=="ambientes")
                        {
                            item[3].childNodes[15].innerHTML = datos[prop][dato];
                        }
                        else if(dato=="estacionamiento")
                        {
                            item[3].childNodes[19].innerHTML = datos[prop][dato];
                        }

                    }
                }
                index++;
            }

        }
       document.getElementById("Orden").innerHTML="Ordenar según: "+string;
    };

    pedido.open("GET","../php/prop.php?modo="+string,true);
    pedido.send(); 
    
}

function actualizar_cuenta()
{

    var pedido = new XMLHttpRequest();

    pedido.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //document.getElementById("usuario-edit").innerHTML = this.responseText;
            //console.log(this.responseText);
            var datos = JSON.parse(this.responseText);
            document.getElementById("nombre-show").innerHTML = datos.nombre;
            document.getElementById("apellido-show").innerHTML = datos.apellido ;
            document.getElementById("correo-show").innerHTML = datos.correo ;
            document.getElementById("telefono-show").innerHTML = datos.telefono;
            mostrar_cuenta();
        }
    };
    var usuario = document.getElementById("usuario").innerText;
    var Telefono = document.getElementById("telefono-edit").value;
    var Correo = document.getElementById("correo-edit").value;
    var Nombre = document.getElementById("nombre-edit").value;
    var Apellido = document.getElementById("apellido-edit").value;

    pedido.open("GET","../php/update.php?usuario="+usuario+"&nombre="+Nombre+"&apellido="+Apellido+"&correo="+Correo+"&telefono="+Telefono,true);
    pedido.send();


}

function info_cuenta()
{
    var cuenta = document.getElementById("cuenta-show");
    cuenta.classList.replace("hide","show");

    document.getElementById("header-cuenta").classList.replace("header","header-cuenta");
    
    var edit = document.getElementById("cuenta");
    edit.classList.replace("show","hide");
}
function solo_cuenta()
{
    var cuenta = document.getElementById("cuenta");
    cuenta.classList.replace("hide","show");

    document.getElementById("header-cuenta").classList.replace("header-cuenta","header");
    
    var edit = document.getElementById("cuenta-show");
    edit.classList.replace("show","hide");

    var edit = document.getElementById("cuenta-edit");
    edit.classList.replace("show","hide");
}
function mostrar_cuenta()
{
    var cuenta = document.getElementById("cuenta-show");
    cuenta.classList.replace("hide","show");

    
    var edit = document.getElementById("cuenta-edit");
    edit.classList.replace("show","hide");
}

function editar_cuenta()
{

    document.getElementById("telefono-edit").value="";
    document.getElementById("correo-edit").value="";
    document.getElementById("nombre-edit").value="";
    document.getElementById("apellido-edit").value="";

    var cuenta = document.getElementById("cuenta-show");
    cuenta.classList.replace("show","hide");
    
    var edit = document.getElementById("cuenta-edit");
    edit.classList.replace("hide","show");
}

function eliminar_cuenta()
{
    var pedido = new XMLHttpRequest();

    pedido.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            window.location.href= "../html/login.html";
            //document.getElementById("usuario").innerHTML = this.responseText;
        }
    };
    var usuario = document.getElementById("usuario").innerText;
    pedido.open("GET","../php/eliminate.php?usuario="+usuario,true);
    pedido.send();
}


function register()
{
    var pedido = new XMLHttpRequest();

    pedido.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            document.getElementById("ConfirmarRegistro").innerHTML = this.responseText;
        }
    };

    var usuario = document.getElementById("usuario").value;
    var contraseña = document.getElementById("contraseña").value;
    var Telefono = document.getElementById("Telefono").value;
    var Correo = document.getElementById("Correo").value;
    var Nombre = document.getElementById("Nombre").value;
    var Apellido = document.getElementById("Apellido").value;

    pedido.open("POST", "../php/register.php", true);
    pedido.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    pedido.send("usuario="+usuario+"&contraseña="+contraseña+"&telefono="+Telefono+"&correo="+Correo+"&nombre="+Nombre+"&apellido="+Apellido);
}
function validarUsuario(elemento)
{
    var mensajeError = document.getElementById(elemento.name+"Error");
   
    if(/^\s*\S{6,}\s*$/.test(elemento.value))
    {
        mensajeError.innerText="";
        elemento.classList.replace("error","valido");
        document.getElementById("Acceder").disabled=false;
        document.getElementById("Acceder").classList.replace("off","on");
    }else
    {
        mensajeError.innerText="El usuario debe tener al menos 6 caracteres.";
        elemento.classList.replace("valido","error");
        document.getElementById("Acceder").disabled=true;
        document.getElementById("Acceder").classList.replace("on","off");
    }
}

function validarContraseña(elemento)
{
    var mensajeError = document.getElementById(elemento.name+"Error");
   
    if(/^\s*\S{8,}\s*$/.test(elemento.value))
    {
        mensajeError.innerText="";
        elemento.classList.replace("error","valido");
        document.getElementById("Acceder").disabled=false;
        document.getElementById("Acceder").classList.replace("off","on");
    }else
    {
        mensajeError.innerText="La contraseña debe tener al menos 8 caracteres.";
        elemento.classList.replace("valido","error");
        document.getElementById("Acceder").disabled=true;
        document.getElementById("Acceder").classList.replace("on","off");
    }
}
function validarObligatorio(elemento)
{
    var mensajeError = document.getElementById(elemento.name+"Error");
    if(elemento.value==null || elemento.value=="")
    {
        mensajeError.innerText="Campo Obligatorio";
        elemento.classList.replace("valido","error");
        document.getElementById("Acceder").disabled=true;
        document.getElementById("Acceder").classList.replace("on","off");
    }
}

function validarTodoObligatorio(elemento)
{

    var obligatorios = document.getElementsByClassName("obligatorio");
    for(i=0;i<obligatorios.length;i++)
    {
        validarObligatorio(obligatorios[i]);
    }

    /*if(elemento.disabled==false)
    {
        window.location.href= "../html/main.html";

    }*/
}
function validarTodoObligatorio2(elemento)
{

    var obligatorios = document.getElementsByClassName("obligatorio");
    for(i=0;i<obligatorios.length;i++)
    {
        validarObligatorio(obligatorios[i]);
    }

    if(elemento.disabled==false)
    {
        register();
    }
}
function validarTodoObligatorio3(elemento)
{

    var obligatorios = document.getElementsByClassName("obligatorio");
    for(i=0;i<obligatorios.length;i++)
    {
        validarObligatorio(obligatorios[i]);
    }

    if(elemento.disabled==false)
    {
        actualizar_cuenta();
    }
}
function validarNombre(elemento)
{
    var mensajeError = document.getElementById(elemento.name+"Error");
   
    if(/^\s*[A-Z]+[a-z]+\s*$/.test(elemento.value))
    {
        mensajeError.innerText="";
        elemento.classList.replace("error","valido");
        document.getElementById("Acceder").disabled=false;
        document.getElementById("Acceder").classList.replace("off","on");
    }else
    {
        mensajeError.innerText="Primer letra mayuscula, al menos dos letras";
        elemento.classList.replace("valido","error");
        document.getElementById("Acceder").disabled=true;
        document.getElementById("Acceder").classList.replace("on","off");
    }
}
function validarCorreo(elemento)
{
    var mensajeError = document.getElementById(elemento.name+"Error");
   
    if(/^\s*\S+@\S+\.\S+\s*$/.test(elemento.value))
    {
        mensajeError.innerText="";
        elemento.classList.replace("error","valido");
        document.getElementById("Acceder").disabled=false;
        document.getElementById("Acceder").classList.replace("off","on");
    }else
    {
        mensajeError.innerText="Formato correcto: algo@algo.algo";
        elemento.classList.replace("valido","error");
        document.getElementById("Acceder").disabled=true;
        document.getElementById("Acceder").classList.replace("on","off");
    }
}

function validarTelefono(elemento)
{
    var mensajeError = document.getElementById(elemento.name+"Error");
   
    if(/^\s*\d{9}\s*$/.test(elemento.value))
    {
        mensajeError.innerText="";
        elemento.classList.replace("error","valido");
        document.getElementById("Acceder").disabled=false;
        document.getElementById("Acceder").classList.replace("off","on");
    }else
    {
        mensajeError.innerText="Su telefono debe tener 9 digitos";
        elemento.classList.replace("valido","error");
        document.getElementById("Acceder").disabled=true;
        document.getElementById("Acceder").classList.replace("on","off");
    }
}
function validarClave(elemento)
{
    var mensajeError = document.getElementById(elemento.name+"Error");
   
    if(/^\s*\S{32,}\s*$/.test(elemento.value))
    {
        mensajeError.innerText="";
        elemento.classList.replace("error","valido");
        document.getElementById("Acceder").disabled=false;
        document.getElementById("Acceder").classList.replace("off","on");
    }else
    {
        mensajeError.innerText="Si olvido su clave especial contacte a soporte tecnico.";
        elemento.classList.replace("valido","error");
        document.getElementById("Acceder").disabled=true;
        document.getElementById("Acceder").classList.replace("on","off");
    }
}
function validarConfirmar(elemento)
{
    var mensajeError = document.getElementById(elemento.name+"Error");
    var contraseña = document.getElementById("contraseña");
   
    if(contraseña.value == elemento.value)
    {
        mensajeError.innerText="";
        elemento.classList.replace("error","valido");
        document.getElementById("Acceder").disabled=false;
        document.getElementById("Acceder").classList.replace("off","on");
    }else
    {
        mensajeError.innerText="Repita su contraseña";
        elemento.classList.replace("valido","error");
        document.getElementById("Acceder").disabled=true;
        document.getElementById("Acceder").classList.replace("on","off");
    }
}
function resetConfirmar()
{
    var confirmar = document.getElementById("Confirmar");
    confirmar.value="";
}


llenar_main("primeros");
