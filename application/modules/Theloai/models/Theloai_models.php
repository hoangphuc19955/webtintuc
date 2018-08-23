<?php
/**
  * 
  */
 class Theloai_models extends CI_Model
 {
 	
 	function __construct()
    {
       	parent::__construct();
       	$this->load->database();
    }

    public function get_category()
    {
        return $this->db->get('theloai')->result_array();
    }

    public function get_category_by_id($id)
    {
        return $this->db->where('id',$id)->get('theloai')->row_array();
    }

    public function add_category($name,$slug)
    {
       	$data = array(
          'name' => $name,
          'slug_theloai' => $slug 
      	);

      	$this->db->insert('theloai', $data);
    }

    public function delete_category($id)
    {
        $this->db->delete('theloai', array('id' => $id)); 
    }

    public function update_category($name,$slug,$id)
    {
        $data = array(
          'name' => $name,
          'slug_theloai' => $slug 
      	);

        $this->db->where('id',$id)->update('theloai',$data);		
    }

    public function checkName_category($name,$id)
    {
        if($id !='')
       	{
       		$this->db->where('id !=',$id);
       	}
       	$this->db->where('name',$name);
       	$query = $this->db->get('theloai');
       	if($query->num_rows() >0 )
       	{
       		return FALSE;
       	}
       	else
       	{
       		return TRUE;
       	}
    }

    public function checkSlug_category($slugname,$id)
    {
        if($id !='')
        {
       		$this->db->where('id !=',$id);
       	}
       	$this->db->where('slug_theloai',$slugname);
       	$query = $this->db->get('theloai');
       	if($query->num_rows() >0 )
       	{
       		return FALSE;
       	}
       	else
       	{
       		return TRUE;
       	}
    }

    public function check_category($id)
    {
       	$this->db->join('tintuc','theloai.id = tintuc.idtheloai');
        $this->db->where('theloai.id',$id);
              
        return $this->db->get('theloai')->num_rows();
    }
 } 
?>