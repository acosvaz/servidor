<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/libraries/REST_Controller.php';

class Catalogo extends REST_Controller {
    
    public function __construct(){
        parent:: __construct();
        $this->load->model('Ventas_model');
    }
    
    public function index_get(){
        $catalogo = $this->Ventas_model->get();
        
        if(!is_null($catalogo)){
            $this->response(array('response' => $catalogo), 200);
        } else {
            $this->response(array('error' => 'No hay promociones disponibles'), 404);
        }
    }
    
    public function find_get($id){
        
        if(!$id){
            $this->response(null, 400);
        }
        
        $catalogo = $this->Catalogoapi_model->get($id);
        
        if(!is_null($catalogo)){
            $this->response(array('response' => $catalogo), 200);
        } else {
            $this->response(array('error' => 'Catalogo no disponible'), 404);
        }
    }
    
}

