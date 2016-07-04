<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model('blog_model');
        $this->load->library(array('ion_auth','upload','form_validation'));
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    function index(){
        $data['blog'] = $this->blog_model->getBlogs();
        // echo '<pre>';
        // print_r($data['blog']);exit;
        $data['page_title'] = "Blog";
        $this->template->build('index',$data);
    }
    
    function add(){
        //validation for blog
        $this->form_validation->set_rules('blog_category','blog_category','trim|required|callback_category_check');
        $this->form_validation->set_rules('blog_name','Blog Name','trim|required|xss_clean');
        $this->form_validation->set_rules('blog_content','Blog Content','trim|required|xss_clean');
        $this->form_validation->set_rules('blog_keywords','Blog Keywords','trim|required');
        
        if($this->form_validation->run() == true){
            if($_FILES['blog_featured_image']['size'] > 0)
            {
                $ext = end(explode(".", $_FILES['blog_featured_image']['name']));
                $file_name = $this->input->post('blog_name').".".$ext;
                $image_path = realpath(APPPATH."../themes/admin/uploads/blog/");
                $config = array(
                'upload_path' => $image_path,
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'file_name' => $file_name
                );
                // echo '<pre>';
                // print_r($config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('blog_featured_image'))
                {
                    $data = array('blog_featured_image' => $this->upload->data());
                }
                else
                {
                    // echo '<pre>';    
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);
                    $this->load->view('add', $error);
                }
            }
            
            $dataBlog = array(
                'user_id'               => USER_ID,
                'blog_category_id'      => $this->input->post('blog_category'),
                'blog_name'             => $this->input->post('blog_name'),
                'blog_featured_image'   => $data['blog_featured_image']['file_name'],  
                'blog_content'          => $this->input->post('blog_content'),
                'blog_keywords'         => $this->input->post('blog_keywords'),
                'creation_time'         => date('Y-m-d H:m:s'),
            );
            // echo '<pre>';
            // print_r($dataBlog);exit;
        }
        
        if(($this->form_validation->run() == true) && $this->blog_model->addBlog($dataBlog)){
            $this->session->set_flashdata('success','Blog inserted successfully.');
            redirect('blog','refresh');
        }else{
            $data['errors'] = $this->form_validation->error_array();
            $data['blog_category'] = $this->blog_model->getBlogCategories();
            $data['blog_name'] = array(
                'name'          => 'blog_name',
                'id'            => 'blog_name',
                'type'          => 'text',
                'placeholder'   => 'Blog Name',
                'class'         => 'form-control',
                'value'         => $this->form_validation->set_value('blog_name'),
            );
            $data['blog_featured_image'] = array(
                'name'      => 'blog_featured_image',
                'id'        => 'feature_image',
                'class'     => 'form-control',
                'type'      => 'file',
            );
            $data['blog_content'] = array(
                'name'      => 'blog_content',
                'id'        => 'blog_content',
                'type'      => 'text',
                'rows'      => 5,
                'cols'      => 50,
                'class'     => 'form-control ckeditor',
                'value'     => $this->form_validation->set_value('blog_content'),
            );
            $data['blog_keywords'] = array(
                'name'          => 'blog_keywords',
                'id'            => 'blog_keywords',
                'type'          => 'text',
                'class'         => 'form-control',
                'placeholder'   => 'Blog Keywords',
                'value'         => $this->form_validation->set_value('blog_keywords'),
            );
            $data['page_title'] = "Create Blog";
            $this->template->build('add',$data);
        }
    }
    
    function edit($id = NULL){
        //validation for blog
        $this->form_validation->set_rules('blog_category','blog_category','trim|required|callback_category_check');
        $this->form_validation->set_rules('blog_name','Blog Name','trim|required|xss_clean');
        $this->form_validation->set_rules('blog_content','Blog Content','trim|required|xss_clean');
        $this->form_validation->set_rules('blog_keywords','Blog Keywords','trim|required');
        
        if($this->form_validation->run() == true){
            if($_FILES['blog_featured_image']['size'] > 0)
            {
                $ext = end(explode(".", $_FILES['blog_featured_image']['name']));
                $file_name = $this->input->post('blog_name').".".$ext;
                $image_path = realpath(APPPATH."../themes/admin/uploads/blog/");
                $config = array(
                'upload_path' => $image_path,
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'file_name' => $file_name
                );
                // echo '<pre>';
                // print_r($config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('blog_featured_image'))
                {
                    $data = array('blog_featured_image' => $this->upload->data());
                }
                else
                {
                    // echo '<pre>';    
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);
                    $this->load->view('add', $error);
                }
            }else{
                $data['blog_featured_image']['file_name'] = $this->input->post('blog_featured_img');
            }
            
            $dataBlog = array(
                'user_id'               => USER_ID,
                'blog_category_id'      => $this->input->post('blog_category'),
                'blog_name'             => $this->input->post('blog_name'),
                'blog_featured_image'   => $data['blog_featured_image']['file_name'],
                'blog_content'          => $this->input->post('blog_content'),
                'blog_keywords'         => $this->input->post('blog_keywords'),
                'updation_time'         => date('Y-m-d H:m:s'),
            );
            // echo '<pre>';
            // print_r($dataBlog);exit;
        }
        
        if(($this->form_validation->run() == true) && $this->blog_model->updateBlog($dataBlog,$id)){
            $this->session->set_flashdata('success','Blog updated successfully.');
            redirect('blog','refresh');
        }else{
            $data['errors'] = $this->form_validation->error_array();
            $data['blog_category'] = $this->blog_model->getBlogCategories();
            $data['blog'] = $this->blog_model->getBlogByID($id);
            $data['id'] = $id;
            $data['page_title'] = "Update Blog";
            $this->template->build('edit',$data);
        }
    }
    
    public function category_check(){
        if($this->input->post('blog_category') == '0'){
            $this->form_validation->set_message('category_check','Please select category.');
            return false;
        }
        return true;
    }
}
?>