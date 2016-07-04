<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
         * 
	 */
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(array('ion_auth'));
        $this->load->model('home_model');
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
	public function index()
	{
        $data['no_user'] = $this->home_model->getUsers();
        $data['no_listing'] = $this->home_model->getListings();
        $data['logged_in'] = $this->home_model->getLoggedInUsers();
        $data['today_listings'] = $this->home_model->getTodayListing();
        // echo '<pre>';
        // print_r($data['no_user']);exit;
        $data['page_title'] = "Home";
        $this->template->build('index',$data);
	}
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */