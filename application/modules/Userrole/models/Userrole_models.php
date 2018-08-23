<?php
/**
  * 
  */
 class Userrole_models extends CI_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->database();
 	}

 	public function get_user_role()
 	{
 		return $this->db->get('user_role')->result_array();
 	}

 	public function get_user_role_by_slug($slug)
 	{
 	 	return $this->db->where('slug_role',$slug)->get('user_role')->row_array();
 	}

 	public function get_user_role_by_id($id)
 	{
 	 	return $this->db->where('id_user_role',$id)->get('user_role')->row_array();
 	}

 	public function get_user_permission($id_user)
 	{
 		$this->db->select('user_permission.permission_url,detail_permission.checked');
 		$this->db->join('user','user.level = user_role.id_user_role');
 		$this->db->join('detail_permission','detail_permission.id_user_role = user_role.id_user_role');
 		$this->db->join('user_permission','user_permission.id_user_permission = detail_permission.id_user_permission');
 		$this->db->where('detail_permission.checked','checked');
 		$this->db->where('user.id_user',$id_user);
 		
 		return $this->db->get('user_role')->result_array();
 	}

 	public function add_userroles($data)
 	{
 		$this->db->insert('user_role',$data);
 	}

 	public function delete_userroles($id)
 	{
 		$this->db->where('id_user_role',$id)->delete('user_role');
 	}

 	public function update_userroles($data,$id)
 	{
 		$this->db->where('id_user_role',$id)->update('user_role');
 	}

 	public function checkRole($id)
 	{
 		$this->db->join('user','user.level = user_role.id_user_role');
        $this->db->where('user_role.id_user_role',$id);
        
    	return $this->db->get('user_role')->num_rows();
 	}

 	public function checkRole_name($role_name,$id)
 	{
 		if($id !='')
 		{
 			$this->db->where('id_user_role !=',$id);
 		}
 		$this->db->where('slug_role',url_title($role_name));
 		$query = $this->db->get('user_role');
 		if($query->num_rows() >0 )
 		{
 			return FALSE;
 		}
 		else
 		{
 			return TRUE;
 		}
 	}

 } 
?>