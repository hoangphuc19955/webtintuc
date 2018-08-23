<?php

/**
  * 
  */
 class Tintuc_models extends CI_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->database();
 	}

 	public function list_news()
 	{
 		$news = $this->db->order_by('datetime','desc')->get('tintuc')->result_array();

 		return $news;
 	}

 	public function hot_news()
 	{
 		$news = $this->db->select('tintuc.id,tintuc.title,tintuc.slug_tintuc,tintuc.content,tintuc.description,tintuc.datetime,tintuc.urlimage,tintuc.idtheloai,theloai.slug_theloai,theloai.name')->join('theloai','theloai.id = tintuc.idtheloai')->order_by('datetime','desc')->limit(3,0)->get('tintuc')->result_array();

 		return $news;
 	}

 	public function get_news_by_page($limit,$start,$slug_theloai='')
 	{
 		$this->db->join('theloai','theloai.id = tintuc.idtheloai');  
 		$news = $this->db->limit($limit,$start)->get('tintuc');
 		if($news->num_rows()>0)
 		{
 			$this->db->select('tintuc.id,tintuc.title,tintuc.slug_tintuc,tintuc.content,tintuc.description,tintuc.datetime,tintuc.urlimage,tintuc.idtheloai,theloai.slug_theloai,theloai.name');
 			$this->db->join('theloai','theloai.id = tintuc.idtheloai');
            if($slug_theloai != '')
            {
                $this->db->where('theloai.slug_theloai',$slug_theloai);
                  
            }
            $this->db->order_by('datetime','desc');
            $this->db->limit($limit,$start);
 			$data = $this->db->get('tintuc')->result_array();
            
 			return $data;
 		}

 		return false;
 	}

 	public function get_total() 
    {
        return $this->db->count_all("tintuc");
    }

    public function get_total_news_in_category($slug_theloai)
    {
        $this->db->join('theloai','theloai.id = tintuc.idtheloai');
        $this->db->where('theloai.slug_theloai',$slug_theloai);
        
        return $this->db->get('tintuc')->num_rows();
    }

    public function get_news_by_category($slug_theloai)
    {
        $this->db->select('tintuc.id,tintuc.title,tintuc.slug_tintuc,tintuc.content,tintuc.description,tintuc.datetime,tintuc.urlimage,tintuc.idtheloai,theloai.slug_theloai,theloai.name');
        $this->db->join('theloai','theloai.id = tintuc.idtheloai');
        $this->db->where('theloai.slug_theloai',$slug_theloai);
        $this->db->order_by('datetime','desc');

        return $this->db->get('tintuc')->result_array();
    }

    public function get_news_by_slugtitle($slug_theloai,$slug_title)
    {
    	$this->db->select('tintuc.id,tintuc.title,tintuc.slug_tintuc,tintuc.content,tintuc.description,tintuc.datetime,tintuc.urlimage,tintuc.idtheloai,theloai.slug_theloai,theloai.name');
    	$this->db->join('theloai','theloai.id = tintuc.idtheloai');
    	$this->db->where('theloai.slug_theloai',$slug_theloai);
    	$this->db->where('tintuc.slug_tintuc',$slug_title);

    	return $this->db->get('tintuc')->row_array();
    }

    public function get_news_similiar($theloai,$ngay)
    {
    	$this->db->select('tintuc.id,tintuc.title,tintuc.slug_tintuc,tintuc.content,tintuc.description,tintuc.datetime,tintuc.urlimage,tintuc.idtheloai,theloai.slug_theloai,theloai.name');
    	$this->db->join('theloai','theloai.id = tintuc.idtheloai');
    	$this->db->where('tintuc.idtheloai',$theloai);
    	$this->db->where('tintuc.datetime <',$ngay);
    	$this->db->order_by('datetime','desc');
    	$this->db->limit(2,0);

    	return $this->db->get('tintuc')->result_array();
    }

    public function get_news_search($noidung)
    {
        $this->db->select('tintuc.id,tintuc.title,tintuc.slug_tintuc,tintuc.content,tintuc.description,tintuc.datetime,tintuc.urlimage,tintuc.idtheloai,theloai.slug_theloai,theloai.name');
        $this->db->join('theloai','theloai.id = tintuc.idtheloai');
        $this->db->like('title',$noidung);
        $this->db->or_like('content',$noidung);
        $this->db->order_by('datetime','desc');
        
        return $this->db->get('tintuc')->result_array();
        // return $this->db->query("SELECT * 
        //                                 FROM `tintuc` join theloai on theloai.id=tintuc.idtheloai
        //                                 WHERE title LIKE Concat('%',CONVERT('$noidung',BINARY),'%') or  content like Concat('%',CONVERT('$noidung',BINARY),'%')                        
        //                                 ORDER BY datetime DESC")->result_array();
    }


    public function get_news_by_id($id)
    {
        $this->db->select('tintuc.id,tintuc.title,tintuc.slug_tintuc,tintuc.content,tintuc.description,tintuc.datetime,tintuc.urlimage,tintuc.idtheloai,theloai.slug_theloai,theloai.name');
        $this->db->join('theloai','theloai.id = tintuc.idtheloai');
        $this->db->where('tintuc.id',$id);
    
        return $this->db->get('tintuc')->row_array();
    }

    public function add_news($data)
    {
        $this->db->insert('tintuc',$data);
    }

    public function delete_news($id)
    {
        $this->db->where('id',$id)->delete('tintuc');
    }

    public function update_news($data,$id)
    {
        $this->db->where('id',$id)->update('tintuc',$data);
    }

    public function check_news($id)
    {
        $this->db->join('comment','comment.id_tin = tintuc.id');
        $this->db->where('tintuc.id',$id);
        
        return $this->db->get('tintuc')->num_rows();
    }


    public function checkTitle_news($title,$id)
    {
        if($id !='')
        {
            $this->db->where('id !=',$id);
        }
        $this->db->where('title',$title);
        $query = $this->db->get('tintuc');
        if($query->num_rows() >0 )
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function checkSlug_news($slug,$id)
    {
        if($id !='')
        {
            $this->db->where('id !=',$id);
        }
        $this->db->where('slug_tintuc',$slug);
        $query = $this->db->get('tintuc');
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