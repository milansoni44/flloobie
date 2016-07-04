<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cities extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->model('city_model');
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    function city_setting(){
        // validation
        $this->form_validation->set_rules('states[]','state','trim');
        $this->form_validation->set_rules('cities[]','City','trim');
        
        if($this->form_validation->run() == true){
            $states = implode(',',$this->input->post('states'));
            $cities = implode(',',$this->input->post('cities'));
            $data = array(
                'states'    => $states,
                'cities'    => $cities
            );
            // echo '<pre>';
            // print_r($data);exit;
        }
        
        if(($this->form_validation->run() == true) && $this->city_model->AllowStatesCities($data)){ 
            $this->session->set_flashdata('success','States and cities updated.');
            redirect('home','refresh');
        }else{
            $data['errors'] = $this->form_validation->error_array();
            $data['states'] = $this->city_model->getStates();
            $data['cities'] = $this->city_model->getCitiesAll();
            $data['page_title'] = "City";
            $this->template->build('city',$data);
        }
    }
    
    function city_list(){
        $data['city'] = $this->city_model->getAllowedCities();
        // echo '<pre>';
        // print_r($data['city']);exit;
        $data['page_title'] = "City List";
        $this->template->build('city_list',$data);
    }
    
    function getCities(){
        if($this->input->post('state')){
            $state = $this->input->post('state');
            $cities = $this->city_model->getCities($state);
            echo json_encode($cities);
        }
    }
    
    function check_state(){
        if($this->input->post('state') == ''){
            $this->form_validation->set_message('check_state','Please Select State.');
            return false;
        }
        return true;
    }
    
    function check_city(){
        if($this->input->post('cities') == ''){
            $this->form_validation->set_message('check_city','Please Select City.');
            return false;
        }
        return true;
    }
    
    function disable($id = NULL){
        if($id){
            if($this->city_model->disable($id)){
                $this->session->set_flashdata('success','City disabled successfully.');
                redirect('cities/city_list','refresh');
            }
        }else{
            show_404();
        }
    }
}
?>