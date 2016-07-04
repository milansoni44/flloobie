<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Announcements extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library(array('ion_auth','upload','form_validation'));
        if (!$this->ion_auth->logged_in()){
            
            // redirect them to the login page
			redirect('auth/login', 'refresh');
		}
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->model('announcements_model');
    }
	public function index()
	{
        $data['announcement'] = $this->announcements_model->getAnnouncement();
        $data['read'] = $this->announcements_model->getAnnouncementStatus();
        $data['user'] = $this->announcements_model->get_admin();
        // echo '<pre>';
        // print_r($data['read']);exit;
        $data['page_title'] = "Announcements";
        $this->template->build('announcement',$data);
	}
    
    public function viewannouncement($id = NULL){
        $status = $this->announcements_model->changeStatus($id);
        $ann = $this->announcements_model->getAnnouncementByID($id);
        $data['announcement'] = $ann;
        $data['user'] = $this->announcements_model->get_admin();
        $data['page_title'] = "View Announcement";
        $this->template->build('viewannouncement',$data);
    }   
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>