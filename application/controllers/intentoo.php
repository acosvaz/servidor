<?php
$url = "http://35.227.127.154:8069";
$db = "baseodoo";
$username = "ivettteacosvaz@gmail.com";
$password = "baseodoo";

public function __construct() {
		parent::__construct ();
		$this->load->library ( 'ripcord/ripcord' );
		$this->load->helper ( 'response' );
		$this->load->config ( 'odoo' );
		$this->db = $this->config->item ( 'db' );
		$this->url = $this->config->item ( 'url' );
		// GETTING U/P FROM URL REQUEST
		$username = $this->input->post_get ( 'u' );
		$this->password = $this->input->post_get ( 'p' );
		
		// AUTH
		$this->user_id = $this->ripcord->client ( $this->url . $this->ep_common )->authenticate ( $this->db, $username, $this->password, array () );
		if (( int ) $this->user_id == 0) {
			send_response ( $this->resp_error_code, 'Wrong Credential' );
		}
	}

$common = ripcord::client("$url/xmlrpc/2/common");

$uid = $common->authenticate($db, $username, $password, array());
echo $uid;

?>