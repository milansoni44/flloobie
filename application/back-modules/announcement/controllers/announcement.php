<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Announcement extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model('announcement_model');
        $this->load->library(array('ion_auth','form_validation'));
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    function index(){
        $data['ann'] = $this->announcement_model->getAnnouncement();
        $data['page_title'] = "Announcements";
        $this->template->build('index',$data);
    }
    
    function add(){
        // validation
        $this->form_validation->set_rules('title','Title','trim|required|xss_clean');
        $this->form_validation->set_rules('message','Message','trim|required|xss_clean');
        
        if($this->form_validation->run() == true){
            $data = array(
                'announcement_title'    => $this->input->post('title'),
                'announcement_message'  => $this->input->post('message'),
                'creation_time'         => date('Y-m-d H:m:s'), 
            );
            // echo '<pre>';
            // print_r($data);exit;
        }
        
        if(($this->form_validation->run() == true) && $this->announcement_model->addAnnouncement($data)){
            $this->session->set_flashdata('success','Announcement inserted successfully.');
            redirect('announcement','refresh');
        }else{
            $data['errors'] = $this->form_validation->error_array();
            $data['title'] = array(
                'id'        => 'title',
                'name'      => 'title',
                'type'      => 'text',
                'class'     => 'form-control',
                'value'     => $this->form_validation->set_value('title'),
            );
            $data['message'] = array(
                'id'        => 'message',
                'name'      => 'message',
                'type'      => 'text',
                'class'     => 'form-control ckeditor',
                'value'     => $this->form_validation->set_value('message'),
            );
            $data['page_title'] = "Create Announcement";
            $this->template->build('add',$data);
        }
    }
    
    function edit($id = NULL){
        // validation
        $this->form_validation->set_rules('title','Title','trim|required|xss_clean');
        $this->form_validation->set_rules('message','Message','trim|required|xss_clean');
        
        if($this->form_validation->run() == true){
            $data = array(
                'announcement_title'    => $this->input->post('title'),
                'announcement_message'  => $this->input->post('message'),
                'updation_time'         => date('Y-m-d H:m:s'), 
            );
            // echo '<pre>';
            // print_r($data);exit;
        }
        
        if(($this->form_validation->run() == true) && $this->announcement_model->editAnnouncement($data,$id)){
            $this->session->set_flashdata('success','Announcement updated successfully.');
            redirect('announcement','refresh');
        }else{
            $data['errors'] = $this->form_validation->error_array();
            $announcement = $this->announcement_model->getAnnouncementByID($id);
            $data['title'] = array(
                'id'        => 'title',
                'name'      => 'title',
                'type'      => 'text',
                'class'     => 'form-control',
                'value'     => $this->form_validation->set_value('title',$announcement->announcement_title),
            );
            $data['message'] = array(
                'id'        => 'message',
                'name'      => 'message',
                'type'      => 'text',
                'class'     => 'form-control ckeditor',
                'value'     => $this->form_validation->set_value('message',$announcement->announcement_message),
            );
            $data['id'] = $id;
            $data['page_title'] = "Update Announcement";
            $this->template->build('edit',$data);
        }
    }
}
?>