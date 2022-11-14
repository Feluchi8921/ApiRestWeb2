<?php
require_once './app/models/automovilModel.php';
require_once './app/views/apiView.php';
require_once './app/helpers/authApiHelper.php';

class automovilApiController {
    private $model;
    private $view;
    //private $authHelper;
    private $data;

    public function __construct() {
        $this->model = new AutomovilModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    //----------------------------Funcion getData (Ok)--------------------//
    private function getData() {
        return json_decode($this->data);
    }


    //----------------------------Funcion getAll con filtrar, ordenar y paginar (Ok)--------------------//
    public function getAutomoviles() {
        $orderBy = $_GET["orderBy"] ?? null;
        $order = $_GET["order"] ?? null;
        $limit = $_GET["limit"] ?? null;
        $page =  $_GET["page"] ?? null;
        $column =  $_GET["column"] ?? null; 
        $filtervalue = $_GET["filtervalue"] ?? null;
        $columns = [
            "id_automovil" => "id_automovil",
            "marca" => "marca",
            "modelo" => "modelo",
            "anio" => "anio",
            "color" => "color",
            "patente" => "patente",
            "licencia" => "licencia",
        ];
        foreach ($_GET as $key => $value) {
            if(in_array(strtolower($key), $columns)){
                $column = $columns[strtolower ($key)];
                $filtervalue = $value;
            }
        }
        $automoviles = $this->model->getAll($orderBy, $order, $limit, $page, $column, $filtervalue);

    if($automoviles)
        return $this->view->response($automoviles, 200);
    else
        $this->view->response("El automovil ingresado no existe", 404);
 } 

    //----------------------------Funcion get (Ok)--------------------//
    public function getAutomovil($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $automovil = $this->model->get($id);

        // si no existe devuelvo 404
        if ($automovil){
            $this->view->response($automovil);
        }
        else {
            $this->view->response("El automovil con el id=$id no existe", 404);
        }
    }

    //----------------------------Funcion delete (Ok)--------------------//
    public function deleteAutomovil($params = null) {

        $id_automovil = $params[':ID'];

        $automovil = $this->model->get($id_automovil);
        if ($automovil) {
            $this->model->delete($id_automovil);
            $this->view->response("EL automovil con el id=$id_automovil se elimino correctamente");
        } 
        else {
            $this->view->response("El automovil con el id=$id_automovil no existe", 404);
    }
    }

    //----------------------------Funcion insert (Ok)--------------------//  
    public function insertAutomovil($params = null) {
        //inserta solo usuario logueado
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logueado", 401);
            return;
        }
        
        $automovil = $this->getData();
        if (empty($automovil->marca) || empty($automovil->modelo) || empty($automovil->anio)|| empty($automovil->color)|| empty($automovil->patente)|| empty($automovil->licencia)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id_automovil = $this->model->insert($automovil->marca, $automovil->modelo, $automovil->anio, $automovil->color, $automovil->patente, $automovil->licencia);
            $automovil = $this->model->get($id_automovil);
            $this->view->response($automovil, 201);
        }

    }
        //----------------------------Funcion edit (ok)--------------------//
    function editAutomovil($params = null) {
        //edita solo usuario logueado
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logueado", 401);
            return;
        }
        
        $id_automovil = $params[':ID'];
        $automovil=$this->model->get($id_automovil);
        if ($automovil) {
            $automovil = $this->getData();
            $this->model->update($automovil->marca, $automovil->modelo, $automovil->anio, $automovil->color, $automovil->patente, $automovil->licencia, $automovil->id_automovil);
            $viaje = $this->model->get($id_automovil);
            $this->view->response("El automovil con el id=$id_automovil se actualizo correctamente", 200);

        } else {
            return $this->view->response("El automovil con el id=$automovil no existe", 404);
        }
    }
    }
