# API REST para el recurso de viajes y automoviles
Una API REST sencilla para manejar un CRUD de viajes y automoviles

## Importar la base de datos
- importar base de datos database/db_viajes.php


## Prueba con postman
Los endpoint de la API es: 
                                ------Viajes------

·Para obtener todos los viajes: http://localhost/apiRest/api/viajes

·Para obtener un viaje por id: http://localhost/apiRest/api/viajes/id
                            Ejemplo: http://localhost/apiRest/api/viajes/10

·Para obtener un viaje por id: http://localhost/apiRest/api/viajes/id

·Para insertar un viaje (método POST): http://localhost/apiRest/api/viajes?salida=Azul&destino=Tandil&dia=2022-12-17&horario=08:00&lugares=1&mascota=ninguna&precio=1800&datos=traer%mate&id_automovil=6

·Para editar un viaje (método PUT): http://localhost/apiRest/api/viajes/12?salida=Tandil&destino=Balcarse&dia=12-12-2022&horario=11:00&lugares=3&mascota=perro&precio=1500&datos=ninguno&id_automovil=8

·Para eliminar un viaje por id: http://localhost/apiRest/api/viajes/id/delete

·Para obtener todos los viajes paginados: http://localhost/apiRest/api/viajes?page=1&limit=3

·Para obtener todos los viajes paginados: http://localhost/apiRest/api/viajes?page=1&limit=2

·Para obtener un viaje filtrado por columna:
                            Ejemplos: salida: http://localhost/apiRest/api/viajes?salida=Tandil
                                    destino: http://localhost/apiRest/api/viajes?destino=Azul
                                    día: http://localhost/apiRest/api/viajes?dia=2022-12-17
                                    horario: http://localhost/apiRest/api/viajes?horario=09:00
                                    lugares: http://localhost/apiRest/api/viajes?lugares=3
                                    mascota: http://localhost/apiRest/api/viajes?mascota=ninguna
                                    precio: http://localhost/apiRest/api/viajes?precio=2000
                                    datos: http://localhost/apiRest/api/viajes?datos=perro%20en%20la%20caja
                                    id_automovil: http://localhost/apiRest/api/viajes?id_automovil=8
                                    
·Para obtener una columna ordenada ascendente:
                            Ejemplo: http://localhost/apiRest/api/viajes?orderBy=destino&order=asc

·Para obtener una columna ordenada descendente:
                            Ejemplo: http://localhost/apiRest/api/viajes?orderBy=lugares&order=desc

·Para obtener una columna ordenada y paginada:
                            Ejemplo: http://localhost/apiRest/api/viajes?orderBy=salida&order=asc&page=1&limit=3


                                ------Automoviles------

·Para obtener todos los automoviles: http://localhost/apiRest/api/automoviles

·Para obtener un automovil por id: http://localhost/apiRest/api/autmovil/id
                            Ejemplo:http://localhost/apiRest/api/automoviles/7

·Para insertar un automovil (método POST): http://localhost/apiRest/api/automovil?marca=Ford&modelo=F100&anio=1990&color=blanca&patente =BJI892&licencia=12856945

·Para obtener todos los automoviles paginados: http://localhost/apiRest/api/automoviles?page=1&limit=3

·Para obtener un viaje filtrado por columna:
                            Ejemplos: marca: http://localhost/apiRest/api/automoviles?marca=fiat
                                    modelo: http://localhost/apiRest/api/automoviles?modelo=corsa
                                    anio: http://localhost/apiRest/api/automoviles?anio=2022
                                    color: http://localhost/apiRest/api/automoviles?color=rojo
                                    patente: http://localhost/apiRest/api/automoviles?patente=LMP979
                                    licencia= http://localhost/apiRest/api/automoviles?licencia=13847028
·Para obtener una columna ordenada ascendente:
                            Ejemplo: http://localhost/apiRest/api/automoviles?orderBy=marca&order=asc

·Para obtener una columna ordenada descendente:
                            Ejemplo: http://localhost/apiRest/api/automoviles?orderBy=marca&order=desc

·Para obtener una columna ordenada y paginada:
                            Ejemplo: http://localhost/apiRest/api/automoviles?orderBy=marca&order=desc&page=2&limit=3

                                 ------Autenticación------
                                 
Para obtener token: http://localhost/apiRest/api/auth/token
                    user: admin123
                    password: $2a$12$a.BU6mO2.60bUOmsUNS7BuJc6reGqj7SacZ3R/bQWMrhrC.OXN5oa
                    obtener token en auth Basic: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwibmFtZSI6ImFkbWluMTIzIiwiZXhwIjoxNjY4MDIwNzUzfQ.-GD9fNkd2d7JkgbjDgvD-_KDII3ulxgbJFpJgV7MazA