<?php
/**
  * 
  */
 class Admin extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function index()
 	{
 		if(isset($_SESSION['user']) && $_SESSION['user']['level'] != 2)
        {
	 		$data['titlePage'] = 'Freelancer Việt Nam';
	 		$data['subview']   = 'admin/index_view';
	 		$data['mess']      =  $this->session->flashdata('flash_mess');
	 		$this->load->view('admin/main',$data);
 		}
 		else
 		{
 			redirect(base_url('authentication/login'));
 		}
 	}	
 } 
?>