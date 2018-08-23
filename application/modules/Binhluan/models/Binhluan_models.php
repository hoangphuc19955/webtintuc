<?php
/**
  * 
  */
 class Binhluan_models extends CI_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->database();
 	}

 	public function get_comment()
 	{
 		return $this->db->get('comment')->result_array();
 	}

 	public function get_comment_by_news($id)
 	{
 		$this->db->where('id_tin',$id);
 		$this->db->order_by('id_comment','desc');
 		return $this->db->get('comment')->result_array();
 	}

 	public function add_comment($comment)
 	{
 		$this->db->insert('comment',$comment);
 	}

 	public function delete_comments($id)
 	{
 		$this->db->where('id_comment',$id)->delete('comment');
 	}
 }
?>