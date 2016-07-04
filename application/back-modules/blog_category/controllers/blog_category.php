<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Blog_category extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library('form_validation');
        $this->load->model('blogcategory_model');
        $this->load->library(array('ion_auth'));
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    function index(){
        $data['categories'] = $this->blogcategory_model->getCategories();
        $data['page_title'] = "Blog Categories";
        $this->template->build('index',$data);
    }
    
    function add(){
        // validation for creating category
        $this->form_validation->set_rules('category_name','Category Name','trim|required');
        $this->form_validation->set_rules('category_description','Category Description','trim');
        
        if($this->form_validation->run() == true){
            $dataCategory = array(
                'blog_category_name'        => $this->input->post('category_name'),
                'blog_category_description' => $this->input->post('category_description'),
                'creation_time'             => date('Y-m-d H:m:s'),
            );
            // echo '<pre>';
            // print_r($dataCategory);exit;
        }
        
        if(($this->form_validation->run() == true) && $this->blogcategory_model->addCategory($dataCategory)){
            $this->session->set_flashdata('success','Blog Category added successfully.');
            redirect('category','refresh');
        }else{
            $data['cat_name'] = array(
                'name'          => 'category_name',
                'id'            => 'category_name',
                'type'          => 'text',
                'placeholder'   => 'Category Name',
                'class'         => 'form-control',
                'value'         => $this->form_validation->set_value('category_name'),
            );
            $data['cat_description'] = array(
                'name'          => 'category_description',
                'id'            => 'category_description',
                'type'          => 'textarea',
                'class'         => 'form-control',
                'rows'          => '5',
                'cols'          => '50',
                'value'         => $this->form_validation->set_value('category_description'),
            );
            $data['page_title'] = "Create Blog Category";
            $this->template->build('add_category',$data);
        }
    }
    
    function edit($id = NULL){
        // validation for creating category
        $this->form_validation->set_rules('category_name','Category Name','trim|required');
        $this->form_validation->set_rules('category_description','Category Description','trim');
        
        if($this->form_validation->run() == true){
            $dataCategory = array(
                'blog_category_name'        => $this->input->post('category_name'),
                'blog_category_description' => $this->input->post('category_description'),
                'updation_time'             => date('Y-m-d H:m:s'),
            );
            // echo '<pre>';
            // print_r($dataCategory);exit;
        }
        
        if(($this->form_validation->run() == true) && $this->blogcategory_model->updateCategory($dataCategory,$id)){
            $this->session->set_flashdata('success','Blog Category updated successfully.');
            redirect('category','refresh');
        }else{
            $category = $this->blogcategory_model->getCategoryByID($id);
            // echo '<pre>';
            // print_r($category);exit;
            $data['cat_name'] = array(
                'name'          => 'category_name',
                'id'            => 'category_name',
                'type'          => 'text',
                'placeholder'   => 'Category Name',
                'class'         => 'form-control',
                'value'         => $this->form_validation->set_value('category_name',$category->blog_category_name),
            );
            $data['cat_description'] = array(
                'name'          => 'category_description',
                'id'            => 'category_description',
                'type'          => 'textarea',
                'class'         => 'form-control',
                'rows'          => '5',
                'cols'          => '50',
                'value'         => $this->form_validation->set_value('category_description',$category->blog_category_description),
            );
            
            $data['id'] = $id;
            $data['page_title'] = "Update Blog Category";
            $this->template->build('edit_category',$data);
        }
    }
}
?>