<?php

class UserModel
{
    private $db;
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_viajes;charset=utf8', 'root', '');
    }

    //----------------------------Funcion getUser (Ok)--------------------//
    public function getUser($email, $password) //le paso el email como usuario y la contraseña, uso la db vieja
    {
        $query = $this->db->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
        $query->execute([$email, $password]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
