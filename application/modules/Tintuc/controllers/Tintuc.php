<?php

/**
  * 
  */
 class Tintuc extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->helper('date');
 		$this->load->library('pagination');
        $this->load->library("upload");
 		$this->load->model('Tintuc_models');
        $this->load->model('Binhluan/Binhluan_models');
 	}

 	public function news_by_category($slug_theloai='',$trang='',$so=1)
 	{
 		$data['titlePage']   = "Freelancer Việt Nam - Blog Kỹ Năng";
 		$data['subview']     = 'tintuc/detailTheloai_view';
 		$data['listTheloai'] = $this->Theloai_models->get_category();
 		$data["pageNews"]    = $this->Tintuc_models->get_news_by_category($slug_theloai);

 		$limit_per_page = 3;
 		$start_index    = $so;
 		$total_records  = $this->Tintuc_models->get_total_news_in_category($slug_theloai);
		
 		if($total_records >0)
 		{
                $start_index                   = ($start_index-1) * $limit_per_page  ;
                $data["pageNews"]              = $this->Tintuc_models->get_news_by_page($limit_per_page, $start_index,$slug_theloai);

                $config['base_url']            = base_url() . 'blog-ky-nang/'.$slug_theloai;
                $config['total_rows']          = $total_records;
                $config['per_page']            = $limit_per_page;
                $config["uri_segment"]         = 3;

                $config['num_links']           = 1;
                $config['use_page_numbers']    = TRUE;
                $config['reuse_query_string']  = TRUE;
                $config['prefix']              = 'trang-';
                $config['suffix']              = '.html';
  
                $config['full_tag_open']       = '<ul class="pagination">';
                $config['full_tag_close']      = '</ul>';
                 
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
 		
 		$this->load->view('trangchu/main',$data);
 	}

 	public function news_by_id($slug_theloai='',$slug_title='')
 	{
 		$data['tintuc_theo_id']    = $this->Tintuc_models->get_news_by_slugtitle($slug_theloai,$slug_title);
 		$data['titlePage']         = $data['tintuc_theo_id']['title'];
 		$data['subview']           = 'tintuc/detailNews_view';
        $data['listTheloai']       = $this->Theloai_models->get_category();
 		$data['listTintuctuongtu'] = $this->Tintuc_models->get_news_similiar($data['tintuc_theo_id']['idtheloai'],$data['tintuc_theo_id']['datetime']);
        $data['commentTintuc']     = $this->Binhluan_models->get_comment_by_news($data['tintuc_theo_id']['id']);

 		$this->load->view('trangchu/main',$data);	
 	}

    public function search()
    {
        $this->form_validation->set_rules('noidung','Noidung','required',array('required' => '%s không có kết quả tìm kiếm'));


        if($this->form_validation->run() == TRUE)
        {
            $data['titlePage']   = "Freelancer Việt Nam - Blog Kỹ Năng";
            $data['subview']     = 'tintuc/searchNews_view';
            $data['listTheloai'] = $this->Theloai_models->get_category();
            $data['searchNews']  = $this->Tintuc_models->get_news_search($this->input->post('noidung'));

            $this->load->view('trangchu/main',$data);
        }
        else
        {
            redirect(base_url('blog-ky-nang.html'));
        }
    }

    public function comment()
    {
        $datestring = "%Y-%m-%d %h:%i:%s";
       
        $mess = array(
            'name_user'       => $this->input->post('user'),
            'content_comment' => $this->input->post('comment'),
            'id_tin'          => $this->input->post('idtin'),
            'time_comment'    => mdate($datestring,now()),
            'id_user'         => $_SESSION['user']['id_user']
        );

        $this->Binhluan_models->add_comment($mess);

        $comment = $this->Binhluan_models->get_comment_by_news($this->input->post('idtin'));

        echo json_encode($comment,JSON_UNESCAPED_UNICODE);
    }

    public function manager_news()
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
            if(in_array($this->uri->segment(1), $listpermission) == FALSE)
            {
                $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền truy cập vào quản lý tin tức</div>");
                redirect(base_url('admin'));
            }
            
            //hiển thị danh sách tin tức
            $data['subview']   = 'tintuc/listNews_view';
            $data['titlePage'] = 'Quản lý tin tức';
            $data['listNews']  = $this->Tintuc_models->list_news();
            $data['mess']      = $this->session->flashdata('flash_mess');

            $this->load->view('admin/main',$data);
        }
        else
        {
            redirect(base_url('authentication/login'));
        }
    }


    public function manager_add_news()
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
                $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền thêm tin tức</div>");
                redirect(base_url('manager-news'));
            }

            //Load trang addNews
            $data['errors']      = '';
            $data['subview']     = 'tintuc/addNews_view';
            $data['titlePage']   = 'Quản lý tin tức';
            $data['listTheloai'] = $this->Theloai_models->get_category();

            $this->form_validation->set_rules('news-title','News-title','required|trim|xss_clean|callback_check_title_news');
            $this->form_validation->set_rules('news-slug-title','News-slug-title','required|trim|xss_clean|callback_check_slug_news');
            $this->form_validation->set_rules('news-content','Content','required|trim|xss_clean');

            $title       = $this->input->post('news-title');
            $slugtitle   = url_title($this->input->post('news-slug-title'));
            $description = $this->input->post('news-description');
            $content     = $this->input->post('news-content');
            $id_theloai  = $this->input->post('news-category');
            $datestring  = "%Y-%m-%d %h:%i:%s";

             
             if ($this->form_validation->run() == FALSE)
             {
                 $this->load->view('admin/main',$data);
             }
             else
             {
                //Cấu hình điều kiện file hình được load lên trang          
                $config['upload_path']   = './asset/users/images/big/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '900';
                $config['max_width']     = '1024';
                $config['max_height']    = '768';
                $config['overwrite']      = TRUE;


                $this->upload->initialize($config);
                if($this->upload->do_upload('news-image'))
                {
                    $check = $this->upload->data(); 

                    $this->load->library("image_lib");

                    $config['image_library']  = 'gd2';
                    $config['source_image']   = './asset/users/images/big/'.$check['file_name'];
                    $config['create_thumb']   = FALSE;
                    $config['new_image']      = './asset/users/images/small/'.$check['file_name'];
                    $config['overwrite']      = TRUE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width']          = 370;
                    $config['height']         = 263;

                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    
                    $news = array(
                        'title'               => $title,
                        'slug_tintuc'         => $slugtitle,
                        'description'         => $description,
                        'content'             => $content,
                        'idtheloai'           => $id_theloai,
                        'urlimage'            => $check['file_name'],
                        'datetime'            => mdate($datestring,now()),
                        'datetime_last'       => mdate($datestring,now()),
                        'id_user'             => $_SESSION['user']['id_user'],
                        'id_user_update_last' => $_SESSION['user']['id_user']
                    );
                    
                    $this->Tintuc_models->add_news($news);
                    $this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Add Success</div>");
                    redirect(base_url('manager-news'));
                }
                else
                {
                    //Trả về lỗi nếu file hình không hợp lệ
                    $data['errors'] = $this->upload->display_errors();
                    $this->load->view('admin/main',$data);
                }
                
             }
         }
          else
        {
            redirect(base_url('authentication/login'));
        }  
    }


    public function manager_delete_news($id)
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
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền xóa tin tức</div>");
            redirect(base_url('manager-news'));
        }

        //Kiểm tra điều kiện xóa tin tức
        if($this->Tintuc_models->check_news($id) > 0)
        {
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>News has comments</div>");
        }
        else
        {
            $this->Tintuc_models->delete_news($id);
            $this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Delete Success</div>");
        }
        
        redirect(base_url('manager-news'));
    }

    public function manager_update_news($id)
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
                $this->session->set_flashdata("flash_mess", "<div class='alert alert-danger text-center'>Bạn không có quyền sửa tin tức</div>");
                redirect(base_url('manager-news'));
            }

            //Load trang updateNews
            $data['errors']      = '';
            $data['subview']     = 'tintuc/updateNews_view';
            $data['titlePage']   = 'Quản lý tin tức';
            $data['listTheloai'] = $this->Theloai_models->get_category();
            $data['news']        = $this->Tintuc_models->get_news_by_id($id);

            $this->form_validation->set_rules('news-title','News-title','required|trim|xss_clean|callback_check_title_news');
            $this->form_validation->set_rules('news-slug-title','News-slug-title','required|trim|xss_clean|callback_check_slug_news');
            $this->form_validation->set_rules('news-content','Content','required|trim|xss_clean');

            $title       = $this->input->post('news-title');
            $slugtitle   = url_title($this->input->post('news-slug-title'));
            $description = $this->input->post('news-description');
            $content     = $this->input->post('news-content');
            $id_theloai  = $this->input->post('news-category');
            $datestring  = "%Y-%m-%d %h:%i:%s";

            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('admin/main',$data);
            }
            else
            {   //Kiểm tra đã có file hình chưa 
                if(!empty($_FILES['news-image']['name']))
                {
                    // echo 'Trước lúc chạy do_upload';
                    // echo "<pre>"; 
                    // print_r($_FILES['news-image']);
                    // echo "<pre>";
                    $config['upload_path']   = './asset/users/images/big/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size']      = '900';
                    $config['max_width']     = '1024';
                    $config['max_height']    = '768';
                    $config['overwrite']      = TRUE;

                    $this->upload->initialize($config);
                   

                    if($this->upload->do_upload('news-image'))
                    { 
                        $check = $this->upload->data(); 
                        
                        $this->load->library("image_lib");

                        $config['image_library']  = 'gd2';
                        $config['source_image']   = './asset/users/images/big/'.$check['file_name'];
                        $config['create_thumb']   = FALSE;
                        $config['new_image']      = './asset/users/images/small/'.$check['file_name'];
                        $config['overwrite']      = TRUE;
                        $config['maintain_ratio'] = FALSE;
                        $config['width']          = 370;
                        $config['height']         = 263;

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        
                        $news = array(
                            'title'               => $title,
                            'slug_tintuc'         => $slugtitle,
                            'description'         => $description,
                            'content'             => $content,
                            'idtheloai'           => $id_theloai,
                            'urlimage'            => $check['file_name'],
                            'id_user_update_last' => $_SESSION['user']['id_user'],
                            'datetime_last'       => mdate($datestring,now())
                        );


                        $this->Tintuc_models->update_news($news,$id);
                        $this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Update Success</div>");
                        redirect(base_url('manager-news'));
                    }
                    else
                    {
                        // echo 'Đã chạy do_upload';
                        // echo "<pre>";
                        // print_r($this->upload->data());
                        //  echo "<pre>";
                        // die();
                        $data['errors'] = $this->upload->display_errors();
                        $this->load->view('admin/main',$data);
                    }
                }
                else
                {
                    $news = array(
                            'title'               => $title,
                            'slug_tintuc'         => $slugtitle,
                            'description'         => $description,
                            'content'             => $content,
                            'idtheloai'           => $id_theloai,
                            'id_user_update_last' => $_SESSION['user']['id_user'],
                            'datetime_last'       => mdate($datestring,now())
                        );
                        
                        $this->Tintuc_models->update_news($news,$id);
                        $this->session->set_flashdata("flash_mess", "<div class='alert alert-success text-center'>Update Success</div>");
                        redirect(base_url('manager-news'));
                }
                
            }
        }
          else
        {
            redirect(base_url('authentication/login'));
        }  
    }

    public function check_title_news($title,$id)
    {
        $id = $this->uri->segment(3);

        if($this->Tintuc_models->checkTitle_news($title,$id) ==FALSE)
        {
            $this->form_validation->set_message('check_title_news','Your title already exists, please try agian!');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function check_slug_news($slug,$id)
    {
        $id = $this->uri->segment(3);

        if($this->Tintuc_models->checkSlug_news($slug,$id) ==FALSE)
        {
            $this->form_validation->set_message('check_slug_news','Your slug already exists, please try agian!');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
 } 
?>