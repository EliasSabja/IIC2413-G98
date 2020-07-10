from flask import Flask, render_template, request, abort, json
from pymongo import MongoClient
import pandas as pd
import matplotlib.pyplot as plt
import os
import atexit
import subprocess
import random
from datetime import datetime

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
    return json.jsonify({"message": "Hola", "success": True})

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

@app.route("/messages", methods=["GET"])
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
        ids_query = list(db.users.find({}, {"_id": 0, "uid": 1}))
        ids = list(map(lambda x: x["uid"], ids_query))
        if id1 not in ids:
            return json.jsonify({"message": "id1 no es válido", "success": False})
        elif id2 not in ids:
            return json.jsonify({"message": "id2 no es válido", "success": False})
        else:
            mensajes = list(db.messages.find({"$or": [ {"$and": [{"sender": id1},{"receptant": id2}]},
                                                    {"$and": [{"sender": id2},{"receptant": id1}]} ]},
                                                    {"_id": 0, "dummy": 0}))
            return json.jsonify(mensajes)
    elif not id1 and id2:
        #Recibidos
        id2 = int(id2)
        msgs_recieved = list(db.messages.find({"receptant": id2}, {"_id": 0, "dummy": 0}))
        return json.jsonify(msgs_recieved)
    elif id1 and not id2:
        #Enviados
        id1 = int(id1)
        msgs_sent = list(db.messages.find({"sender": id1}, {"_id": 0, "dummy": 0}))
        return json.jsonify(msgs_sent)
    else:
        mensajes = list(db.messages.find({}, {"_id": 0, "dummy": 0}).limit(20))
        return json.jsonify(mensajes)

@app.route("/messages/<int:mid>")
def get_message(mid):
    '''
    Obtiene el mensaje de id entregada
    '''
    # chequear proyeccion de dummy y _id
    messages = list(db.messages.find({"mid": mid}, {"_id": 0, "dummy": 0}))
 
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
    if ("message" in data) and ("receptant" in data) and ("sender" in data):
        data["long"] = random.uniform(-179, 180)
        data["lat"] = random.uniform(-90, 90)
        data["date"] = datetime.today().strftime('%Y-%m-%d')

        receptant = db.users.find({"name": data["receptant"]},{"_id": 0})
        receptant_id = receptant["uid"]
        data["receptant"] = receptant_id
        
        #Se anaden los atributos dado que todos existen
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
            message = "Mensaje no pudo crearse, los siguientes datos no son del tipo correcto: "
            success = False
            if (not "message" in data):
                message += "message "
            if (not "sender" in data):
                message += "sender "
            if (not "receptant" in data):
                message += "receptant "
            if (not "lat" in data):
                message += "lat "
            if (not "long" in data):
                message += "long "
            if (not "date" in data):
                message += "date "
            message += "."
    else:
        message = "Mensaje no pudo crearse, faltan los siguientes datos: "
        success = False
        if (not "message" in data):
            message += "message "
        if (not "sender" in data):
            message += "sender "
        if (not "receptant" in data):
            message += "receptant "
        if (not "lat" in data):
            message += "lat "
        if (not "long" in data):
            message += "long "
        if (not "date" in data):
            message += "date "
        message += "."
    return json.jsonify({"message": message, "success": success})

@app.route("/message/<int:mid>", methods=['DELETE'])
def delete_message(mid):
    '''
    Recibe id de un mensaje
    y lo elimina
    '''
    message = list(db.messages.find({"mid": mid}, {"_id": 0, "dummy": 0}))

    if len(message) > 0:
        db.messages.delete_one({"mid": mid})
        aviso = f'Mensaje con id {mid} ha sido eliminado'
        success = True
    else:
        aviso = "No existe mensaje con dicho id"
        success = False
    return json.jsonify({"success": success, "message": aviso})

@app.route("/text-search", methods=["POST"])
def get_text_search():
    '''
    Búsqueda de texto
    '''
    try:
        body = request.json
    except:
        return json.jsonify(list(db.messages.find({}, {"_id": 0, "dummy": 0}).limit(30)))
    deseables, requeridas, prohibidas, hay_id = False, False, False, False
    texto = ''
    if "desired" in body:
        if body["desired"]:
            deseables = True
            for palabra in body["desired"]:
                texto += palabra + " "
    if "required" in body:
        if body["required"]:
            requeridas = True
            for palabra in body["required"]:
                texto += '\"' + palabra + '\" '
    if "forbidden" in body:
        if body["forbidden"]:
            prohibidas = True
            for palabra in body["forbidden"]:
                texto += "-" + palabra + " "
    if "userId" in body:
        if body["userId"]:
            hay_id = True
            sender = body["userId"]

    if deseables or requeridas or prohibidas or hay_id:
        if not deseables and not requeridas and prohibidas:
            texto = "x " + texto
        elif hay_id and not deseables and not requeridas and not prohibidas:
            return json.jsonify(list(db.messages.find({"sender": sender}, {"_id": 0, "dummy": 0})))
        if hay_id:
            return json.jsonify(list(db.messages.find({"$and": [{"$text": {"$search": texto}}, {"sender": sender}]}, {"dummy": 0, "_id": 0, "score": {"$meta": "textScore"}}).sort([("score", {"$meta": "textScore"})])))
        else:
            return json.jsonify(list(db.messages.find({"$and": [{"$text": {"$search": texto}}]}, {"dummy": 0, "_id": 0, "score": {"$meta": "textScore"}}).sort([("score", {"$meta": "textScore"})]).limit(20)))
    else:
        return json.jsonify(list(db.messages.find({}, {"_id": 0, "dummy": 0}).limit(30)))


if __name__ == "__main__":
    app.run(threaded=True, port=5000)
    # app.run(debug=True) # Para debuggear!
