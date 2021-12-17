import random
destino = open("INSERT_OFERTA.txt", "w")

id_prop = 1
j = 0

for i in range(300):
    id_usuario = str(random.randint(1, 100))
    dolar = str(random.randint(0, 1))
    precio = str(random.randint(50000, 5000000))
    creacion = "2020-"+str(random.randint(1, 12))+"-" + \
        str(random.randint(1, 28))
    termina = "2021-"+str(random.randint(1, 12))+"-"+str(random.randint(1, 28))
    destino.write(
        "INSERT INTO mibadb.ofertas (id_usuario,id_prop,dolar,precio,creacion,termina) VALUES ("+id_usuario+","+str(id_prop)+","+dolar+","+precio+",\'"+creacion+"\',\'"+termina+"\');\n")
    j += 1
    if(j == 3):
        id_prop += 1
        j = 0
