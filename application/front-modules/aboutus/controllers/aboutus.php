<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aboutus extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
        $this->load->model('aboutus_model');
        $this->load->library(array('ion_auth','form_validation','upload'));
        // if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		// {
			// // redirect them to the login page
			// redirect('auth/login', 'refresh');
		// }
    }
    
    function index(){
        $about = $this->aboutus_model->getAboutUs();
        $data['blogs'] = $this->aboutus_model->getBlog();
        // echo '<pre>';
        // print_r($data['blogs']);exit;
        $data['about'] = $about;
        $data['page_title'] = "About Us";
        $this->template->build('index',$data);
    }
}
?>