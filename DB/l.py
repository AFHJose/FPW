
fuente = open("barrios.txt", "r")
calles = fuente.readlines()
fuente.close()
destino = open("barrios-new.txt", "w")
for i in calles:
    txt = ""
    for j in i:
        if(j != "\n"):
            txt += j
    destino.write("\""+txt+"\"=>'barrio=\\'"+txt+"\\'',\n")
destino.close()
