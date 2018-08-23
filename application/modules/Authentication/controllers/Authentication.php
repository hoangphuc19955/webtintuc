<?php
/**
  * 
  */
 class Authentication extends CI_Controller
 {
 	private $b_Check = false;
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('User/User_models');
 	}

 	public function login()
 	{
 		if(isset($_SESSION['user']))
 		{
 			redirect(base_url('blog-ky-nang'));
 		}
 		else
 		{
 			$data['titlePage']   = 'Đăng nhập - Freelancer Việt Nam';
	 		$data['subview']     =  'authentication/loginUser_view';
	 		$data['listTheloai'] = $this->Theloai_models->get_category();
	 		$data['mess']        = $this->session->flashdata('flash_mess');
	 		$this->load->view('trangchu/main',$data);
 		}
 	}

 	public function checklogin()
 	{
 		$this->form_validation->set_rules("login-name",'Username','required');
 		$this->form_validation->set_rules("login-password",'Password','required');


 		if($this->form_validation->run() ==TRUE)
 		{
 			$check_user = $this->User_models->check_user_password($this->input->post('login-name'),$this->input->post('login-password'));
 			if($check_user)
 			{

 				$this->session->set_userdata('user', $this->User_models->get_user_with_username($this->input->post('login-name')));
 				redirect(base_url('authentication/success'));
 			}
 			else
 			{
 				$this->b_Check = false;
 			}
 		}

 		$data['titlePage']   = 'Đăng nhập - Freelancer Việt Nam';
 		$data['subview']     =  'authentication/loginUser_view';
 		$data['listTheloai'] = $this->Theloai_models->get_category();
 		$data['b_Check']     = $this->b_Check;
 		$this->load->view('trangchu/main',$data); 
 	}

 	public function success()
 	{
 		if(isset($_SESSION['user']))
 		{
 			redirect(base_url('blog-ky-nang'));
 		}
 		else
 		{
 			redirect(base_url('login'));
 		}
 		
 	}

 	public function logout()
 	{
 		$this->session->unset_userdata('user');
 		redirect(base_url('blog-ky-nang.html'));
 	}

 	public function register()
 	{
 		$data['titlePage']   = 'Đăng ký - Freelancer Việt Nam';
 		$data['subview']     =  'authentication/registerUser_view';
 		$data['listTheloai'] = $this->Theloai_models->get_theloai();
 		$this->load->view('trangchu/main',$data);
 	}

 	public function checkregister()
 	{
 		$data['titlePage']   = 'Đăng ký - Freelancer Việt Nam';
 		$data['subview']     =  'authentication/registerUser_view';
 		$data['listTheloai'] = $this->Theloai_models->get_theloai();

 		$this->form_validation->set_rules("register-username",'Username','required|is_unique[user.username]|alpha_numeric|xss_clean|trim');
 		$this->form_validation->set_rules("register-password",'Password','required|min_length[6]|xss_clean|trim');
 		$this->form_validation->set_rules("register-repassword",'RePassword','required|min_length[6]|matches[register-password]|xss_clean|trim');
 		$this->form_validation->set_rules("register-email",'Email','required|valid_email|is_unique[user.email]|xss_clean|trim');
 		$this->form_validation->set_rules("register-name",'Name','required|xss_clean|trim');

 		$username = $this->input->post('register-username');
 		$password = $this->input->post('register-password');
 		$email    = $this->input->post('register-email');
 		$name     = $this->input->post('register-name');


 		if($this->form_validation->run() == FALSE)
 		{
 			$this->load->view('trangchu/main',$data);
 		}
 		else
 		{
 			$user = array(
 				'username' => $username,
 				'password' => $password,
 				'email'    => $email,
 				'name'     => $name,
 				'level'    => 2
 			);

 			$this->User_models->add_users($user);
 			$this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Đăng kí thành công</div>");
 			redirect(base_url('login'));
 		}
 	}
 } 
?>