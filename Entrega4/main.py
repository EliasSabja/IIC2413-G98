from flask import Flask, render_template, request, abort, json
from pymongo import MongoClient
import pandas as pd
import matplotlib.pyplot as plt
import os
import atexit
import subprocess

# Para este ejemplo pediremos la id
# y no la generaremos automáticamente

USER = "grupo98"
PASS = "perro123"
DATABASE = "grupo98"

message_keys = ["message", "sender", "receptant", "lat", "long", "date"]
# El cliente se levanta en la URL de la wiki
# URL = "mongodb://grupoXX:grupoXX@gray.ing.puc.cl/grupoXX"
URL = f"mongodb://{USER}:{PASS}@gray.ing.puc.cl/{DATABASE}"
client = MongoClient(URL)

# Utilizamos la base de datos del grupo
db = client["grupo98"]

'''
Users:
  "uid": <id del usuario>,
  "name": <nombre>,
  "age": <edad>,
  "description": <descripcion>
'''
 
'''
Messages:
  "mid": <id del mensaje>,
  "message": <contenido>,
  "sender": <emisor>,
  "receptant": <receptor>,
  "lat": <latitud>,
  "long": <longitud>,
  "date": <fecha envio>
'''

# Iniciamos la aplicación de flask
app = Flask(__name__)

@app.route("/")
def home():
    '''
    Página de inicio
    '''
    return "<h1>¡Hola!</h1>"

@app.route("/users")
def get_users():
    '''
    Obtiene todos los usuarios
    '''
    # Omitir el _id porque no es json serializable
    # chequear proyeccion de dummy y _id
    resultados = list(db.users.find({}, {"_id": 0}))
    return json.jsonify(resultados)

@app.route("/users/<int:uid>")
def get_user(uid):
    '''
    Obtiene el usuario de id entregada
    '''
    # chequear proyeccion de  _id
    users = list(db.users.find({"uid": uid}, {"_id": 0}))

    if len(users) > 0:
        return json.jsonify(users)
    else:
        return json.jsonify({"messages": "No existe un usuario con dicho id", "success": False})

@app.route("/messages")
def get_messages():
    '''
    Obtiene todos los mensajes
    Si se ingresan ids de 2 personas
    retorna los mensajes que se han enviado
    entre ellas
    '''
    # Omitir el _id porque no es json serializable
    id1 = request.args.get("id1")
    id2 = request.args.get("id2")
    if id1 and id2:
        id1 = int(id1)
        id2 = int(id2)

        mensajes = list(db.messages.find({"$or": [ {"$and": [{"sender": id1},{"receptant": id2}]}, 
                                                {"$and": [{"sender": id2},{"receptant": id1}]} ]}, 
                                                {"_id": 0}))
        return json.jsonify(mensajes)
    elif (id1 and not id2) or (not id1 and id2):
        return json.jsonify({"message": "No se ha ingresado un id :(", "success": False})
    else:
        mensajes = list(db.messages.find({}, {"_id": 0}).limit(30))
        return json.jsonify(mensajes)

@app.route("/messages/<int:mid>")
def get_message(mid):
    '''
    Obtiene el mensaje de id entregada
    '''
    # chequear proyeccion de dummy y _id
    messages = list(db.messages.find({"mid": mid}, {"_id": 0}))
    
    if len(messages) > 0:
        return json.jsonify(messages)
    else:
        return json.jsonify({"message": "No existe mensaje con dicho id", "success": False})

@app.route("/messages", methods=['POST'])
def post_messages():
    '''
    Recibe atributos, si son válidos
    se crea un nuevo mensaje
    '''
    #Se reciben los datos del nuevo mensaje en un diccionario
    data = request.json
    if ("message" in data) and ("sender" in data) and ("receptant" in data) and ("lat" in data) and ("long" in data) and ("date" in data):
        #Se anaden los atributos dado que todos existen
        new_message = {key: request.json[key] for key in message_keys}
        if (type(data["long"]) == float) and (type(data["lat"]) == float) and (type(data["message"]) == str) and (type(data["receptant"]) == int) and (type(data["sender"]) == int) and (type(data["date"]) == str):
            #Se genera el mid
            max = list(db.messages.find({}, {"_id": 0, "lat": 0, "long": 0, "sender": 0, "receptant": 0, "message": 0, "date": 0, "dummy": 0}).sort([("mid", -1)]).limit(1))
            data["mid"] = max[0]["mid"] + 1
            #Se inserta atributo dummy para text search
            data["dummy"] = "x"
            #Se inserta en la base de datos
            result = db.messages.insert_one(data)
            if (result):
                message = "Mensaje creado exitosamente"
                success = True
            else:
                message = "Mensaje no pudo crearse, datos inválidos"
                success = False
            message = "Mensaje creado exitosamente"
            success = True
        else:
            message = "Mensaje no pudo crearse, datos inválidos"
            success = False
    else:
        message = "Mensaje no pudo crearse, faltan datos"
        success = False
    return json.jsonify({"message": message, "success": success})

@app.route("/messages/<int:mid>", methods=['DELETE'])
def delete_messages(mid):
    '''
    Recibe id de un mensaje
    y lo elimina
    '''
    message = list(db.messages.find({"mid": mid}, {"_id": 0}))

    if len(message) > 0:
        db.messages.delete_one({"mid": mid})
        aviso = f'Mensaje con id {mid} ha sido eliminado'
        success = True
    else:
        aviso = "No existe mensaje con dicho id"
        success = False
    return json.jsonify({"result": success, "message": aviso})

@app.route("/text-search")
def get_text_search():
    '''
    Búsqueda de texto
    '''
    json = dict()
    deseables, requeridas, prohibidas, hay_id = False, False, False, False
    texto = '" '
    if json["desired"]:
        deseables = True
        for palabra in json["desired"]:
            texto += palabra + " "
    if json["required"]:
        requeridas = True
        for palabra in json["required"]:
            texto += '\"' + palabra + '\" '
    if json["forbidden"]:
        prohibidas = True
        for palabra in json["forbidden"]:
            texto += "-" + palabra + " "
    if json["userId"]:
        hay_id = True
        sender = json["userId"]

    texto += ' "'
    if deseables and not requeridas and not prohibidas:
        return None
    elif not deseables and not requeridas and prohibidas:
        texto = "x " + texto
    elif hay_id and not deseables and not requeridas and not prohibidas:
        return "otra_consulta"

    if hay_id:
        return db.messages.find({"$and": [{"$text": {"$search": texto}}, {"sender": sender}]}, {"score": {"$meta": "textScore"}}).sort({"score": {"$meta": "textScore"}}).projection({"dummy": 0, "score": {"$meta": "textScore"}})

    else:
        return db.messages.find({"$text": {"$search": texto}}, {"score": {"$meta": "textScore"}}).sort({"score": {"$meta": "textScore"}}).projection({"dummy": 0, "score": {"$meta": "textScore"}})

if __name__ == "__main__":
    #app.run()
    app.run(debug=True) # Para debuggear!
