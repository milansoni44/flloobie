<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logins extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model('logins_model');
        $this->load->library(array('ion_auth'));
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    function index(){
        $data['result'] = $this->logins_model->get_data();
        // echo '<pre>';
        // print_r($data['result']);exit;
        $data['page_title'] = "Login Activity";
        $this->template->build('index',$data);
    }
}
?>