<?php

class AutomovilModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_viajes;charset=utf8', 'root', '');
    }


     //----------------------------Funcion getAll(Ok) --------------------//
     public function getAll($orderBy, $order, $limit, $page, $column, $filtervalue){
       
        $params = []; 
        
        $query_sentence = "SELECT * FROM automoviles";
        
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
        $automoviles = $query->fetchAll(PDO::FETCH_OBJ); 
        return $automoviles;
    }

    //----------------------------Funcion get (ok)--------------------//

    public function get($id_automovil)
    {
        $query = $this->db->prepare("SELECT * FROM automoviles WHERE id_automovil=$id_automovil");
        $query->execute();
        $automoviles = $query->fetchAll(PDO::FETCH_OBJ);
        return $automoviles;
    }

    //----------------------------Funcion insert (Ok)--------------------

    public function insert($marca, $modelo, $anio, $color, $patente, $licencia)
    {
        $query = $this->db->prepare("INSERT INTO automoviles(marca, modelo, anio, color, patente, licencia) VALUES(?,?,?,?,?,?)");
        $query->execute(array($marca, $modelo, $anio, $color, $patente, $licencia));

        return $this->db->lastInsertId();
    }

    //----------------------------Funcion edit (Ok)--------------------//

    //primero llamo a la funcion get, que ya esta arriba

    public function edit($marca, $modelo, $anio, $color, $patente, $licencia, $id_automovil)
    {
        $query = $this->db->prepare("UPDATE automoviles SET marca=?, modelo=?, anio=?, color=?, patente=?, licencia=? WHERE id_automovil=?");
        $query->execute(array($marca, $modelo, $anio, $color, $patente, $licencia, $id_automovil));
    }

    //----------------------------Funcion delete (ok)--------------------//

    public function delete($id_automovil)
    {
        $query = $this->db->prepare("DELETE FROM automoviles WHERE id_automovil=?");
        $query->execute(array($id_automovil));
    }
    
}

