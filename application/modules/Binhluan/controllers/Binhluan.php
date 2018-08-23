<?php
/**
  * 
  */
 class Binhluan extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('Binhluan/Binhluan_models');
 	}

 	public function manager_comments()
 	{
        //Phân quyền
 		$userpermission = $this->Userrole_models->get_user_permission($_SESSION['user']['id_user']);
        $listpermission = array();
        foreach ($userpermission as $permission) 
        {
            $listpermission[] = $permission['permission_url'];     
        }
        if(in_array($this->uri->segment(1), $listpermission) == FALSE)
        {
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền truy cập vào quản lý comment</div>");
            redirect(base_url('admin'));
        }

        //Load trang listComments
 		$data['titlePage']    = 'Quản lý bình luận';
 		$data['subview']      = 'binhluan/listComments_view';
 		$data['listComments'] = $this->Binhluan_models->get_comment();
 		$data['mess']         = $this->session->flashdata('flash_mess');
 		$this->load->view('admin/main',$data);
 	}

 	public function manager_delete_comments($id)
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
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền xóa comment</div>");
            redirect(base_url('manager-comments'));
        }

        //Xóa comment
 		$this->Binhluan_models->delete_comments($id);
        $this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Delete Success</div>");

        redirect(base_url('manager-comments'));
 	}
 } 
?>