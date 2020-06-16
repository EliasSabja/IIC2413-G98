# Readme Entrega 4 grupos 98 y 99

## Cómo usar la aplicación

1. Se debe descomprimir el archivo dentro de la carpeta.

2. Se debe ejecutar la consola de comandos dentro de la carpeta.

3. Se deben ejecutar en la consola los siguientes comandos:

    ``` python
    pipenv install
    pipenv shell
    python main.py
    ```

4. Ejecutar la aplicación `Postman` y `localhost:5000` sería la ruta por defecto.

5. Ejecutar los links necesarios para revisar la entrega.

## Qué hace la aplicación

### Rutas del tipo GET

1. Todas las rutas básicas implementadas completamente. Las funciones de `main.py` que implementan estos requisitos son:

    - `get_users` la ruta `/users`.

    - `get_user` la ruta `/users/:id`.

    - `get_messages` la ruta `/messages` y cuando a esta se le agregan los 2 ids.

    - `get_message` la ruta `/messages/:id`.

2. Ruta de búsqueda de texto implementada completamente. La función que implementa este requisito es `get_text_search`.

### Ruta del tipo POST

- Implentada completamente. La función que implementa este requisito es `post_messages`.

### Ruta del tipo  DELETE

- Implementada completamente. La función que implementa este requisito es `delete_messages`.

## Consideraciones

- Las funciones que daban problemas porque retornaban demasiados mensajes tuvimos que ponerles un límite.

- Para búsqueda de texto tuvimos que crear un atributo `dummy` de valor `"x"` y agregarlo al índice para así poder buscar teniendo disponibe sólo palabras prohibidas.

- En `get_text_search` manejamos el flujo lógico de la falta de parámetros que no está tan especificado en el enunciado:

  - Si no se entrega `body` retornamos todos los mensajes.

  - Si sólo se entrega `userId` entonces sólo se busca que el sender sea dicho usuario.

  - Si se entrega `userId` y otros parámetros se busca por todos ellos.

  - Si no se entrega `userId` pero sí otros parámetros se busca por los parámetros entregados.
