<?php
require_once './app/models/automovilModel.php';
require_once './app/views/apiView.php';

class automovilApiController {
    private $model;
    private $view;
    private $authHelper;
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

    //----------------------------Funcion getAll con ordenar(Ok)--------------------//
    public function getAutomoviles() {
        //paginacion
        $sizePages=3;
        if(isset ($_GET¨['pagina'])==1){
            header("Location: automoviles");
        }
        else{
            $page=1;
        }
        $start_where=($page-1)*$sizePages;
        $automoviles=$this->model->getAll($start_where,$sizePages);
        $this->view->response($automoviles, 200);
        //si le paso ordenar
        //agregar si ordenar=desc entonces llama a la funcion ordenar descen sino llama asc
        $order=$_GET['order'];
        //var_dump($order);
        if(!empty($order==='asc')){
            $order=ucfirst($order); //paso el parametro a mayuscula para poder usarlo en MySQL
            $automoviles = $this->model->orderAutomovil($order);
            $this->view->response($automoviles);
        }
        if (!empty($order==='desc')){
            $order=ucfirst($order);
            $viajes = $this->model->orderAutomovil($order);
            $this->view->response($viajes);
        }
        
        //sino devuelve todo desordenado
        else{
            $viajes = $this->model->getAll();
            $this->view->response($viajes);
        }
        
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
        //borra solo usuario logueado
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }

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
        //borra solo usuario logueado
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }
        
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