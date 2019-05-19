
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/libraries/REST_Controller.php';

class Catalogo extends REST_Controller {
    
    public function __construct(){
        parent:: __construct();
        $this->load->model('Catalogoapi_model');
    }
    
    public function index_get(){
        //header("Access-Control-Allow-Origin: *");

        // $_POST = json_decode($this->security->xss_clean(file_get_contents("php://input")),true);

	$this->load->library('Authorization_Token');
	
	$is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {

	$catalogo = $this->Catalogoapi_model->get();
        
        if(!is_null($catalogo)){
            $this->response(array('response' => $catalogo), 200);
        } else {
            $this->response(array('error' => 'No hay promociones disponibles'), 404);
        }
	} else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
}

