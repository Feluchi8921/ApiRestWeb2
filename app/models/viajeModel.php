<?php

class ViajeModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_viajes;charset=utf8', 'root', '');
    }

    //----------------------------Funcion getAll(Ok) --------------------//
    public function getAll($order, $limit, $page, $column, $filtervalue){
            $params = []; //creo el array

            //armo mi primer sentencia, básica
            $query_sentence = "SELECT * FROM viajes ";
            
            if($column != null){
                //filtro 
                $query_sentence .= " WHERE  $column = ?";
                //Al arreglo params agregale la variable
                array_push($params, $filtervalue);
            }

            if($order != null){
                $query_sentence .= "ORDER BY $order";
                array_push($params, $order);
               
            }
        
            if($page == null){
                $page=0;
            }

            if($limit != null){
                $offset = ($page * $limit) - $limit;
                $query_sentence .= " LIMIT  $limit OFFSET $offset";
            }



            //var_dump($query_sentence);
            $query = $this->db->prepare($query_sentence);
            $query->execute($params);
            $exps = $query->fetchAll(PDO::FETCH_OBJ); 
            return $exps;
        }
    
    //----------------------------Funcion getAllPaginated (Ok) --------------------//

    public function getAllPAginated($limit, $offset)
    {
        $query = $this->db->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM viajes LIMIT $limit OFFSET $offset ");
        $query->execute();
        $viajes = $query->fetchAll(PDO::FETCH_OBJ);

        return $viajes;
    }
    
    //----------------------------Function get (Ok) --------------------//
    public function get($id_viaje)
    {
        $query = $this->db->prepare("SELECT * FROM viajes WHERE id_viaje=$id_viaje");
        $query->execute();
        $viaje = $query->fetchAll(PDO::FETCH_OBJ);
        return $viaje;
    }

    //----------------------------Funcion ordenar(Ok) --------------------//
    public function orderViaje($order)
    {
        $query = $this->db->prepare("SELECT * FROM viajes ORDER BY salida $order");
        $query->execute();
        $viajes = $query->fetchAll(PDO::FETCH_OBJ);
        var_dump($viajes);
        return $viajes;
    }

    //----------------------------Funcion insert (Ok) --------------------//

    public function insert($salida, $destino, $dia, $horario, $lugares, $mascota, $precio, $datos, $id_automovil)
    {
        $query = $this->db->prepare("INSERT INTO viajes(salida, destino, dia, horario, lugares, mascota, precio, datos, id_automovil) VALUES(?,?,?,?,?,?,?,?,?)");
        $query->execute(array($salida, $destino, $dia, $horario, $lugares, $mascota, $precio, $datos, $id_automovil));

        return $this->db->lastInsertId();
    }

    //----------------------------Funcion delete (Ok) --------------------//

    public function delete($id_viaje)
    {
        $query = $this->db->prepare("DELETE FROM viajes WHERE id_viaje=?");
        $query->execute(array($id_viaje));
    }

    
    //----------------------------Funcion edit (Ok) --------------------//
    public function edit($salida, $destino, $dia, $horario, $lugares, $mascota, $precio, $datos, $id_viaje)
    {
        $query =  $this->db->prepare("UPDATE viajes SET salida=?, destino=?, dia=?, horario=?, lugares=?, mascota=?, precio=?, datos=? WHERE id_viaje=?");
        $query->execute(array($salida, $destino, $dia, $horario, $lugares, $mascota, $precio, $datos, $id_viaje));
    }
    //----------------------------Funcion filtroViaje (Ok)--------------------//
    public function getFilterViaje($salida){

            $query = $this->db->prepare("SELECT * FROM `viajes` WHERE salida=?");
            $query->execute(array($salida));
            $viajes = $query->fetchAll(PDO::FETCH_OBJ);
            return $viajes;
        }
    }
