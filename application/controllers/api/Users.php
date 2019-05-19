<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/libraries/REST_Controller.php';
 
class Users extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        // User Model
        $this->load->model('user_model', 'UserModel');
    }

   
     // User Login API
     
    public function login_post()
    {
        header("Access-Control-Allow-Origin: *");

        # XSS Filtering (https://www.codeigniter.com/user_guide/libraries/security.html
	$_POST = json_decode($this->security->xss_clean(file_get_contents("php://input")),true);
	
	//$this->form_validation->set_data($request);
        # Form Validation
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required|max_length[100]');
        if ($this->form_validation->run() == FALSE)
        {
            // Form Validation Error
            $message = array(
                'status' => false,
                'error' => $this->form_validation->error_array(),
                'message' => validation_errors()
            );

            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }
        else
        {
           
            $output = $this->UserModel->user_login($this->input->post('username'), $this->input->post('password'));
            if (!empty($output) AND $output != FALSE)
            {
                // Load Authorization Token Library
                $this->load->library('Authorization_Token');

                //  Token
                $token_data['id'] = $output->id;
                $token_data['full_name'] = $output->full_name;
                $token_data['username'] = $output->username;
                $token_data['email'] = $output->email;
                $token_data['created_at'] = $output->created_at;
                //$token_data['updated_at'] = $output->updated_at;
                $token_data['time'] = time();

                $user_token = $this->authorization_token->generateToken($token_data);

                $return_data = [
                    //'user_id' => $output->id,
                    //'full_name' => $output->full_name,
                    //'email' => $output->email,
                    //'created_at' => $output->created_at,
                    'username' => $output->username,
                    'token' => $user_token,
                ];

                // Login Success
                $message = [
                    'status' => true,
                    'data' => $return_data,
                    'message' => "User login successful"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            } else
            {
                // Login Error
                $message = [
                    'status' => FALSE,
                    'message' => "Invalid Username or Password"
                ];
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
}
