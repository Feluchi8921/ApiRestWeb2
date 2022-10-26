<?php
require_once './app/models/viajeModel.php';
require_once './app/views/apiView.php';

class ViajeApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new ViajeModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }
    //----------------------------Funcion geData (Ok)--------------------//
    private function getData() {
        return json_decode($this->data);
    }

    //----------------------------Funcion getAll (Ok)--------------------//
    public function getViajes($params = null) {
        $viajes = $this->model->getAll();
        $this->view->response($viajes);
    }

    //----------------------------Funcion get (Ok)--------------------//
    public function getViaje($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $viaje = $this->model->get($id);

        // si no existe devuelvo 404
        if ($viaje){
            $this->view->response($viaje);
        }
        else {
            $this->view->response("El viaje con el id=$id no existe", 404);
        }
    }

    //----------------------------Funcion delete (Ok)--------------------//

    public function deleteViaje($params = null) {
        $id = $params[':ID'];

        $viaje = $this->model->get($id);
        if ($viaje) {
            $this->model->delete($id);
            $this->view->response($viaje);
        } 
        else {
            $this->view->response("El viaje con el id=$id no existe", 404);
    }
    }
    //----------------------------Funcion insert (Ok)--------------------//
    
    public function insertViaje($params = null) {
        $viaje = $this->getData();
        if (empty($viaje->salida) || empty($viaje->destino) || empty($viaje->dia) || empty($viaje->horario) ||
         empty($viaje->lugares) || empty($viaje->mascota) || empty($viaje->precio) || empty($viaje->datos) || empty($viaje->id_automovil)) {
            $this->view->response("Complete los datos", 400);
        } 
        else {
            $id = $this->model->insert($viaje->salida, $viaje->destino, $viaje->dia, $viaje->horario, $viaje->lugares, $viaje->mascota, $viaje->precio, $viaje->datos, $viaje->id_automovil);
            $this->view->response("El viaje se insertó con éxito con el id=$id", 201);
        }
    }

}