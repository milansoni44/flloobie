<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contactus extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
        $this->load->model('contactus_model');
        $this->load->library(array('ion_auth','form_validation','upload'));
        // if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		// {
			// // redirect them to the login page
			// redirect('auth/login', 'refresh');
		// }
    }
    
    function index(){
        // form validation
        $this->form_validation->set_rules('first_name','First Name','trim|required|xss_clean');
        $this->form_validation->set_rules('last_name','Last Name','trim|required|xss_clean');
        $this->form_validation->set_rules('email','Email','trim|required|xss_clean');
        $this->form_validation->set_rules('subject','Subject','trim|required|xss_clean');
        $this->form_validation->set_rules('message','Message','trim|required|xss_clean');
        
        if($this->form_validation->run() == true){
            $data = array(
                'first_name'    => $this->input->post('first_name'),
                'last_name'     => $this->input->post('last_name'),    
                'email'         => $this->input->post('email'),
                'subject'       => $this->input->post('subject'),
                'message'       => $this->input->post('message'),
            );
            // echo '<pre>';
            // print_r($data);exit;
        }
        
        if(($this->form_validation->run() == true) && $this->contactus_model->addContact($data)){
            $this->session->set_flashdata('success','Message send successfully.');
            redirect('contactus','refresh');
        }else{
            $data['errors'] = $this->form_validation->error_array();
            $data['first_name'] = array(
                'id'        => 'first_name',
                'name'      => 'first_name',
                'type'      => 'text',
                'class'     => 'form-control',
                'value'     => $this->form_validation->set_value('first_name'),
            );
            $data['last_name'] = array(
                'id'        => 'last_name',
                'name'      => 'last_name',
                'type'      => 'text',
                'class'     => 'form-control',
                'value'     => $this->form_validation->set_value('last_name'),
            );
            $data['email'] = array(
                'id'        => 'email',
                'name'      => 'email',
                'type'      => 'email',
                'class'     => 'form-control',
                'value'     => $this->form_validation->set_value('email'),
            );
            $data['subject'] = array(
                'id'        => 'subject',
                'name'      => 'subject',
                'type'      => 'text',
                'class'     => 'form-control',
                'value'     => $this->form_validation->set_value('subject'),
            );
            $data['message'] = array(
                'id'        => 'message',
                'name'      => 'message',
                'type'      => 'text',
                'class'     => 'form-control',
                'value'     => $this->form_validation->set_value('message'),
            );
            $data['blogs'] = $this->contactus_model->getBlog();
            $data['page_title'] = "Contact Us";
            $this->template->build('index',$data);
        }
    }
}
?>