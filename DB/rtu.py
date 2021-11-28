import random
lista_usuarios = list()
destino = open("Relleno-tabla-usuarios.txt", "w")
fuente = open("usernames.txt", "r")
usuarios = fuente.readlines()
usuarios = list(dict.fromkeys(usuarios))
fuente.close()
fuente = open("passwords.txt", "r")
contraseñas = fuente.readlines()
contraseñas = list(dict.fromkeys(contraseñas))
fuente.close()
fuente = open("email.txt", "r")
correos = fuente.readlines()
correos = list(dict.fromkeys(correos))
fuente.close()


p = 0
i = 0
j = 0
k = 0

while p < 100:
    usuario = ""
    while usuario == "":

        t = 0
        while usuarios[i][t] != "\n":
            usuario += usuarios[i][t]
            t += 1

        if len(usuario) < 6:
            usuario = ""

        i += 1

    contraseña = ""
    while contraseña == "":

        t = 0
        while contraseñas[j][t] != "\n":
            contraseña += contraseñas[j][t]
            t += 1
        if len(contraseña) < 8:
            contraseña = ""

        j += 1

    correo = ""
    while correo == "":

        t = 0
        while correos[k][t] != "\n":
            correo += correos[k][t]
            t += 1

        k += 1

    lista_usuarios.append([usuario, contraseña, correo])
    p += 1


for entrada in lista_usuarios:
    destino.write("INSERT INTO mibadb.usuarios (usuario,contraseña,correo) VALUES (\'" +
                  entrada[0]+"\',\'"+entrada[1]+"\',\'"+entrada[2]+"\');\n")

destino.close()
