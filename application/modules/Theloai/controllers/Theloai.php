<?php
/**
  * 
  */
 class Theloai extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 	}

 	public function manager_category()
 	{
        if(isset($_SESSION['user']) && $_SESSION['user']['level'] != 2)
        {
            //Phân quyền
            $userpermission = $this->Userrole_models->get_user_permission($_SESSION['user']['id_user']);
            $listpermission = array();
            foreach ($userpermission as $permission) 
            {          
                $listpermission[] = $permission['permission_url'];
            }
            if(in_array($this->uri->segment(1).$this->uri->segment(2), $listpermission) == FALSE)
            {
                $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền truy cập vào quản lý thể loại</div>");
                redirect(base_url('admin'));
            }
            
            //Load trang listCategory
            $data['titlePage']    = 'Quản lý thể loại';
            $data['subview']      = 'theloai/listCategory_view';
            $data['listCategory'] = $this->Theloai_models->get_category();
            $data['mess']         = $this->session->flashdata('flash_mess');

            $this->load->view('admin/main',$data);
        }
        else
        {
            redirect(base_url('authentication/login'));
        }
 		
 	}

 	public function manager_add_category()
 	{
        if(isset($_SESSION['user']) && $_SESSION['user']['level'] != 2)
        {
            //Phân quyền 
            $userpermission = $this->Userrole_models->get_user_permission($_SESSION['user']['id_user']);
            $listpermission = array();
            foreach ($userpermission as $permission) 
            {
                $listpermission[] = $permission['permission_url'];   
            }
            if(in_array($this->uri->segment(1).'/'.$this->uri->segment(2), $listpermission) == FALSE)
            {
                $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền truy cập vào quản lý thể loại</div>");
                redirect(base_url('admin'));
            }

            //Load trang addCategory
     		$data['subview']   = 'theloai/addCategory_view';
            $data['titlePage'] = 'Quản lý thể loại';

            $this->form_validation->set_rules('category-name','Category-Name','required|callback_check_name_category');
            $this->form_validation->set_rules('category-slug-name','Slug-Category-Name','required|callback_check_slug_category');

            if($this->form_validation->run() == TRUE)
            {
            	$name = $this->input->post('category-name');
            	$slug = url_title($this->input->post('category-slug-name'));

            	$this->Theloai_models->add_category($name,$slug);
                $this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Add Success</div>");
            	redirect(base_url('manager-category'));
            }

            $this->load->view('admin/main',$data);

        }
        else
        {
            redirect(base_url('authentication/login'));
        }
        
 	}

 	public function manager_delete_category($id)
 	{
        //Phân quyền
        $userpermission = $this->Userrole_models->get_user_permission($_SESSION['user']['id_user']);
        $listpermission = array();
        foreach ($userpermission as $permission) 
        {
            $listpermission[] = $permission['permission_url'];
        }
        if(in_array($this->uri->segment(1).'/'.$this->uri->segment(2), $listpermission) == FALSE)
        {
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền xóa thể loại</div>");
            redirect(base_url('manager-category'));
        }

        //Chức năng xóa category
        if($this->Theloai_models->check_category($id) > 0)
        {
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Category has news</div>");
        }
        else
        {
            $this->Theloai_models->delete_category($id);
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Delete Success</div>");
        }
 		
 		redirect(base_url('manager-category'));
 	}

    public function manager_update_category($id)
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['level'] != 2)
        {
            //Phân quyền
            $userpermission = $this->Userrole_models->get_user_permission($_SESSION['user']['id_user']);
            $listpermission = array();
            foreach ($userpermission as $permission) 
            {
                $listpermission[] = $permission['permission_url'];
            }
             if(in_array($this->uri->segment(1).'/'.$this->uri->segment(2), $listpermission) == FALSE)
            {
                $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền sửa thể loại</div>");
                redirect(base_url('manager-category'));
            }

            //Load trang updateCategory
            $data['subview']   = 'theloai/updateCategory_view';
            $data['titlePage'] = 'Quản lý thể loại';
            $data['category']  = $this->Theloai_models->get_category_by_id($id);

            $this->form_validation->set_rules('category-name','Category-Name','required|callback_check_name_category');
            $this->form_validation->set_rules('category-slug-name','Slug-Category-Name','required|callback_check_slug_category');

            if($this->form_validation->run() == TRUE)
            {
                $name = $this->input->post('category-name');
                $slug = url_title($this->input->post('category-slug-name'));

                $this->Theloai_models->update_category($name,$slug,$id);
                $this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Update Success</div>");
                redirect(base_url('manager-category'));
            }

            $this->load->view('admin/main',$data);
        }
        else
        {
            redirect(base_url('authentication/login'));
        }

        
    }

    public function check_name_category($name,$id)
    {
        $id = $this->uri->segment(3);

        if($this->Theloai_models->checkName_category($name,$id) ==FALSE)
        {
            $this->form_validation->set_message('check_name_category','Your name already exists, please try agian!');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function check_slug_category($slugname,$id)
    {
        $id = $this->uri->segment(3);
        
        if($this->Theloai_models->checkSlug_category($slugname,$id) ==FALSE)
        {
            $this->form_validation->set_message('check_slug_category','Your slug name already exists, please try agian!');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
 	
 }
?>