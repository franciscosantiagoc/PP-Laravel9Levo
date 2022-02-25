Ejercicio con API Sanctum (sencillo):

Con Postman,
vamos a mostrar los datos de un usuario guardados en Laravel,
- puede ser solo el email con el que se registró el usuario

Condiciones:
- si mando una API key que no es la del usuario, devuelvo un error 403 (Unauthorized)
- si no mando una API key, devuelvo un 401 (Unauthenticated ¿Y usted quién es?)
