<?php

class AutomovilModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_viajes;charset=utf8', 'root', '');
    }


    //----------------------------Funcion gelAll (ok)--------------------//
    public function getAll()
    {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase

        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT * FROM automoviles");
        $query->execute();

        // 3. obtengo los resultados
        $automoviles = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos

        return $automoviles;
    }
    //----------------------------Funcion ordenar(Ok) --------------------//
    public function orderAutomovil($order)
    {
        $query = $this->db->prepare("SELECT * FROM automoviles ORDER BY marca $order");
        $query->execute();
        $automoviles = $query->fetchAll(PDO::FETCH_OBJ);
        var_dump($automoviles);
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
