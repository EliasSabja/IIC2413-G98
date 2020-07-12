# Readme Entrega 5 grupos 98 y 99

## Cómo usar las funcionalidades de esta entrega:

1. Se debe ingresar a la [página](http://codd.ing.puc.cl/~grupo98/index.php) de la aplicación.

2. Hacer login con el usuario de correo `Jessica.Graham@gmail.com` y contraseña `123` (en bbdd E3) de username `Wilfredo Arechavaleta` y uid `36` (en bbdd E4).

3. En la página principal hacer click en el botón rojo `MENSAJES`.

4. Elegir la funcionalidad que se desea evaluar.

### Respecto a enviar mensajes:

- Enviar mensaje al usuario de correo `Christina.Brown@gmail.com`, contraseña `123`, usuario `James Hetfield` y uid `1`. Comprobar haciendo login, mediante el text-search o en `MENSAJES ENVIADOS`.

- La longitudes y latitudes del mensaje nuevo se asignan al azar dentro de la ciudad Cremona, Italia.

### Respecto a al text-search:

- Si no se entrega nada retornamos todos los mensajes (con límite de 30).

- Si sólo se entrega `userId` entonces sólo se busca que el sender sea dicho usuario.

- Si se entrega `userId` y otros parámetros se busca por todos ellos.

- Si no se entrega `userId`, pero sí otros parámetros se busca por los parámetros entregados.

### Respecto al mapa de mensajes:

- Usando el usuario recomendado, utilizar fechas `01/01/2016` y `31/07/2020`.

- En el mapa los marcadores poseen un pop-up con la fecha y el contenido. Así, se pueden testear fácilmente distintas fechas y ver cómo desaparecen los marcadores.

- Si hay 2 marcadores exactamente en la misma latitud y longitud sólo se podrá presionar uno.

## Qué hace la [API](http://go-art.herokuapp.com) en Heroku

- La ruta `/users` retorna los usuarios.

- La ruta `/users/:id` retorna el usuario de dicho id.

- La ruta `/messages` retorna los mensajes.

- La ruta `/messages?id1=X` retorna los mensajes en los que el sender sea el usuario de `uid X`. Si se utiliza `id2` retorna por receptant. Se pueden usar ambos filtros a la vez.

- La ruta `/messages/:id` retorna el mensaje con dicho id.

- Para el text-search se debe hacer vía body de un post.

- La función `post_messages` implementa el envío de un mensaje.

## Consideraciones

- Las funciones que daban problemas porque retornaban demasiados mensajes tuvimos que ponerles un límite de máximo 20 o 30 mensajes.

- Para la búsqueda por texto tuvimos que crear un atributo `dummy` de valor `"x"` y agregarlo al índice para así poder buscar teniendo disponibe sólo palabras prohibidas. Consideramos que no es necesario mostrarlo en la página puesto que no es un atributo inherente de los mensajes y es igual para todos.
    