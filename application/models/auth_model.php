<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login($username, $password)
	{
		$query = $this->db->select("id, username")
		->from("users")
		->where("username", $username)
		->where("password", $password)
		->get();
		if($query->num_rows() === 1)
		{
			return $query->row();
		}
		return false;
	}

	public function checkUser($id, $email)
	{
		$query = $this->db->limit(1)->get_where("users", array("id" => $id, "username" => $username));
		return $query->num_rows() === 1;
	}
}

/* End of file auth_model.php */
/* Location: ./application/models/auth_model.php */
