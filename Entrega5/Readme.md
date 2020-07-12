# Readme Entrega 5 grupos 98 y 99

## Cómo usar las funcionalidades de esta entrega:

1. Se debe ingresar a la [página](http://codd.ing.puc.cl/~grupo98/index.php) de la aplicación.

2. Hacer login con el usuario de correo `BLANK` y contraseña `BLANK` (en bbdd E3) de usuario `BLANK` y uid `BLANK` (en bbdd E4).

3. En la página principal hacer click en el botón rojo `MENSAJES`.

4. Elegir la funcionalidad que se desea evaluar.

### Respecto a enviar mensajes:

- Enviar mensaje al usuario de correo `BLANK`, contraseña `BLANK`, usuario `BLANK` y uid `BLANK`. Comprobar haciendo login, mediante el text-search o en `MENSAJES ENVIADOS`.

### Respecto a al text-search:

- Si no se entrega nada retornamos todos los mensajes (con límite de X).

- Si sólo se entrega `userId` entonces sólo se busca que el sender sea dicho usuario.

- Si se entrega `userId` y otros parámetros se busca por todos ellos.

- Si no se entrega `userId`, pero sí otros parámetros se busca por los parámetros entregados.

### Respecto al mapa de mensajes:

- Usando el usuario recomendado utilizar fechas `BLANK` y `BLANK`.

- En el mapa los marcadores poseen un pop-up con la fecha y el contenido. Así, se pueden testear fácilmente distintas fechas y ver cómo desaparecen los marcadores.

- Si hay 2 marcadores exactamente en la misma latitud y longitud solo se podrá presionar uno.

## Qué hace la [API](http://go-art.herokuapp.com) en Heroku

- La ruta `/users` retorna los usuarios.

- La ruta `/users/:id` retorna el usuario de dicho id.

- La ruta `/messages` retorna los mensajes. Cuando además le agregan los 2 ids busca los enviados y recibidos entre dichos ids.

- La ruta `/messages/:id` retorna el mensaje con dicho id.

- Para el text-search se debe hacer via body de un get.

- La función `post_messages` implementa el envío de un mensaje.

- Implementada completamente. La función que implementa este requisito es `delete_messages`.

## Consideraciones

- Las funciones que daban problemas porque retornaban demasiados mensajes tuvimos que ponerles un límite de máximo X mensajes.

- Para búsqueda de texto tuvimos que crear un atributo `dummy` de valor `"x"` y agregarlo al índice para así poder buscar teniendo disponibe sólo palabras prohibidas. IMPRIMIR?

    