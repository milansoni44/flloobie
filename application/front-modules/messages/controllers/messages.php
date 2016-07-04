<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library(array('ion_auth','upload','form_validation'));
        if (!$this->ion_auth->logged_in()){
            // redirect them to the login page
			redirect('auth/login', 'refresh');
		}
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->helper('text');
        $this->load->model('messages_model');
    }
	public function index()
	{
        $data['messages'] = $this->messages_model->getMessages();
        $data['user'] = $this->messages_model->getUserDetail();
        // echo '<pre>';
        // print_r($data['messages']);exit;
        $data['page_title'] = "Messages";
        $this->template->build('inbox',$data);
	}
    
    public function new_message(){
        $data['page_title'] = "New Message";
        $this->template->build('new_message',$data);
    }
    public function view_message($id = NULL){
        if($id){
            $data['message'] = $this->messages_model->getMessageByID($id);
            $data['user'] = $this->messages_model->getUserDetail();
            $data['page_title'] = "View Message";
            $this->template->build('view_message',$data);
        }else{
            show_404();
        }
    }

    function delete($id = NULL){
        if($id){
            if($this->messages_model->delete($id)){
                $this->session->set_flashdata('success','Message deleted successfully');
                redirect('messages','refresh');
            }
        }else{
            show_404();
        }
    }
}
?>