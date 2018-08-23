<?php
/**
  * 
  */
 class User extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('User/User_models');
 	}

 	public function manager_users()
 	{
 		if(isset($_SESSION['user']) && $_SESSION['user']['level'] != 2)
        {
            
            $userpermission = $this->Userrole_models->get_user_permission($_SESSION['user']['id_user']);
            $listpermission = array();
            foreach ($userpermission as $permission) 
            {
                $listpermission[] = $permission['permission_url'];
            }
            if(in_array($this->uri->segment(1), $listpermission) == FALSE)
            {
                $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền truy cập vào quản lý user</div>");
                redirect(base_url('admin'));
            }
	 		$data['titlePage']     = 'Quản lý user';
	 		$data['subview']       = 'user/listUsers_view';
	 		$data['listUsers']     = $this->User_models->get_user();
            $data['listUserroles'] = $this->Userrole_models->get_user_role();
	 		$data['mess']          = $this->session->flashdata('flash_mess');

	 		$this->load->view('admin/main',$data);
	 	}
        else
        {
            redirect(base_url('authentication/login'));
        }
 	}

 	public function manager_add_users()
 	{
 		if(isset($_SESSION['user']) && $_SESSION['user']['level'] != 2)
        {
            $userpermission = $this->Userrole_models->get_user_permission($_SESSION['user']['id_user']);
            $listpermission = array();
            foreach ($userpermission as $permission) 
            {
                $listpermission[] = $permission['permission_url'];
            }
            if(in_array($this->uri->segment(1).'/'.$this->uri->segment(2), $listpermission) == FALSE)
            {
                $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền thêm user</div>");
                redirect(base_url('manager-users'));
            }

	 		$data['subview']      = 'user/addUsers_view';
	        $data['titlePage']    = 'Quản lý User';
            $data['listUserrole'] = $this->Userrole_models->get_user_role();

	        $this->form_validation->set_rules('user-name','Username','required|min_length[4]|callback_check_user');
	        $this->form_validation->set_rules('user-password','Password','required|min_length[6]');
	        $this->form_validation->set_rules('user-repassword','RePassword','required|min_length[6]|matches[user-password]');
	        $this->form_validation->set_rules('user-email','Email','required|valid_email|callback_check_email');
	        $this->form_validation->set_rules('user-appellation','Appellation','required');

	        if($this->form_validation->run() == TRUE)
            {
            	$user = array(
                    'username' => $this->input->post('user-name'),
            	    'password' => $this->input->post('user-password'),
            	    'email'    => $this->input->post('user-email'),
            	    'name'     => $this->input->post('user-appellation'),
                    'level'    => $this->input->post('user-level')
                          );
            	$this->User_models->add_users($user);
            	$this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Add Success</div>");
            	redirect(base_url('manager-users'));
            }

	        $this->load->view('admin/main',$data);
	    }
        else
        {
            redirect(base_url('authentication/login'));
        }
 	}


 	public function manager_delete_users($id)
 	{
        $userpermission = $this->Userrole_models->get_user_permission($_SESSION['user']['id_user']);
        $listpermission = array();
        foreach ($userpermission as $permission) 
        {
            $listpermission[] = $permission['permission_url']; 
        }
        if(in_array($this->uri->segment(1).'/'.$this->uri->segment(2), $listpermission) == FALSE)
        {
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền xóa user</div>");
            redirect(base_url('manager-users'));
        }
        if($this->User_models->checkComment_users($id) > 0)
        {
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Users has comments</div>");
        }
        else
        {
            $this->User_models->delete_users($id);
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Delete Success</div>");
        }
 		
 		redirect(base_url('manager-users'));
 	}


 	public function manager_update_users($id)
 	{
 		if(isset($_SESSION['user']) && $_SESSION['user']['level'] != 2)
        {
            $userpermission = $this->Userrole_models->get_user_permission($_SESSION['user']['id_user']);
            $listpermission = array();
            foreach ($userpermission as $permission) 
            {
                $listpermission[] = $permission['permission_url'];
            }
            if(in_array($this->uri->segment(1).'/'.$this->uri->segment(2), $listpermission) == FALSE)
            {
                $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền sửa user</div>");
                redirect(base_url('manager-users'));
            }
	 		$data['subview']   = 'user/updateUsers_view';
	        $data['titlePage'] = 'Quản lý User';
	        $data['user']      = $this->User_models->get_user_by_id($id);
            $data['userrole']  = $this->Userrole_models->get_user_role();

	        $this->form_validation->set_rules('user-name','Username','required|trim|xss_clean|min_length[4]|callback_check_user');
	        $this->form_validation->set_rules('user-password','Password','min_length[6]|trim|xss_clean');
	        $this->form_validation->set_rules('user-repassword','RePassword','trim|xss_clean|min_length[6]|matches[user-password]');
	        $this->form_validation->set_rules('user-email','Email','required|trim|xss_clean|valid_email|callback_check_email');
	        $this->form_validation->set_rules('user-appellation','Appellation','required|trim|xss_clean');

            $username = $this->input->post('user-name');
            $password = $this->input->post('password');
            $email    = $this->input->post('user-email');
            $name     = $this->input->post('user-appellation');
            $level    = $this->input->post('user-level');

	        if($this->form_validation->run() == TRUE)
            {   
            	$user = array(
                    'username' => $username,
            	    'email'    => $email,
            	    'name'     => $name,
                    'level'    => $level
                          );

            	if($password)
            	{
            		$user['password'] = $password;
            	}
            	$this->User_models->update_users($user,$id);
            	$this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Update Success</div>");
            	redirect(base_url('manager-users'));
            }

	        $this->load->view('admin/main',$data);
	    }
        else
        {
            redirect(base_url('authentication/login'));
        }
 	}

 	public function check_user($user,$id)
 	{
        $id = $this->uri->segment(3);
        if ($this->User_models->checkUser($user,$id) == FALSE) {
            $this->form_validation->set_message("check_user", "Your username has been registed, please try again!");
            return FALSE;
        } else {
            return TRUE;
        }
 	}

 	public function check_email($email,$id)
 	{   
        $id = $this->uri->segment(3);
        if ($this->User_models->checkEmail($email,$id) == FALSE) {
            $this->form_validation->set_message("check_email", "Your email has been registed, please try again!");
            return FALSE;
        } else {
            return TRUE;
        }
 	}
 } 
?>