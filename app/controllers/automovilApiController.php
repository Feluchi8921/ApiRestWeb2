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
        $params=$_GET;
        var_dump($params);
        var_dump(count($params));
        if((count($params)=='1')&&(empty($param))){
            $automoviles = $this->model->getAll();
            $this->view->response($automoviles);
        }
        else{
        foreach($params as $param =>$key){
            
            //echo"$param  -> $key----- ";
            switch ($param) {
                case 'order':
                if(!empty($key==='asc')){
                    $order=ucfirst($key); //paso el parametro a mayuscula para poder usarlo en MySQL
                    $automoviles = $this->model->orderAutomovil($order);
                    $this->view->response($automoviles);
                }
                else if (!empty($key==='desc')){
                    $order=ucfirst($key);
                    $automoviles = $this->model->orderAutomovil($order);
                    $this->view->response($automoviles);
                }
                else{
                    //sino devuelve todo desordenado
                    if(empty($key)){
                    $automoviles = $this->model->getAll();
                    $this->view->response($automoviles);
                    }
                }
                    break;
                case 'page':
                    if(!empty($key)){
                    $page=$key;
                    $limit=4;
                    $offset=((int)$page-1)*$limit;
                    $automoviles = $this->model->getAllPaginated($limit, $offset); 
                    $this->view->response($automoviles, 200);
                    }
                    else{
                        $automoviles = $this->model->getAll();
                        $this->view->response($automoviles);
                    }
                    break;
                case 'patente':
                    //filtro por salida
                    if(!empty($key)){
                    $automoviles = $this->model->getFilterAutomovil($key); //tomo los datos ingresados
                    $this->view->response($automoviles);
                    }
                    else{
                        echo"no existe ningun viaje con la salida ingresada";
                    }
                    break;
                default:
                //siempre muestra el default
                    if(empty($key)){
                    $automoviles = $this->model->getAll();
                    $this->view->response($automoviles); 
                    }
                    break;
                }
        }  
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