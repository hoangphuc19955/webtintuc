<?php
/**
  * 
  */
 class Permission_models extends CI_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->database();
 	}

 	public function get_permission()
 	{
 		return $this->db->get('user_permission')->result_array();
 	}
 } 
?>