<?php
require_once './app/models/automovilModel.php';
require_once './app/views/apiView.php';

class automovilApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new AutomovilModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    //----------------------------Funcion getData (Ok)--------------------//
    private function getData() {
        return json_decode($this->data);
    }

    //----------------------------Funcion getAll (Ok)--------------------//
    public function getAutomoviles($params = null) {
        $automoviles = $this->model->getAll();
        $this->view->response($automoviles);
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
        $id = $params[':ID'];

        $automovil = $this->model->get($id);
        if ($automovil) {
            $this->model->delete($id);
            $this->view->response($automovil);
        } 
        else {
            $this->view->response("El automovil con el id=$id no existe", 404);
    }
    }

    //----------------------------Funcion insert (Ok)--------------------//  
    public function insertAutomovil($params = null) {
        $automovil = $this->getData();
        if (empty($automovil->salida) || empty($automovil->destino) || empty($automovil->dia) || empty($automovil->horario) ||
         empty($automovil->lugares) || empty($automovil->mascota) || empty($automovil->precio) || empty($automovil->datos) || empty($automovil->id_automovil)) {
            $this->view->response("Complete los datos", 400);
        } 
        else {
            $id = $this->model->insert($automovil->salida, $automovil->destino, $automovil->dia, $automovil->horario, $automovil->lugares, $automovil->mascota, $automovil->precio, $automovil->datos, $automovil->id_automovil);
            $this->view->response("El automovil se insertó con éxito con el id=$id", 201);
        }
    }

}