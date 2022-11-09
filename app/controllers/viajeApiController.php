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

    //----------------------------Funcion getAll con ordenar(Ok)--------------------//
    public function getViajes() {
        $params=$_GET;
        var_dump($params);
        var_dump(count($params));
        if((count($params)=='1')&&(empty($param))){
            $viajes = $this->model->getAll();
            $this->view->response($viajes);
        }
        else{
        foreach($params as $param =>$key){
            
            //echo"$param  -> $key----- ";
            switch ($param) {
                case 'order':
                if(!empty($key==='asc')){
                    $order=ucfirst($key); //paso el parametro a mayuscula para poder usarlo en MySQL
                    $viajes = $this->model->orderViaje($order);
                    $this->view->response($viajes);
                }
                else if (!empty($key==='desc')){
                    $order=ucfirst($key);
                    $viajes = $this->model->orderViaje($order);
                    $this->view->response($viajes);
                }
                else{
                    //sino devuelve todo desordenado
                    if(empty($key)){
                    $viajes = $this->model->getAll();
                    $this->view->response($viajes);
                    }
                }
                    break;
                case 'page':
                    if(!empty($_GET['page'])){
                    $page=$_GET['page'];
                    $limit=4;
                    $offset=((int)$page-1)*$limit;
                    $viajes = $this->model->getAllPaginated($limit, $offset); 
                    $this->view->response($viajes, 200);
                }
                else{
                    $viajes = $this->model->getAll();
                    $this->view->response($viajes);
                }
                    break;
                case 'salida':
                    //filtro por salida
                    if(!empty($key)){
                    $viajes = $this->model->getFilterViaje($key); //tomo los datos ingresados
                    $this->view->response($viajes);
                    }
                    else{
                        echo"no existe ningun viaje con la salida ingresada";
                    }
                    break;
                default:
                //siempre muestra el default
                    if(empty($key)){
                    $viajes = $this->model->getAll();
                    $this->view->response($viajes); 
                    }
                    break;
                }
        }  
    } 
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
        //borra solo usuario logueado
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }

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
        //borra solo usuario logueado
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }

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

    //----------------------------Funcion filtroViaje (Ok)--------------------//
    public function filterSearchViaje()
    {
        $salida=$_GET['salida'];
        $destino=$_GET['salida'];
        $dia=$_GET['salida'];
        var_dump($salida, $destino, $dia);
        $viajes = $this->model->getFilterViaje($salida, $destino, $dia); //tomo los datos ingresados
        $this->view->response($viajes);
    }

}