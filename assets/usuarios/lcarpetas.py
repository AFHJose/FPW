import os
fuente = open("props.txt", "r", encoding="utf-8")
crudo = fuente.readlines()
fuente.close()


def clean(data):
    i = 0
    while i < len(data):
        txt = ""
        j = 0
        while j < len(data[i]):
            if(data[i][j] != "\n"):
                txt += data[i][j]

            j += 1
        data[i] = txt
        i += 1


clean(crudo)
compuesto = list()
entrada = list()

for i in crudo:
    entrada.append(i)
    if(len(entrada) == 3):
        compuesto.append(entrada)
        entrada = list()


for registro in compuesto:
    usuario = registro[0]
    prop = registro[1]

    path = "./"+usuario+"/"+prop

    for img in os.listdir(path):
        os.rename(path+"/"+img, path+"/"+"1.jpg")
