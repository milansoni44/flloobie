<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model('settings_model');
        $this->load->library(array('ion_auth','upload','form_validation'));
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    function index(){
        // validation settings
        $this->form_validation->set_rules('listing_price','Listing Price','trim|required|xss_clean');
        
        if($this->form_validation->run() == true){
            if($_FILES['logo']['size'] > 0)
            {
                $ext = end(explode(".", $_FILES['logo']['name']));
                $file_name = 'logo'.".".$ext;
                $image_path = realpath(APPPATH."../themes/admin/uploads/logo/");
                $config = array(
                'upload_path' => $image_path,
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'file_name' => $file_name
                );
                // echo '<pre>';
                // print_r($config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('logo'))
                {
                    $data = array('logo' => $this->upload->data());
                }
                else
                {
                    // echo '<pre>';    
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);
                    $this->load->view('create_listing', $error);
                }
            }else{
                $data['logo']['file_name'] = $this->input->post('edit_logo');
            }
            $settings = array(
                'logo'              => $data['logo']['file_name'],
                'listing_price'     => $this->input->post('listing_price'),
            );
            // echo '<pre>';
            // print_r($settings);exit;
        }
        
        if(($this->form_validation->run() == true) && $this->settings_model->updateSettings($settings)){
            $this->session->set_flashdata('success','Settings saved successfully.');
            redirect('settings','refresh');
        }else{
            $data['errors'] = $this->form_validation->error_array();
            $setting = $this->settings_model->getSettings();
            $data['logo'] = array(
                'id'            => 'logo',
                'name'          => 'logo',
                'type'          => 'file',
                'class'         => 'form-control',
            );
            $data['edit_logo'] = array(
                'name'      => 'edit_logo',
                'id'        => 'edit_logo',
                'type'      => 'hidden',
                'value'     => $setting->logo,
            );
            $data['listing_price'] = array(
                'name'          => 'listing_price',
                'id'            => 'listing_price',
                'type'          => 'text',
                'class'         => 'form-control',
                'placeholder'   => 'Listing Price',
                'value'         => $this->form_validation->set_value('listing_price',$setting->listing_price),
            );
            $data['page_title'] = "Settings";
            $this->template->build('add',$data);
        }
    }
} 
?>