<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aboutus extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model('aboutus_model');
        $this->load->library(array('ion_auth','form_validation','upload'));
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    function about($id = 1){
        // form validation
        $this->form_validation->set_rules('title','Title','trim|required|xss_clean');
        $this->form_validation->set_rules('content','Content','trim|required|xss_clean');
        
        if($this->form_validation->run() == true){
            if($_FILES['image']['size'] > 0)
            {
                $ext = end(explode(".", $_FILES['image']['name']));
                $file_name = $this->input->post('title').".".$ext;
                $image_path = realpath(APPPATH."../themes/admin/uploads/about/");
                $config = array(
                'upload_path' => $image_path,
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'file_name' => $file_name
                );
                // echo '<pre>';
                // print_r($config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('image'))
                {
                    $data = array('image' => $this->upload->data());
                }
                else
                {
                    // echo '<pre>';    
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);
                    $this->load->view('create_listing', $error);
                }
            }
            $data = array(
                'title'             => $this->input->post('title'), 
                'content'           => $this->input->post('content'),
                // 'image'             => $data['image']['file_name'],
                'updation_time'     => date('Y-m-d H:m:s'),
            );
            // echo '<pre>';
            // print_r($data);exit;
        }
        
        if(($this->form_validation->run() == true) && $this->aboutus_model->addAbout($data,$id)){
            $this->session->set_flashdata('success','About Us updated successfully.');
            redirect('aboutus/about','refresh');
        }else{
            $about = $this->aboutus_model->getAboutUs();
            $data['id'] = $id;
            $data['errors'] = $this->form_validation->error_array();
            $data['title'] = array(
                'id'        => 'title',
                'name'      => 'title',
                'type'      => 'text',
                'class'     => 'form-control',
                'value'     => $this->form_validation->set_value('title',$about->title)
            );
            $data['content'] = array(
                'id'        => 'content',
                'name'      => 'content',
                'type'      => 'text',
                'class'     => 'form-control ckeditor',
                'value'     => $this->form_validation->set_value('content',$about->content)
            );
            $data['image'] = array(
                'id'        => 'image',
                'name'      => 'image',
                'type'      => 'file',
                'class'     => 'form-control'
            );
            $data['page_title'] = "About Us";
            $this->template->build('index',$data);
        }
    }
}
?>