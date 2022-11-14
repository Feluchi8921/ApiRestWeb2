<?php

class UserModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_viajes;charset=utf8', 'root', '');
    }

    public function getUser($email, $password)
    {
        $query = $this->db->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
        $query->execute([$email, $password]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
