<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog extends MX_Controller {

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
        $this->load->helper('text');
        $this->load->library(array('ion_auth','upload','form_validation','pagination'));
        $this->load->model('blog_model');
    }
    
    function index(){
        $config['base_url'] = base_url()."index.php/blog/index";
        $config['per_page'] = 1;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '« First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last »';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next →';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '← Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $total_rows = $this->blog_model->count_records();
        $config['total_rows'] = $total_rows;
        $this->pagination->initialize($config);
        $data['listing'] = $this->blog_model->getListings();
        $data['blog'] = $this->blog_model->get_blog($config['per_page'],$this->uri->segment(3));
        $data['page_title'] = "Blog";
        $this->template->build('blog',$data);
    }
    
    function view_blog($slug = NULL){
        if(!$slug){
            show_404();
        }else{
            $data['blogs'] = $this->blog_model->getBlogs();
            $sl = $this->blog_model->getBlogBySlug($slug);
            $data['blog'] = $sl;
            $data['page_title'] = "View Blog";
            $this->template->build('singleblog',$data);
        }
    }
}
?>