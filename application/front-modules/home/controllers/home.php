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
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->library(array('ion_auth','upload','form_validation'));
        $this->load->model('home_model');
        
    }
	public function index()
	{
        $data['featured4'] = $this->home_model->getFeaturedLimit4();
        $data['featured8'] = $this->home_model->getFeaturedLimit8();
        $data['category_6'] = $this->home_model->getCategoryLimit6();
        $data['category_12'] = $this->home_model->getCategoryLimit12();
        // echo '<pre>';
        // print_r($data['category']);exit;
        $data['page_title'] = "Home";
        $this->template->build('index',$data);
	}
    
    function search(){
        if($search = $this->input->post('search')){
            $response = $this->home_model->getSearchResult($search);
            echo json_encode($response);
        }else{
            show_404();
        }
        
    }   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */