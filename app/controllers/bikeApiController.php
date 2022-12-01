<?php
require_once './app/models/bikeModel.php';
require_once './app/views/apiView.php';


class BikeeApiController {
    private $model;
    private $view;
    private $data;

    public function __construct() {
        $this->model = new BikeModel();
        $this->view = new ApiView();
       
        // lee el body del request
        $this->data = file_get_contents("php://input");

    }
    //----------------------------Funcion getData (Ok)--------------------//
    private function getData() {
        return json_decode($this->data);
    }

    public function getBikes(){
        $bikes=$this->model->getAll();
        return $this->view ->response($bikes);
    }

}