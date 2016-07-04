<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends MX_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->library(array('ion_auth','upload','form_validation','pagination'));
        $this->load->model('category_model');
    }
    
    function cat($code = NULL){
        if(!$code){
            show_404();
        }else{
            $config['base_url'] = base_url()."index.php/category/cat/$code";
            $config['per_page'] = 2;
            $config['uri_segment'] = 4;
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
            $cat = $this->category_model->getCategory($code);
            $total_rows = $this->category_model->count_records($cat->id);
            $config['total_rows'] = $total_rows;
            $this->pagination->initialize($config);
            $blog = $this->category_model->getBlog();
            $post = $this->category_model->getPost();
            $data['post'] = $post;
            $data['blog'] = $blog;
            $data['adv'] = $this->category_model->getAdvByCategory($config['per_page'],$this->uri->segment(4),$cat->id);
            // echo '<pre>';
            // print_r($data['adv']);exit;
            $data['cat'] = $cat;
            $data['page_title'] = "Category";
            $this->template->build('category',$data);
        }
    }
}    
?>