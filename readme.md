

#GET
#####  Ruta:

[localhost/backend-inventario/apis/v1/usuarios](localhost/backend-inventario/apis/v1/usuarios "localhost/backend-inventario/apis/v1/usuarios")


Hay 2 formas de hacer get.

1. Si no envio ningun parametro a la ruta , me traerá todos los usuarios en formato json.
2. Si envio un parametro id con un numero de id, me traera la informacion de ese usuario.




#POST
#####  Ruta:

[localhost/backend-inventario/apis/v1/usuarios](localhost/backend-inventario/apis/v1/usuarios "localhost/backend-inventario/apis/v1/usuarios")

Se debe enviar por POST en el body y en formato json los datos del usuario(correo y nombre)

```json
{
  "nombre" : "Nacho2",
  "correo" : "tumacho@gmail.com"
}
```
En caso de exito saldrá un mensaje "agregado con exito".
En caso de que falten datos , le dirá "datos incompletos".


#UPDATE

#####  Ruta:

[localhost/backend-inventario/apis/v1/usuarios](localhost/backend-inventario/apis/v1/usuarios "localhost/backend-inventario/apis/v1/usuarios")

Se debe enviar por POST en el body y en formato json los datos del usuario(correo y nombre)

```json
{
  "id" : 20,
  "nombre" : "Nacho2",
  "correo" : "tumacho@gmail.com"
}
```


En caso de exito saldrá un mensaje "se a actualizado correctamente".
En caso de que falten datos , le dirá "datos incompletos".

#DELETE

#####  Ruta:

[localhost/backend-inventario/apis/v1/usuarios](localhost/backend-inventario/apis/v1/usuarios "localhost/backend-inventario/apis/v1/usuarios")


Para eliminar un usuario , simplemente se debe enviar como parametro el id del usuario a eliminar.

