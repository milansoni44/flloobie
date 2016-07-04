<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inquiry extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
        $this->load->model('inquiry_model');
        $this->load->library(array('ion_auth','form_validation','upload'));
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    function index(){
        $data['inq'] = $this->inquiry_model->getInquiry();
        // echo '<pre>';
        // print_r($data['inq']);exit;
        $data['page_title'] = "Inquiries";
        $this->template->build('index',$data);
    }
    
    function view($id = NULL){
        $inquiry = $this->inquiry_model->getInquiryByID($id);
        $data['inq'] = $inquiry;
        $data['page_title'] = "View Inquiry";
        $this->template->build('view',$data);
    }
}
?>