<?php
/**
  * 
  */
 class Userrole extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('User/User_models');
        $this->load->model('Detailpermission/Detailpermission_models');
        $this->load->model('Permission/Permission_models');
 	}

 	public function manager_userroles()
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
                $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền truy cập vào quản lý quyền user</div>");
                redirect(base_url('admin'));
            }
	 		$data['titlePage']     = 'Quản lý user';
	 		$data['subview']       = 'userrole/listUserrole_view';
	 		$data['listUserroles'] = $this->Userrole_models->get_user_role();
	 		 
	 		$data['mess']          = $this->session->flashdata('flash_mess');

	 		$this->load->view('admin/main',$data);
	 	}
        else
        {
            redirect(base_url('authentication/login'));
        }
 	}

 	public function manager_add_userroles()
 	{
 		$userpermission = $this->Userrole_models->get_user_permission($_SESSION['user']['id_user']);
        $listpermission = array();
        foreach ($userpermission as $permission) 
        {
            $listpermission[] = $permission['permission_url'];
        }
        if(in_array($this->uri->segment(1).'/'.$this->uri->segment(2), $listpermission) == FALSE)
        {
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền thêm quyền user</div>");
            redirect(base_url('manager-userroles'));
        }

 		$data['subview']   = 'userrole/addUserrole_view';
	    $data['titlePage'] = 'Quản lý Userrole';

	    $this->form_validation->set_rules('role-name','Role Name','required|callback_check_role_name');

	    if($this->form_validation->run() == TRUE)
	    {
	    	$role_name = $this->input->post('role-name');
	    	$slug_role = url_title($role_name);

	    	$userrole_info = array(
	    		'role_name' => $role_name,
	    		'slug_role' => $slug_role
	    	);

	    	$this->Userrole_models->add_userroles($userrole_info);
	    	$listPermission = $this->Permission_models->get_permission();
	    	foreach ($listPermission as $permission) {
	    		$this->Detailpermission_models->add_detail_permission($this->Userrole_models->get_user_role_by_slug($slug_role)['id_user_role'],$permission['id_user_permission']);
	    	}
	    	$this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Add Success</div>");
	    	redirect(base_url('manager-userroles'));
	    }

	    $this->load->view('admin/main',$data);
	    
 	}

 	public function manager_delete_userroles($id)
 	{
 		$userpermission = $this->Userrole_models->get_user_permission($_SESSION['user']['id_user']);
        $listpermission = array();
        foreach ($userpermission as $permission) 
        {
            $listpermission[] = $permission['permission_url'];
        }
        if(in_array($this->uri->segment(1).'/'.$this->uri->segment(2), $listpermission) == FALSE)
        {
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền xóa quyền user</div>");
            redirect(base_url('manager-userroles'));
        }

        if($this->Userrole_models->checkRole($id) > 0)
        {
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Role has users</div>");
        }
        else
        {
            $this->Userrole_models->delete_userroles($id);
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Delete Success</div>");
        }
 		
 		redirect(base_url('manager-userroles'));
 	}


    public function manager_update_userroles($id)
    {
        $userpermission = $this->Userrole_models->get_user_permission($_SESSION['user']['id_user']);
        $listpermission = array();
        foreach ($userpermission as $permission) 
        {
            $listpermission[] = $permission['permission_url'];
        }
        if(in_array($this->uri->segment(1).'/'.$this->uri->segment(2), $listpermission) == FALSE)
        {
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền sửa quyền user</div>");
            redirect(base_url('manager-userroles'));
        }

        $data['subview']        = 'userrole/updateUserrole_view';
        $data['titlePage']      = 'Quản lý Userrole';
        $data['userrole']       = $this->Userrole_models->get_user_role_by_id($id);
        $data['listPermission'] = $this->Detailpermission_models->get_detail_permission_by_id($id);

        $this->form_validation->set_rules('role-name','Role Name','required|callback_check_role_name');

        if($this->form_validation->run() == TRUE)
        {
            $role_name  = $this->input->post('role_name');
            $slug_role  = url_title($role_name);
            $permission = $this->input->post('permissions');

            if($permission != NULL)
            {
                foreach ($data['listPermission'] as  $detailpermission) 
                {

                    if(in_array($detailpermission['id_user_permission'],$permission))
                    {
                        $detailpermission_info = array(
                            'checked'   => 'checked'
                        );

                        $this->Detailpermission_models->update_detail_permission($detailpermission_info,$id,$detailpermission['id_user_permission']);      
                    }
                    else
                    {
                        $detailpermission_info = array(
                            'checked'   => ' '
                        );

                        $this->Detailpermission_models->update_detail_permission($detailpermission_info,$id,$detailpermission['id_user_permission']);
                    }
                }
            }
            
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Grant Right Success</div>");
            redirect(base_url('manager-userroles'));
            
        }

        $this->load->view('admin/main',$data);
    }

 	public function check_role_name($role_name,$id)
 	{
 		$id = $this->uri->segment(3);
        if ($this->Userrole_models->checkRole_name($role_name,$id) == FALSE) {
            $this->form_validation->set_message("check_role_name", "Your rolename already exist, please try again!");
            return FALSE;
        } else {
            return TRUE;
        }
 	}
 } 
?>