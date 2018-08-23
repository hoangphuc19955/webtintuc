<?php
/**
  * 
  */
 class Detailpermission_models extends CI_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->database();
 	}

 	public function add_detail_permission($id_role,$id_permission,$checked='')
 	{
 		$data = array(
 			'id_user_role' => $id_role,
 			'id_user_permission' => $id_permission,
 			'checked'            => $checked
 		);
 		$this->db->insert('detail_permission',$data);
 	}

 	public function update_detail_permission($data,$id_role,$id_permission)
 	{
 		$this->db->where('id_user_role',$id_role)->where('id_user_permission',$id_permission)->update('detail_permission',$data);
 	}

 	public function get_detail_permission_by_id($id_role)
 	{
 		$this->db->join('user_permission','user_permission.id_user_permission = detail_permission.id_user_permission');
 		return $this->db->where('id_user_role',$id_role)->get('detail_permission')->result_array();
 	}
 } 
?>