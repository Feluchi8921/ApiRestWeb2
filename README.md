# API REST para el recurso de tareas
Una API REST sencilla para manejar un CRUD de tareas

## Importar la base de datos
- importar base de datos database/db_viajes.php


## Prueba con postman
Los endpoint de la API es: 
·Para obtener todos los viajes: http://localhost/apiRest/api/viajes

·Para obtener un viaje por id: http://localhost/apiRest/api/viajes/id
                            Ejemplo: http://localhost/apiRest/api/viajes/10

·Para obtener un viaje filtrado por columna:
                            Ejemplos: 
                            Por salida: http://localhost/apiRest/api/viajes?salida=Tandil
                            Por destino: http://localhost/apiRest/api/viajes?destino=Azul
                            Por día: http://localhost/apiRest/api/viajes?dia=2022-12-17
                            Por horario: http://localhost/apiRest/api/viajes?horario=09:00
                            Por lugares: http://localhost/apiRest/api/viajes?lugares=3
                            Por mascota: http://localhost/apiRest/api/viajes?mascota=ninguna
                            Por precio: http://localhost/apiRest/api/viajes?precio=2000
                            Por datos: http://localhost/apiRest/api/viajes?datos=perro%20en%20la%20caja
                            Por id_automovil: http://localhost/apiRest/api/viajes?id_automovil=8

·Para obtener todos los automóviles: http://localhost/apiRest/api/automoviles
Para obtener un automovil por id: http://localhost/apiRest/api/automovil/id
Para obtener viajes ordenados por salida ascendentes: http://localhost/apiRest/api/viajes?asc
Para obtener viajes ordenados por salida descendente: http://localhost/apiRest/api/viajes?desc
Para obtener viajes ordenados por salida ascendentes: http://localhost/apiRest/api/automoviles?asc
Para obtener viajes ordenados por salida descendente: http://localhost/apiRest/api/automoviles?desc
Para obtener token: http://localhost/apiRest/api/auth/token
                    user: admin123
                    password: $2a$12$a.BU6mO2.60bUOmsUNS7BuJc6reGqj7SacZ3R/bQWMrhrC.OXN5oa
                    obtener token en auth Basic: "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwibmFtZSI6ImFkbWluMTIzIiwiZXhwIjoxNjY4MDIwNzUzfQ.-GD9fNkd2d7JkgbjDgvD-_KDII3ulxgbJFpJgV7MazA"