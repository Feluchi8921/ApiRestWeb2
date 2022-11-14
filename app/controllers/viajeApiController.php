<?php
require_once './app/models/viajeModel.php';
require_once './app/views/apiView.php';
require_once './app/helpers/authApiHelper.php';

class ViajeApiController {
    private $model;
    private $view;
    private $authHelper;
    private $data;

    public function __construct() {
        $this->model = new ViajeModel();
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
    public function getViajes() {
            $orderBy = $_GET["orderBy"] ?? null;
            $order = $_GET["order"] ?? null;
            $limit = $_GET["limit"] ?? null;
            $page =  $_GET["page"] ?? null;
            $column =  $_GET["column"] ?? null; 
            $filtervalue = $_GET["filtervalue"] ?? null;
            $columns = [
                "id_viaje" => "id_viaje",
                "salida" => "salida",
                "destino" => "destino",
                "dia" => "dia",
                "horario" => "horario",
                "lugares" => "lugares",
                "mascota" => "mascota",
                "precio" => "precio",
                "datos" => "datos",
                "id_automovil" => "id_automovil"
            ];
            foreach ($_GET as $key => $value) {
                if(in_array(strtolower($key), $columns)){
                    $column = $columns[strtolower ($key)];
                    $filtervalue = $value;
                }
            }
            $viajes = $this->model->getAll($orderBy, $order, $limit, $page, $column, $filtervalue);

        if($viajes)
            return $this->view->response($viajes, 200);
        else
            $this->view->response("El viaje ingresado no existe", 404);
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

        $id_viaje = $params[':ID'];
        var_dump($id_viaje);
        $viaje = $this->model->get($id_viaje);
        if (!empty($viaje)) {
            $this->model->delete($id_viaje);
            $this->view->response("EL viaje "+$viaje+ "se eliminó correctamente");
        } 
        else {
            $this->view->response("El viaje con el id=$id_viaje no existe", 404);
    }
    }
    //----------------------------Funcion insert (Ok)--------------------//
    
    public function insertViaje($params = null) {
        //inserta solo usuario logueado
        if(!$this->authHelper->isLoggedIn()){
           $this->view->response("No estas logueado", 401);
            return;
        }

        $viaje = $this->getData();
        
        if (empty($viaje->salida) || empty($viaje->destino) || empty($viaje->dia) || empty($viaje->horario) ||empty($viaje->lugares) || empty($viaje->mascota) || empty($viaje->precio) || empty($viaje->datos) || empty($viaje->id_automovil)) {
            $this->view->response("Complete los datos", 400);
        } 
        else {
            $id_viaje = $this->model->insert($viaje->salida, $viaje->destino, $viaje->dia, $viaje->horario, $viaje->lugares, $viaje->mascota, $viaje->precio, $viaje->datos, $viaje->id_automovil);
            $viaje=$this->model->get($id_viaje); 
            $this->view->response("El viaje con el id=$id_viaje se insertó con éxito", 201);
        }
    }
    //----------------------------Funcion edit (Ok)--------------------//
    function editViaje($params = null) {
        //edita solo usuario logueado
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logueado", 401);
            return;
        }

        $id_viaje = $params[':ID'];
        $viaje=$this->model->get($id_viaje);
        
        if ($viaje) {
            $viaje = $this->getData();
            $this->model->update($viaje->salida, $viaje->destino, $viaje->dia, $viaje->horario, $viaje->lugares, $viaje->mascota, $viaje->precio, $viaje->datos, $viaje->id_automovil, $id_viaje);
            $viaje = $this->model->get($id_viaje);
            $this->view->response("El viaje con el id=$id_viaje se actualizo correctamente", 200);

        } else {
            return $this->view->response("El viaje con el id=$id_viaje no existe", 404);
        }
    }



}