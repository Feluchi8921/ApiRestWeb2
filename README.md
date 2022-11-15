# API REST para los recursos viajes y automoviles
Una API REST sencilla para manejar un CRUD de viajes y automoviles

## Importar la base de datos
- importar base de datos database/db_viajes.php

## Prueba con postman
Los endpoint de la API son: 
                                ------Solicitudes de Viajes------
·Para obtener todos los viajes: http://localhost/apiRest/api/viajes

·Para obtener un viaje por id: http://localhost/apiRest/api/viajes/id
                            Ejemplo: http://localhost/apiRest/api/viajes/10
                                
·Para insertar un viaje (método POST): http://localhost/apiRest/api/viajes
                                (Pasar variables por el body, antes debe autenticarse. Ver al final de readme)
                                {
                                "salida": "Azul",
                                "destino": "Mar del Plata",
                                "dia": "2022-12-14",
                                "horario": "06:00",
                                "lugares": "2",
                                "mascota": "ninguna",
                                "precio": "2200",
                                "datos": "paso a buscar por puerta",
                                "id_automovil": "9"
                                }

·Para editar un viaje (método PUT): http://localhost/apiRest/api/viajes/ID
                        Ejemplo: http://localhost/apiRest/api/viajes/19
                                (Pasar variables por el body, antes debe autenticarse. Ver al final de readme)
                                {
                                "id_viaje": "19",
                                "salida": "Mar del Plata",
                                "destino": "Azul",
                                "dia": "2022-12-03",
                                "horario": "07:00",
                                "lugares": "1",
                                "mascota": "gato",
                                "precio": "2500",
                                "datos": "gato en canil sin excepcion",
                                "id_automovil": "14"
                                }

·Para eliminar un viaje por id (método DELETE): http://localhost/apiRest/api/viajes/id
                        Ejemplo: http://localhost/apiRest/api/viajes/17

·Para obtener todos los viajes paginados (método GET): pasar por parámetro la página y el límite 
                        Ejemplo: http://localhost/apiRest/api/viajes?page=1&limit=3

·Para obtener un viaje filtrado por columna (método GET): pasar por parámetro la columna que quiero filtrar y el valor
                            Ejemplos: salida: http://localhost/apiRest/api/viajes?salida=Tandil
                                    destino: http://localhost/apiRest/api/viajes?destino=Pehuajo
                                    día: http://localhost/apiRest/api/viajes?dia=2022-12-23
                                    horario: http://localhost/apiRest/api/viajes?horario=07:00
                                    lugares: http://localhost/apiRest/api/viajes?lugares=2
                                    mascota: http://localhost/apiRest/api/viajes?mascota=ninguna
                                    precio: http://localhost/apiRest/api/viajes?precio=1800
                                    datos: http://localhost/apiRest/api/viajes?datos=puntualidad
                                    id_automovil: http://localhost/apiRest/api/viajes?id_automovil=6
                                    
·Para obtener una columna ordenada ascendente (método GET): pasar por parámetro la columna y el orden
                            Ejemplo: http://localhost/apiRest/api/viajes?orderBy=destino&order=asc

·Para obtener una columna ordenada descendente:
                            Ejemplo: http://localhost/apiRest/api/viajes?orderBy=salida&order=desc

·Para obtener una columna ordenada y paginada:
                            Ejemplo: http://localhost/apiRest/api/viajes?orderBy=salida&order=asc&page=1&limit=3


                                ------Solicitudes de Automoviles------

·Para obtener todos los automoviles (método GET): http://localhost/apiRest/api/automoviles

·Para obtener un automovil por id (método GET): http://localhost/apiRest/api/autmovil/id
                            Ejemplo: http://localhost/apiRest/api/automoviles/6

·Para insertar un automovil (método POST): http://localhost/apiRest/api/automoviles
                                (Pasar variables por el body, antes debe autenticarse. Ver al final de readme)
                                        {
                                        "marca": "Fiat",
                                        "modelo": "Uno",
                                        "anio": "2000",
                                        "color": "Rojo",
                                        "patente": "HPO238",
                                        "licencia": "25569842"
                                        },

·Para editar un automovil (método PUT): http://localhost/apiRest/api/automoviles/ID
                                Ejemplo: http://localhost/apiRest/api/automoviles/18
                                (Pasar variables por el body, antes debe autenticarse. Ver al final de readme)
                                        {
                                        "id_automovil": "18",
                                        "marca": "Fiat",
                                        "modelo": "Fiorino",
                                        "anio": "1988",
                                        "color": "Blanca",
                                        "patente": "AHP563",
                                        "licencia": "24563214"
                                        }

·Para eliminar un automovil por id (método DELETE): http://localhost/apiRest/api/automoviles/id
                        Ejemplo: http://localhost/apiRest/api/automoviles/20

·Para obtener todos los automoviles (método GET): pasar por parámetro la página y el límite
                        Ejemplo: http://localhost/apiRest/api/automoviles?page=2&limit=3

·Para obtener un viaje filtrado por columna (método GET): pasar por parámetro la columna que quiero filtrar y el valor
                            Ejemplos: marca: http://localhost/apiRest/api/automoviles?marca=fiat
                                    modelo: http://localhost/apiRest/api/automoviles?modelo=corsa
                                    anio: http://localhost/apiRest/api/automoviles?anio=2002
                                    color: http://localhost/apiRest/api/automoviles?color=rojo
                                    patente: http://localhost/apiRest/api/automoviles?patente=LMP979
                                    licencia= http://localhost/apiRest/api/automoviles?licencia=28526552

·Para obtener una columna ordenada ascendente (método GET): pasar por parámetro la columna y el orden
                            Ejemplo: http://localhost/apiRest/api/automoviles?orderBy=marca&order=asc

·Para obtener una columna ordenada descendente (método GET): pasar por parámetro la columna y el orden
                            Ejemplo: http://localhost/apiRest/api/automoviles?orderBy=modelo&order=desc

·Para obtener una columna ordenada y paginada:
                            Ejemplo: http://localhost/apiRest/api/automoviles?orderBy=marca&order=desc&page=2&limit=3

                                 ------Autenticación------
                                 
·Para obtener token (método GET): http://localhost/apiRest/api/auth/token
                        Auth->Basic:
                        user: admin1@gmail.com
                        password: $2a$12$xbGFoxZYr.3BhVgBqIvLqOBpVwouDiCDwIvrfwiQGJtnqNJmrNkpG
                        Luego de obtener el token insertarlo en Auth->Bearer->Token (recordar copiar sin comillas)