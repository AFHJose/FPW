
fuente = open("barrios.txt", "r")
calles = fuente.readlines()
fuente.close()
i = 0
while i < len(calles):
    txt = ""
    j = 0
    while j < len(calles[i]):
        if(j != 0):
            txt += calles[i][j]
        j += 1
    calles[i] = txt
    i += 1

destino = open("barrios-new.txt", "w")
for i in calles:
    destino.write(i)

destino.close()
