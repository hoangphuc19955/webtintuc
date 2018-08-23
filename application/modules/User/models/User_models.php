<?php
/**
  * 
  */
 class User_models extends CI_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->database();
 	}

 	public function get_user()
 	{
 		return $this->db->get('user')->result_array();
 	}

 	public function get_user_with_username($user)
 	{
 		$user = $this->db->where('username',$user)
 							->get('user');
 		return $user->row_array();
 	}

 	public function get_user_by_id($id)
 	{	
 		$user = $this->db->where('id_user',$id)
 							->get('user');
 		return $user->row_array();
 	}

 	public function check_user_password($user,$pass)
 	{
 		
 		$user = $this->db->where('username',$user)
 							->where('password',$pass)
 							->get('user');
 		if($user->num_rows() > 0)
 		{
 			return TRUE;
 		}
 		else
 		{
 			return FALSE;
 		}
 	}

 	public function add_users($data)
 	{
 		$this->db->insert('user',$data);
 	}

 	public function delete_users($id)
 	{
 		$this->db->delete('user', array('id_user' => $id)); 
 	}

 	public function update_users($data,$id)
 	{
 		$this->db->where('id_user',$id)->update('user',$data);
 	}

 	public function checkComment_users($id)
 	{
 		$this->db->join('comment','comment.id_user = user.id_user');
        $this->db->where('user.id_user',$id);
        
    	return $this->db->get('user')->num_rows();
 	}

 	public function checkUser($user,$id)
 	{
 		if($id !='')
 		{
 			$this->db->where('id_user !=',$id);
 		}
 		$this->db->where('username',$user);
 		$query = $this->db->get('user');
 		if($query->num_rows() >0 )
 		{
 			return FALSE;
 		}
 		else
 		{
 			return TRUE;
 		}
 	}

 	public function checkEmail($email,$id)
 	{
 		if($id !='')
 		{
 			$this->db->where('id_user !=',$id);
 		}
 		$this->db->where('email',$email);
 		$query = $this->db->get('user');
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