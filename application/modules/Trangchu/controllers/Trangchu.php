<?php

/**
  * 
  */
 class Trangchu extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
        $this->load->helper('date');
 		$this->load->library('pagination');
 		$this->load->model('Tintuc/Tintuc_models');
 	}


 	 public function index($trang='',$so=0)
 	{
 		$data['subview']     = 'trangchu/index_view';
 		$data['titlePage']   = "Freelancer Việt Nam - Blog Kỹ Năng";
 		$data['hotNews']     = $this->Tintuc_models->hot_news();
        $data['listTheloai'] = $this->Theloai_models->get_category();

 		//phân trang
 		$limit_per_page = 4;
 		$start_index    = $so;
 		$total_records  = $this->Tintuc_models->get_total() - 3; // trừ 3 tin hotNews
  
 		if($total_records >0)
 		{ 
                if($start_index  == 0)
                {
                    $data["pageNews"] = $this->Tintuc_models->get_news_by_page($limit_per_page, 3 );
                }
                else
                {
                    $start_index            = ($start_index * $limit_per_page) - 1 ;
                    $data["pageNews"] = $this->Tintuc_models->get_news_by_page($limit_per_page, $start_index );
                }

                $config['base_url']           = base_url() . 'blog-ky-nang';
                $config['total_rows']         = $total_records;
                $config['per_page']           = $limit_per_page;
                $config["uri_segment"]        = 2;

                $config['num_links']          = 1;
                $config['use_page_numbers']   = TRUE;
                $config['reuse_query_string'] = TRUE;
                $config['prefix']             = 'trang-';
                $config['suffix']             = '.html';
  
                $config['full_tag_open']      = '<ul class="pagination">';
                $config['full_tag_close']     = '</ul>';
                 
                $config['first_link']         = '<<';
                $config['first_tag_open']     = '<li class="page-item">';
                $config['first_tag_close']    = '</li>';
                 
                $config['last_link']          = '>>';
                $config['last_tag_open']      = '<li class="page-item">';
                $config['last_tag_close']     = '</li>';
                 
                $config['next_link']          = '>';
                $config['next_tag_open']      = '<li class="page-item">';
                $config['next_tag_close']     = '</li>';
     
                $config['prev_link']          = '<';
                $config['prev_tag_open']      = '<li class="page-item">';
                $config['prev_tag_close']     = '</li>';
     
                $config['cur_tag_open']       = '<li class="active page-item"><span class="page-link">';
                $config['cur_tag_close']      = '</span></li>';
     
                $config['num_tag_open']       = '<li class="page-item">';
                $config['num_tag_close']      = '</li>';
             
            $this->pagination->initialize($config);
             
            // build paging links
            $data["links"] = $this->pagination->create_links();
 		}
         $data['start_index'] = $start_index;

 		$this->load->view('trangchu/main',$data);

 	}
 } 
?>