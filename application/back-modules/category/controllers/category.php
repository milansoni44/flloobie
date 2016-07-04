<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library('form_validation');
        $this->load->model('category_model');
        $this->load->library(array('ion_auth','upload'));
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    function index(){
        $data['category'] = $this->category_model->getCategories();
        $data['page_title'] = "Categories";
        $this->template->build('index',$data);
    }
    
    function add(){
        // validation for category
        $this->form_validation->set_rules('category_code','Category Code','trim|required|xss_clean|callback_username_check');
        $this->form_validation->set_rules('category_name','Category Name','trim|required|xss_clean');
        $this->form_validation->set_rules('category_description','Category Description','trim');
        
        if($this->form_validation->run() == true){
            if($_FILES['category_icon']['size'] > 0)
            {
                $ext = end(explode(".", $_FILES['category_icon']['name']));
                $file_name = $this->input->post('category_code').".".$ext;
                $image_path = realpath(APPPATH."../themes/admin/uploads/category/icons");
                $config = array(
                'upload_path' => $image_path,
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'file_name' => $file_name
                );
                // echo '<pre>';
                // print_r($config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('category_icon'))
                {
                    $data = array('category_icon' => $this->upload->data());
                }
                else
                {
                    // echo '<pre>';    
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);
                    $this->load->view('add', $error);
                }
            }
            
            if($_FILES['category_image']['size'] > 0)
            {
                $ext1 = end(explode(".", $_FILES['category_image']['name']));
                $file_name = $this->input->post('category_code').".".$ext1;
                $image_path = realpath(APPPATH."../themes/admin/uploads/category/images");
                $config1 = array(
                'upload_path' => $image_path,
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'file_name' => $file_name
                );
                // echo '<pre>';
                // print_r($config1);
                $this->upload->initialize($config1);
                if($this->upload->do_upload('category_image'))
                {
                    $data1 = array('category_image' => $this->upload->data());
                }
                else
                {
                    // echo '<pre>';    
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);
                    $this->load->view('add', $error);
                }
            }
            
            $dataCategory = array(
                'category_code'         => $this->input->post('category_code'),
                'category_name'         => $this->input->post('category_name'),
                'category_description'  => $this->input->post('category_description'),
                'category_icon'         => $data['category_icon']['file_name'],  
                'category_image'        => $data1['category_image']['file_name'],
                'creation_time'         => date('Y-m-d H:m:s')
            );
            // echo '<pre>';
            // print_r($dataCategory);exit;
        }
        if(($this->form_validation->run() == true) && $this->category_model->addCategory($dataCategory)){
            $this->session->set_flashdata('success','Category inserted successfully.');
            redirect('category','refresh');
            
        }else{
            $data['category_code'] = array(
                'name'          => 'category_code',
                'id'            => 'category_code',
                'type'          => 'text',
                'placeholder'   => 'Category Code',
                'class'         => 'form-control',
                'value'         => $this->form_validation->set_value('category_code'),
            );
            $data['category_name'] = array(
                'name'          => 'category_name',
                'id'            => 'category_name',
                'type'          => 'text',
                'placeholder'   => 'Category Name',
                'class'         => 'form-control',
                'value'         => $this->form_validation->set_value('category_name'),
            );
            $data['category_description'] = array(
                'name'          => 'category_description',
                'id'            => 'category_description',
                'type'          => 'text',
                'placeholder'   => 'Category Description',
                'class'         => 'form-control',
                'cols'          => 50,
                'rows'          => 5,
                'value'         => $this->form_validation->set_value('category_description'),
            );
            $data['category_icon'] = array(
                'name'          => 'category_icon',
                'id'            => 'category_icon',
                'type'          => 'file',
                'class'         => 'form-control',
                // 'value'         => $this->form_validation->set_value('category_name'),
            );
            $data['category_image'] = array(
                'name'          => 'category_image',
                'id'            => 'category_image',
                'type'          => 'file',
                'class'         => 'form-control',
                // 'value'         => $this->form_validation->set_value('category_image'),
            );
            $data['errors'] = $this->form_validation->error_array();
            $data['page_title'] = "Create Category";
            $this->template->build('add',$data);
        }
    }
    
    function edit($id = NULL){
        // validation for category
        $this->form_validation->set_rules('category_code','Category Code','trim|required|xss_clean|callback_username_check');
        $this->form_validation->set_rules('category_name','Category Name','trim|required|xss_clean');
        $this->form_validation->set_rules('category_description','Category Description','trim');
        
        if($this->form_validation->run() == true){
            if($_FILES['category_icon']['size'] > 0)
            {
                $ext = end(explode(".", $_FILES['category_icon']['name']));
                $file_name = $this->input->post('category_code').".".$ext;
                $image_path = realpath(APPPATH."../themes/admin/uploads/category/icons");
                $config = array(
                'upload_path' => $image_path,
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'file_name' => $file_name
                );
                // echo '<pre>';
                // print_r($config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('category_icon'))
                {
                    $data = array('category_icon' => $this->upload->data());
                }
                else
                {
                    // echo '<pre>';    
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);
                    $this->load->view('add', $error);
                }
            }else{
                $data['category_icon']['file_name'] = $this->input->post('category_ico');
            }
            
            if($_FILES['category_image']['size'] > 0)
            {
                $ext1 = end(explode(".", $_FILES['category_image']['name']));
                $file_name = $this->input->post('category_code').".".$ext1;
                $image_path = realpath(APPPATH."../themes/admin/uploads/category/images");
                $config1 = array(
                'upload_path' => $image_path,
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'file_name' => $file_name
                );
                // echo '<pre>';
                // print_r($config1);
                $this->upload->initialize($config1);
                if($this->upload->do_upload('category_image'))
                {
                    $data1 = array('category_image' => $this->upload->data());
                }
                else
                {
                    // echo '<pre>';    
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);
                    $this->load->view('add', $error);
                }
            }else{
                $data1['category_image']['file_name'] = $this->input->post('category_img');
            }
            
            $dataCategory = array(
                'category_code'         => $this->input->post('category_code'),
                'category_name'         => $this->input->post('category_name'),
                'category_description'  => $this->input->post('category_description'),
                'category_icon'         => $data['category_icon']['file_name'],  
                'creation_time'         => date('Y-m-d H:m:s'),
                'category_image'        => $data1['category_image']['file_name'],
            );
            // echo '<pre>';
            // print_r($dataCategory);exit;
        }
        if(($this->form_validation->run() == true) && $this->category_model->updateCategory($dataCategory,$id)){
            $this->session->set_flashdata('success','Category inserted successfully.');
            redirect('category','refresh');
            
        }else{
            $data['errors'] = $this->form_validation->error_array();
            $category = $this->category_model->getCategoryByID($id);
            $data['id'] = $id;
            // echo '<pre>';
            // print_r($category);exit;
            $data['category_code'] = array(
                'name'          => 'category_code',
                'id'            => 'category_code',
                'type'          => 'text',
                'placeholder'   => 'Category Code',
                'class'         => 'form-control',
                'value'         => $this->form_validation->set_value('category_code',$category->category_code),
            );
            $data['category_name'] = array(
                'name'          => 'category_name',
                'id'            => 'category_name',
                'type'          => 'text',
                'placeholder'   => 'Category Name',
                'class'         => 'form-control',
                'value'         => $this->form_validation->set_value('category_name',$category->category_name),
            );
            $data['category_description'] = array(
                'name'          => 'category_description',
                'id'            => 'category_description',
                'type'          => 'text',
                'placeholder'   => 'Category Description',
                'class'         => 'form-control',
                'cols'          => 50,
                'rows'          => 5,
                'value'         => $this->form_validation->set_value('category_description',$category->category_description),
            );
            $data['category_icon'] = array(
                'name'          => 'category_icon',
                'id'            => 'category_icon',
                'type'          => 'file',
                'class'         => 'form-control',
                // 'value'         => $this->form_validation->set_value('category_name'),
            );
            $data['category_image'] = array(
                'name'          => 'category_image',
                'id'            => 'category_image',
                'type'          => 'file',
                'class'         => 'form-control',
                // 'value'         => $this->form_validation->set_value('category_image'),
            );
            $data['category_ico'] = array(
                'name'  => 'category_ico',
                'type'  => 'hidden',
                'value' => $category->category_icon,
            );
            $data['category_img'] = array(
                'name'  => 'category_img',
                'type'  => 'hidden',
                'value' => $category->category_image,
            );
            $data['page_title'] = "Update Category";
            $this->template->build('edit',$data);
        }
    }
}
?>