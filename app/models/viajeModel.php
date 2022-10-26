<?php

class ViajeModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_viajes;charset=utf8', 'root', '');
    }

    //----------------------------Funcion getAll (Ok) --------------------//

    public function getAll()
    {
        $query = $this->db->prepare("SELECT * FROM viajes");
        $query->execute();
        $viajes = $query->fetchAll(PDO::FETCH_OBJ);

        return $viajes;
    }
    //----------------------------Function get (Ok) --------------------//
    public function get($id_viaje)
    {
        $query = $this->db->prepare("SELECT * FROM viajes WHERE id_viaje=$id_viaje");
        $query->execute();
        $viajes = $query->fetchAll(PDO::FETCH_OBJ);
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
}
