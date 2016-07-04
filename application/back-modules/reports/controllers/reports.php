<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model('reports_model');
        $this->load->library(array('ion_auth','upload','form_validation'));
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    function active_listing(){
        // validation
        $this->form_validation->set_rules('from_date','From Date','trim');
        $this->form_validation->set_rules('to_date','To Date','trim');
        
        if($this->form_validation->run() == true){
            $f_date = explode('/',$this->input->post('from_date'));
            $f_date_f = $f_date[2].'-'.$f_date[1].'-'.$f_date[0];
            
            $t_date = explode('/',$this->input->post('to_date'));
            $t_date_f = $t_date[2].'-'.$t_date[1].'-'.$t_date[0];
            $data = array(
                'from'      => $f_date_f,
                'to'        => $t_date_f,
            );
            
            // echo '<pre>';
            // print_r($data);exit;
        }
        
        if(($this->form_validation->run() == true) && $data['active_listing'] = $this->reports_model->getActiveListingByDate($data)){
            $data['from_date'] = array(
                'id'            => 'from_date',
                'name'          => 'from_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('from_date',date('d/m/Y'))
            );
            $data['to_date'] = array(
                'id'            => 'to_date',
                'name'          => 'to_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('to_date',date('d/m/Y'))
            );
            $data['page_title'] = "Active Listings Reports";
            $this->template->build('active_listing',$data);
        }else{
            $data['active_listing'] = $this->reports_model->getActiveListings();
            $data['from_date'] = array(
                'id'            => 'from_date',
                'name'          => 'from_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('from_date',date('d/m/Y'))
            );
            $data['to_date'] = array(
                'id'            => 'to_date',
                'name'          => 'to_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('to_date',date('d/m/Y'))
            );
            $data['page_title'] = "Active Listings Reports";
            $this->template->build('active_listing',$data);
        }
    }
    
    function paused_listing(){
        $data['paused_listing'] = $this->reports_model->getPausedListing();
        $data['page_title'] = "Pause Listing Reports";
        $this->template->build('paused_listing',$data);
    }
    
    function paid_listing(){
        // validation
        $this->form_validation->set_rules('from_date','From Date','trim');
        $this->form_validation->set_rules('to_date','To Date','trim');
        
        if($this->form_validation->run() == true){
            $f_date = explode('/',$this->input->post('from_date'));
            $f_date_f = $f_date[2].'-'.$f_date[1].'-'.$f_date[0];
            
            $t_date = explode('/',$this->input->post('to_date'));
            $t_date_f = $t_date[2].'-'.$t_date[1].'-'.$t_date[0];
            $data = array(
                'from'      => $f_date_f,
                'to'        => $t_date_f,
            );
            
            // echo '<pre>';
            // print_r($data);exit;
        }
        
        if(($this->form_validation->run() == true) && $data['paid_listing'] = $this->reports_model->getPaidListingByDate($data)){
            $data['from_date'] = array(
                'id'            => 'from_date',
                'name'          => 'from_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('from_date',date('d/m/Y'))
            );
            $data['to_date'] = array(
                'id'            => 'to_date',
                'name'          => 'to_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('to_date',date('d/m/Y'))
            );
            $data['page_title'] = "Paid Listings Reports";
            $this->template->build('paid_listing',$data);
        }else{
            $data['from_date'] = array(
                'id'            => 'from_date',
                'name'          => 'from_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('from_date',date('d/m/Y'))
            );
            $data['to_date'] = array(
                'id'            => 'to_date',
                'name'          => 'to_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('to_date',date('d/m/Y'))
            );
            $data['paid_listing'] = $this->reports_model->getPaidListing();
            $data['page_title'] = "Paid Listing Reports";
            $this->template->build('paid_listing',$data);
        }
    }
    
    function free_listing(){
        // validation
        $this->form_validation->set_rules('from_date','From Date','trim');
        $this->form_validation->set_rules('to_date','To Date','trim');
        
        if($this->form_validation->run() == true){
            $f_date = explode('/',$this->input->post('from_date'));
            $f_date_f = $f_date[2].'-'.$f_date[1].'-'.$f_date[0];
            
            $t_date = explode('/',$this->input->post('to_date'));
            $t_date_f = $t_date[2].'-'.$t_date[1].'-'.$t_date[0];
            $data = array(
                'from'      => $f_date_f,
                'to'        => $t_date_f,
            );
            
            // echo '<pre>';
            // print_r($data);exit;
        }
        
        if(($this->form_validation->run() == true) && $data['free_listing'] = $this->reports_model->getFreeListingByDate($data)){
            $data['from_date'] = array(
                'id'            => 'from_date',
                'name'          => 'from_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('from_date',date('d/m/Y'))
            );
            $data['to_date'] = array(
                'id'            => 'to_date',
                'name'          => 'to_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('to_date',date('d/m/Y'))
            );
            $data['page_title'] = "Free Listings Reports";
            $this->template->build('free_listing',$data);
        }else{
            $data['from_date'] = array(
                'id'            => 'from_date',
                'name'          => 'from_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('from_date',date('d/m/Y'))
            );
            $data['to_date'] = array(
                'id'            => 'to_date',
                'name'          => 'to_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('to_date',date('d/m/Y'))
            );
            $data['free_listing'] = $this->reports_model->getFreeListing();
            $data['page_title'] = "Free Listing Reports";
            $this->template->build('free_listing',$data);
        }
    }
    
    function active_user(){
        // validation
        $this->form_validation->set_rules('from_date','From Date','trim');
        $this->form_validation->set_rules('to_date','To Date','trim');
        
        if($this->form_validation->run() == true){
            $f_date = explode('/',$this->input->post('from_date'));
            $f_date_f = $f_date[2].'-'.$f_date[1].'-'.$f_date[0];
            
            $t_date = explode('/',$this->input->post('to_date'));
            $t_date_f = $t_date[2].'-'.$t_date[1].'-'.$t_date[0];
            $data = array(
                'from'      => $f_date_f,
                'to'        => $t_date_f,
            );
            
            // echo '<pre>';
            // print_r($data);exit;
        }
        
        if(($this->form_validation->run() == true) && $data['active_user'] = $this->reports_model->getActiveUserByDate($data)){
            $data['from_date'] = array(
                'id'            => 'from_date',
                'name'          => 'from_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('from_date',date('d/m/Y'))
            );
            $data['to_date'] = array(
                'id'            => 'to_date',
                'name'          => 'to_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('to_date',date('d/m/Y'))
            );
            $data['page_title'] = "Active User Reports";
            $this->template->build('active_user',$data);
        }else{
            $data['from_date'] = array(
                'id'            => 'from_date',
                'name'          => 'from_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('from_date',date('d/m/Y'))
            );
            $data['to_date'] = array(
                'id'            => 'to_date',
                'name'          => 'to_date',
                'class'         => 'form-control',
                'autocomplete'  => 'off',
                'value'         => $this->form_validation->set_value('to_date',date('d/m/Y'))
            );
            $data['active_user'] = $this->reports_model->getActiveUsers();
            $data['page_title'] = "Active User Reports";
            $this->template->build('active_user',$data);
        }
    }
}
?>