from flask import Flask, render_template, request, abort, json
from pymongo import MongoClient
import pandas as pd
import matplotlib.pyplot as plt
import os

# Para este ejemplo pediremos la id
# y no la generaremos automáticamente
USER_KEYS = ['uid', 'name', 'last_name',
            'occupation', 'follows', 'age']

USER = "grupo98"
PASS = "perro123"
DATABASE = "grupo98"

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
    resultados = list(db.users.find({}, {"_id": 0}))
    return json.jsonify(resultados)

@app.route("/users/<int:uid>")
def get_user(uid):
    '''
    Obtiene el usuario de id entregada
    '''
    users = list(db.users.find({"uid": uid}, {"_id": 0}))
    return json.jsonify(users)

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
        return "No se ha ingresado un id :("
    else:
        mensajes = list(db.messages.find({}, {"_id": 0}).limit(30))
        return json.jsonify(mensajes)

@app.route("/messages/<int:mid>")
def get_message(mid):
    '''
    Obtiene el mensaje de id entregada
    '''
    messages = list(db.messages.find({"mid": mid}, {"_id": 0}))
    return json.jsonify(messages)

@app.route("/messages", methods=['POST'])
def post_messages()
    '''
    Recibe atributos, si son válidos
    se crea un nuevo mensaje
    '''
    return None

@app.route("/messages/<int:mid>", methods=['DELETE'])
def delete_messages(mid)
    '''
    Recibe id de un mensaje
    y lo elimina
    '''
    db.messages.delete_one({"mid": mid})
    aviso = f'Mensaje con id {mid} ha sido eliminado'
    return json.jsonify({"result": "success", "message": aviso})

@app.route("/text-search")
def get_text_search()
    '''
    Búsqueda de texto
    '''
    return None

if __name__ == "__main__":
    #app.run()
    app.run(debug=True) # Para debuggear!
