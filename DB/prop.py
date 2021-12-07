import random
lista_usuarios = list()
fuente = open("calles.txt", "r", encoding="utf-8")
calles = fuente.readlines()
calles = list(dict.fromkeys(calles))
fuente.close()
fuente = open("barrios.txt", "r", encoding="utf-8")
barrios = fuente.readlines()
barrios = list(dict.fromkeys(barrios))
fuente.close()
destino = open("Relleno-tabla-propiedades.txt", "w", encoding="utf-8")

i = 0
while i < len(calles):
    txt = ""
    for j in calles[i]:
        if(j != "\n"):
            txt += j
    calles[i] = txt
    i += 1

i = 0
while i < len(barrios):
    txt = ""
    for j in barrios[i]:
        if(j != "\n"):
            txt += j
    barrios[i] = txt
    i += 1

p = 0

while p < 100:
    id_usuario = random.randint(1, 100)
    direccion = calles[random.randint(
        0, len(calles)-1)] + " " + str(random.randint(1, 2000))
    barrio = barrios[random.randint(0, len(barrios)-1)]
    tipos = ["Departamento", "Casa", "Terreno", "Oficina", "Cochera"]
    tipo = tipos[random.randint(0, 4)]
    ambientes = random.randint(1, 4)
    baños = random.randint(1, 3)
    if(random.randint(0, 1)):
        venta = random.randint(50000, 1000000)
        alquiler = 0
    else:
        venta = 0
        alquiler = random.randint(20000, 100000)

    destino.write("INSERT INTO mibadb.propiedades (id_usuario,dir,barrio,tipo,ambientes,baños,venta,alquiler,dolar,aire,balcon,pileta,jardin,gym,estacionamiento,activa) VALUES ("+str(id_usuario)+",\'"+direccion+"\',\'"+barrio+"\',\'"+tipo+"\',"+str(ambientes)+","+str(baños) +
                  ","+str(venta)+","+str(alquiler)+","+str(random.randint(0, 1))+","+str(random.randint(0, 1))+","+str(random.randint(0, 1))+","+str(random.randint(0, 1))+","+str(random.randint(0, 1))+","+str(random.randint(0, 1))+","+str(random.randint(0, 1))+","+str(1)+");\n")
    p += 1


destino.close()
