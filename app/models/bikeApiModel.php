<?php

class BikeModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=bicicleteria;charset=utf8', 'root', '');
    }

    //----------------------------Funcion getAll(Ok) --------------------//
    public function getAll(){
        $query = $this->db->prepare("SELECT * FROM bikes");
        $query->execute();
        $bikes = $query->fetchAll(PDO::FETCH_OBJ); 
        return $bikes;
    }
}