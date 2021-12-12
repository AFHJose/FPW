import random
destino = open("update_prop.txt", "w")

for i in range(100):
    superficie_cubierta = random.randint(40, 8000)
    superficie = random.randint(superficie_cubierta, 10000)
    antiguedad = random.randint(0, 200)
    cerficada = random.randint(0, 1)
    autores = ["propietario", "inmobiliaria", "miba"]
    autor = autores[random.randint(0, 2)]
    entrada = "UPDATE mibadb.propiedades SET superficie="+str(superficie)+", superficie_cubierta="+str(superficie_cubierta)+", certificada="+str(
        cerficada)+",antiguedad="+str(antiguedad)+",autor=\'"+autor+"\'WHERE mibadb.propiedades.id_prop="+str(i)+";\n"
    destino.write(entrada)


destino.close()
