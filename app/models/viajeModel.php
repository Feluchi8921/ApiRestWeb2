<?php

class ViajeModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_viajes;charset=utf8', 'root', '');
    }

    //----------------------------Funcion getAll(Ok) --------------------//
    public function getAll($orderBy, $order, $limit, $page, $column, $filtervalue){
       
        $params = []; 
        
        $query_sentence = "SELECT * FROM viajes";
        
        if($column != null){
            $query_sentence .= " WHERE  $column = ?";
            array_push($params, $filtervalue);
        }

        if($orderBy != null){
            $query_sentence .= " ORDER BY $orderBy";
            
        }
        if($order != null){
            $query_sentence .= " $order";
           
        }
       
        if($page == null){
            $page=1;
        }

        if(($page != null)&&($limit != null)){
            $offset=($page-1)*$limit;
            $query_sentence .= " LIMIT  $limit OFFSET $offset";
        }

        $query = $this->db->prepare($query_sentence);
        $query->execute($params);
        $viajes = $query->fetchAll(PDO::FETCH_OBJ); 
        return $viajes;
    }
    
    //----------------------------Function get (Ok) --------------------//
    function get($id_viaje){
        $sentencia = $this->db->prepare( "SELECT * FROM viajes WHERE id_viaje=?");
        $sentencia->execute(array($id_viaje));
        $viaje = $sentencia->fetch(PDO::FETCH_OBJ);
        return $viaje;
    }



    //----------------------------Funcion insert (Ok) --------------------//

    public function insert($salida, $destino, $dia, $horario, $lugares, $mascota, $precio, $datos, $id_automovil)
    {
        $query = $this->db->prepare("INSERT INTO viajes(salida, destino, dia, horario, lugares, mascota, precio, datos, id_automovil) VALUES(?,?,?,?,?,?,?,?,?)");
        $query->execute([$salida, $destino, $dia, $horario, $lugares, $mascota, $precio, $datos, $id_automovil]);

        return $this->db->lastInsertId();
    }

    //----------------------------Funcion delete (Ok) --------------------//

    public function delete($id_viaje)
    {
        $query = $this->db->prepare("DELETE FROM viajes WHERE id_viaje=?");
        $query->execute(array($id_viaje));
    }

    
    //----------------------------Funcion edit (Ok) --------------------//
    
    public function update($salida, $destino, $dia, $horario, $lugares, $mascota, $precio, $datos, $id_automovil, $id_viaje)
    {
        $query =  $this->db->prepare("UPDATE viajes SET salida=?, destino=?, dia=?, horario=?, lugares=?, mascota=?, precio=?, datos=?, id_automovil=? WHERE id_viaje=?");
        $query->execute(array($salida, $destino, $dia, $horario, $lugares, $mascota, $precio, $datos, $id_automovil, $id_viaje));
    }


    }
