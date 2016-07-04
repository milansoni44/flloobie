<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Subcategory extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        // $this->load->library('form_validation');
        $this->load->model('subcategory_model');
        $this->load->library(array('ion_auth','upload','form_validation'));
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    function index(){
        $data['sub_category'] = $this->subcategory_model->getSubCategories();
        $data['page_title'] = "Sub Categories";
        $this->template->build('index',$data);
    }
    
    function add(){
        // validation for category
        $this->form_validation->set_rules('category','Category','trim|required|callback_category_check');
        $this->form_validation->set_rules('sub_category_code','Sub Category Code','trim|required|xss_clean');
        $this->form_validation->set_rules('sub_category_name','Sub Category Name','trim|required|xss_clean');
        $this->form_validation->set_rules('sub_category_description','Sub Category Description','trim');
        
        if($this->form_validation->run() == true){
            if($_FILES['sub_category_image']['size'] > 0)
            {
                $ext = end(explode(".", $_FILES['sub_category_image']['name']));
                $file_name = $this->input->post('sub_category_code').".".$ext;
                $image_path = realpath(APPPATH."../themes/admin/uploads/subcategory/");
                $config = array(
                'upload_path' => $image_path,
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'file_name' => $file_name
                );
                // echo '<pre>';
                // print_r($config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('sub_category_image'))
                {
                    $data = array('sub_category_image' => $this->upload->data());
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
                'category_id'               => $this->input->post('category'),
                'sub_category_code'         => $this->input->post('sub_category_code'),
                'sub_category_name'         => $this->input->post('sub_category_name'),
                'sub_category_description'  => $this->input->post('sub_category_description'),
                'sub_category_image'        => $data['sub_category_image']['file_name'],  
                'creation_time'             => date('Y-m-d H:m:s')
            );
            // echo '<pre>';
            // print_r($dataCategory);exit;
        }
        if(($this->form_validation->run() == true) && $this->subcategory_model->addSubCategory($dataCategory)){
            $this->session->set_flashdata('success','Sub Category inserted successfully.');
            redirect('subcategory','refresh');
            
        }else{
            $data['sub_category_code'] = array(
                'name'          => 'sub_category_code',
                'id'            => 'sub_category_code',
                'type'          => 'text',
                'placeholder'   => 'Sub Category Code',
                'class'         => 'form-control',
                'value'         => $this->form_validation->set_value('sub_category_code'),
            );
            $data['sub_category_name'] = array(
                'name'          => 'sub_category_name',
                'id'            => 'sub_category_name',
                'type'          => 'text',
                'placeholder'   => 'Sub Category Name',
                'class'         => 'form-control',
                'value'         => $this->form_validation->set_value('sub_category_name'),
            );
            $data['sub_category_description'] = array(
                'name'          => 'sub_category_description',
                'id'            => 'sub_category_description',
                'type'          => 'text',
                'placeholder'   => 'Sub Category Description',
                'class'         => 'form-control',
                'cols'          => 50,
                'rows'          => 5,
                'value'         => $this->form_validation->set_value('sub_category_description'),
            );
            $data['sub_category_image'] = array(
                'name'          => 'sub_category_image',
                'id'            => 'sub_category_image',
                'type'          => 'file',
                'class'         => 'form-control',
                // 'value'         => $this->form_validation->set_value('sub_category_image'),
            );
            $data['errors'] = $this->form_validation->error_array();
            $data['category'] = $this->subcategory_model->getCategories();
            $data['page_title'] = "Create Sub Category";
            $this->template->build('add',$data);
        }
    }
    
    function edit($id = NULL){
        // validation for category
        $this->form_validation->set_rules('category','Category','trim|required|callback_category_check');
        $this->form_validation->set_rules('sub_category_code','Sub Category Code','trim|required|xss_clean');
        $this->form_validation->set_rules('sub_category_name','Sub Category Name','trim|required|xss_clean');
        $this->form_validation->set_rules('sub_category_description','Sub Category Description','trim');
        
        if($this->form_validation->run() == true){
            if($_FILES['sub_category_image']['size'] > 0)
            {
                $ext = end(explode(".", $_FILES['sub_category_image']['name']));
                $file_name = $this->input->post('sub_category_code').".".$ext;
                $image_path = realpath(APPPATH."../themes/admin/uploads/subcategory");
                $config = array(
                'upload_path' => $image_path,
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'file_name' => $file_name
                );
                // echo '<pre>';
                // print_r($config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('sub_category_image'))
                {
                    $data = array('sub_category_image' => $this->upload->data());
                }
                else
                {
                    // echo '<pre>';    
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);
                    $this->load->view('add', $error);
                }
            }else{
                $data['sub_category_image']['file_name'] = $this->input->post('subcategory_img');
            }
            
            $dataCategory = array(
                'category_id'               => $this->input->post('category'),
                'sub_category_code'         => $this->input->post('sub_category_code'),
                'sub_category_name'         => $this->input->post('sub_category_name'),
                'sub_category_description'  => $this->input->post('sub_category_description'),
                'sub_category_image'        => $data['sub_category_image']['file_name'],  
                'updation_time'             => date('Y-m-d H:m:s')
            );
            // echo '<pre>';
            // print_r($dataCategory);exit;
        }
        if(($this->form_validation->run() == true) && $this->subcategory_model->updateSubCategory($dataCategory,$id)){
            $this->session->set_flashdata('success','Sub Category updated successfully.');
            redirect('subcategory','refresh');
            
        }else{
            $data['errors'] = $this->form_validation->error_array();
            $data['sub_category'] = $this->subcategory_model->getSubCategoryByID($id);
            $data['category'] = $this->subcategory_model->getCategories();
            $data['id'] = $id;
            $data['page_title'] = "Update Sub Category";
            $this->template->build('edit',$data);
        }
    }
    
    public function category_check(){
        if($this->input->post('category') == '0'){
            $this->form_validation->set_message('category_check','Please select category.');
            return false;
        }
        return true;
    }
}
?>