<?php

class Loginapi_model extends CI_Model {
    
    public function __construct() {
        Parent::__construct();
    $this->load->database();
    }
    
    public function login($username, $password) {
                $this->db->where('username',$username);
                $this->db->where('password',$password);
		$query = $this->db->get('eg_users');
        if ($query->num_rows() === 1) {
            //$result = $query->result();
            //return $result[0]->id;
            return $query->row();
        }
        return false;
    }
}