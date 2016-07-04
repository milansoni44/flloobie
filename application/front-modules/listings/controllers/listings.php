<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Listings extends MX_Controller {
    public function __construct() {
        
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('cookie');
        $this->load->helper('text');
        $this->load->library(array('ion_auth','upload','form_validation','pagination'));
        $this->load->model('listings_model');
    }
	public function createadv(){
        if (!$this->ion_auth->logged_in()){
            
            // redirect them to the login page
			redirect('auth/login', 'refresh');
		}
        $data['category'] = $this->listings_model->getCategories();
        // $data['sub_category'] = $this->listings_model->getSubCategories();
        $data['page_title'] = "Create Adv";
        $this->template->build('createadv',$data);
	}
    public function myad_listing(){
        if (!$this->ion_auth->logged_in()){
            
            // redirect them to the login page
			redirect('auth/login', 'refresh');
		}
        $data['id'] = USER_ID;
        $data['listings'] = $this->listings_model->getListingsByUser(USER_ID);
        $data['transactions'] = $this->listings_model->getTransactions();
        $data['live_listings'] = $this->listings_model->getLiveListings(USER_ID);
        $data['pending_listings'] = $this->listings_model->getPendingListings(USER_ID);
        // echo '<pre>';
        // print_r($data['transactions']);exit;
        $data['user'] = $this->listings_model->getUserByID(USER_ID);
        $data['state'] = $this->listings_model->getStates();
        $data['city'] = $this->listings_model->getCitiesAllowed();
        $data['page_title'] = "My Listings";
        $this->template->build('myad_listing',$data);
	}
    public function create_listing(){
        if (!$this->ion_auth->logged_in()){
            
            // redirect them to the login page
			redirect('auth/login', 'refresh');
		}
        $cat_id = $this->input->post('category');
        $sub_cat_id = $this->input->post('sub_category');
        
        $category = $this->listings_model->getCategoryName($cat_id);
        $sub_category = $this->listings_model->getSubCategoryName($sub_cat_id);
        $this->session->set_userdata('category',$category);
        $this->session->set_userdata('cat_id',$cat_id);
        $this->session->set_userdata('sub_cat_id',$sub_cat_id);
        $this->session->set_userdata('sub_category',$sub_category);
        // echo '<pre>';
        // print_r($this->session->all_userdata());
        // echo '</pre>';exit;
        // if(!$this->session->userdata('cat_id')){
            // redirect('listings/createadv','refresh');
        // }
        //validation for create listings
        $this->form_validation->set_rules('title','Title','trim|required|xss_clean');
        $this->form_validation->set_rules('price','Price','trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('description','Description','trim|required|xss_clean');
        $this->form_validation->set_rules('phone','Phone','trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('street','Street','trim|required|alpha_numeric|xss_clean');
        $this->form_validation->set_rules('country','Country','trim|required|xss_clean');
        $this->form_validation->set_rules('zip','Zip','trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('tag','Tag','trim|required|xss_clean');
        
        if($this->form_validation->run() == true){
            if($_FILES['image']['size'] > 0)
            {
                $ext = end(explode(".", $_FILES['image']['name']));
                $file_name = $this->input->post('title').".".$ext;
                $image_path = realpath(APPPATH."../themes/front/uploads/listing/");
                $config = array(
                'upload_path' => $image_path,
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'file_name' => $file_name
                );
                // echo '<pre>';
                // print_r($config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('image'))
                {
                    $data = array('image' => $this->upload->data());
                }
                else
                {
                    // echo '<pre>';    
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);
                    $this->load->view('create_listing', $error);
                }
            }
            $contact_method = implode(',',$this->input->post('contact_method'));
            $dataAdvertise = array(
                'user_id'                   => USER_ID,
                'category_id'               => $this->input->post('cat_id'),
                'sub_category_id'           => $this->input->post('sub_cat_id'),
                'listing_name'              => ucfirst($this->input->post('title')),
                'slug'                      => preg_replace("![^a-z0-9]+!i", "-", strtolower($this->input->post('tag'))),
                'listing_image'             => $data['image']['file_name'],
                'listing_description'       => $this->input->post('description'),
                'google_map'                => $this->input->post('google_map'),
                'preferred_contact_method'  => $contact_method,
                'negotiable'                => $this->input->post('negotiable'),
                'price'                     => $this->input->post('price'),
                'listing_type'              => $this->input->post('listing_type'),
                'creation_time'             => date('Y-m-d H:m:s'),
            );
            // echo '<pre>';
            // print_r($dataAdvertise);exit; 
        }
        
        if(($this->form_validation->run() == true)){
            $slug = $this->listings_model->createListings($dataAdvertise);
            // $this->session->set_flashdata('success','Listing is created successfully.');
            redirect('listings/review_listing/'.$slug,'refresh');
        }else{
            // $data['errors'] = $this->form_validation->error_array();
            $user = $this->listings_model->getUser();
            $city = $this->listings_model->getCity($user->city);
            $country = $this->listings_model->getCountry($user->country);
            $data['title'] = array(
                'name'          => 'title',
                'id'            => 'title',
                'type'          => 'text',
                'class'         => 'form-control',
                'placeholder'   => 'Title',
                'value'         => $this->form_validation->set_value('title'),
            );
            $data['price'] = array(
                'name'          => 'price',
                'id'            => 'price',
                'type'          => 'text',
                'class'         => 'form-control',
                'placeholder'   => 'Price',
                'value'         => $this->form_validation->set_value('price'),
            );
            $data['description'] = array(
                'name'      => 'description',
                'id'        => 'description',
                'type'      => 'text',
                'class'     => 'form-control',
                'rows'      => 3,
                'cols'      => 50,
                'value'     => $this->form_validation->set_value('description'),
            );
            $data['phone'] = array(
                'name'          => 'phone',
                'id'            => 'phone',
                'type'          => 'text',
                'placeholder'   => 'Phone',
                'class'         => 'form-control',
                'value'         => $user->phone,
            );
            $data['street'] = array(
                'name'          => 'street',
                'id'            => 'street',
                'type'          => 'text',
                'class'         => 'form-control',
                'placeholder'   => 'Street',
                'value'         => $city->name,
            );
            $data['country'] = array(
                'name'          => 'country',
                'id'            => 'country',
                'type'          => 'text',
                'class'         => 'form-control',
                'placeholder'   => 'Country',
                'value'         => $country->name,
            );
            $data['zip'] = array(
                'name'          => 'zip',
                'id'            => 'zip',
                'type'          => 'text',
                'class'         => 'form-control',
                'placeholder'   => 'Zip/Postal Code',
                'value'         => $user->pincode,
            );
            $data['google_map'] = array(
                'name'          => 'google_map',
                'id'            => 'google_map',
                'type'          => 'text',
                'class'         => 'form-control',
                'placeholder'   => 'https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d2965.0824050173574!2d-93.63905729999999!3d41.998507000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sWebFilings%2C+University+Boulevard%2C+Ames%2C+IA!5e0!3m2!1sen!2sus!4v1390839289319',
                'value'         => $this->form_validation->set_value('google_map'),
            );
            $data['tags'] = array(
                'name'          => 'tag',
                'id'            => 'tag',
                'type'          => 'text',
                'class'         => 'form-control',
                'placeholder'   => 'Tag',
                'value'         => $this->form_validation->set_value('tag'),
            );
            $data['negotiable'] = array(
                'name'      => 'negotiable',
                'id'        => 'negotiable',
                'type'      => 'checkbox',
                'value'     => 'negotiable',
            );
            $data['image'] = array(
                'name'          => 'image',
                'id'            => 'image',
                'type'          => 'file',
                // 'accept'        => 'image/*',
                'class'         => 'form-control demoInputBox',
            );
            $data['cat_id'] = array(
                'name'      => 'cat_id',
                'id'        => 'cat_id',
                'type'      => 'hidden',
                'value'     => $cat_id,
            );
            $data['sub_cat_id'] = array(
                'name'      => 'sub_cat_id',
                'id'        => 'sub_cat_id',
                'type'      => 'hidden',
                'value'     => $sub_cat_id,
            );
            $data['page_title'] = "Create Listing";
            $this->template->build('create_listing',$data);
        }
	}
    
    public function edit_listing($slug = NULL){
        if (!$this->ion_auth->logged_in()){
            
            // redirect them to the login page
			redirect('auth/login', 'refresh');
		}
        $sl = $sl = $this->listings_model->get_slug($slug);
        if($sl){
            $id = $sl->id;
            //validation for create listings
            $this->form_validation->set_rules('title','Title','trim|required|xss_clean');
            $this->form_validation->set_rules('price','Price','trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('description','Description','trim|required|xss_clean');
            $this->form_validation->set_rules('phone','Phone','trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('street','Street','trim|required|alpha_numeric|xss_clean');
            $this->form_validation->set_rules('country','Country','trim|required|xss_clean');
            $this->form_validation->set_rules('zip','Zip','trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('tag','Tag','trim|required|xss_clean');
            
            if($this->form_validation->run() == true){
                if($_FILES['image']['size'] > 0)
                {
                    $ext = end(explode(".", $_FILES['image']['name']));
                    $file_name = $this->input->post('title').".".$ext;
                    $image_path = realpath(APPPATH."../themes/front/uploads/listing/");
                    $config = array(
                    'upload_path' => $image_path,
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'overwrite' => TRUE,
                    'file_name' => $file_name
                    );
                    // echo '<pre>';
                    // print_r($config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('image'))
                    {
                        $data = array('image' => $this->upload->data());
                    }
                    else
                    {
                        // echo '<pre>';    
                        $error = array('error' => $this->upload->display_errors());
                        // print_r($error);
                        $this->load->view('create_listing', $error);
                    }
                }else{
                    $data['image']['file_name'] = $this->input->post('edit_image');
                }
                $contact_method = implode(',',$this->input->post('contact_method'));
                $dataAdvertise = array(
                    'user_id'                   => USER_ID,
                    'category_id'               => $this->input->post('cat_id'),
                    'sub_category_id'           => $this->input->post('sub_cat_id'),
                    'listing_name'              => ucfirst($this->input->post('title')),
                    'slug'                      => preg_replace("![^a-z0-9]+!i", "-", strtolower($this->input->post('tag'))),
                    'listing_image'             => $data['image']['file_name'],
                    'listing_description'       => $this->input->post('description'),
                    'google_map'                => $this->input->post('google_map'),
                    'preferred_contact_method'  => $contact_method,
                    'negotiable'                => $this->input->post('negotiable'),
                    'price'                     => $this->input->post('price'),
                    'listing_type'              => $this->input->post('listing_type'),
                    'creation_time'             => date('Y-m-d H:m:s'),
                );
                // echo '<pre>';
                // print_r($dataAdvertise);exit; 
            }
            if(($this->form_validation->run() == true)){
                $slug = $this->listings_model->updateListings($dataAdvertise,$id);
                // $this->session->set_flashdata('success','Listing is created successfully.');
                redirect('listings/myad_listing','refresh');
            }else{
                $data['listing'] = $this->listings_model->getListingByID($sl->id);
                $list = $this->listings_model->getListingByID($sl->id);
                // echo '<pre>';
                // print_r($list);exit;
                $data['slug'] = $list->slug;
                $data['contact_method'] = $list->preferred_contact_method;
                $data['category'] = $this->listings_model->getCategoryName($list->category_id);
                $data['sub_category'] = $this->listings_model->getSubCategoryName($list->sub_category_id);
                $data['listing_type'] = $list->listing_type;
                $data['title'] = array(
                    'name'          => 'title',
                    'id'            => 'title',
                    'type'          => 'text',
                    'class'         => 'form-control',
                    'placeholder'   => 'Title',
                    'value'         => $this->form_validation->set_value('title',$list->listing_name),
                );
                $data['price'] = array(
                    'name'          => 'price',
                    'id'            => 'price',
                    'type'          => 'text',
                    'class'         => 'form-control',
                    'placeholder'   => 'Price',
                    'value'         => $this->form_validation->set_value('price',$list->price),
                );
                $data['description'] = array(
                    'name'      => 'description',
                    'id'        => 'description',
                    'type'      => 'text',
                    'class'     => 'form-control',
                    'rows'      => 3,
                    'cols'      => 50,
                    'value'     => $this->form_validation->set_value('description',$list->listing_description),
                );
                $data['phone'] = array(
                    'name'          => 'phone',
                    'id'            => 'phone',
                    'type'          => 'text',
                    'placeholder'   => 'Phone',
                    'class'         => 'form-control',
                    'value'         => $list->phone,
                );
                $data['street'] = array(
                    'name'          => 'street',
                    'id'            => 'street',
                    'type'          => 'text',
                    'class'         => 'form-control',
                    'placeholder'   => 'Street',
                    'value'         => $list->city,
                );
                $data['country'] = array(
                    'name'          => 'country',
                    'id'            => 'country',
                    'type'          => 'text',
                    'class'         => 'form-control',
                    'placeholder'   => 'Country',
                    'value'         => $list->country,
                );
                $data['zip'] = array(
                    'name'          => 'zip',
                    'id'            => 'zip',
                    'type'          => 'text',
                    'class'         => 'form-control',
                    'placeholder'   => 'Zip/Postal Code',
                    'value'         => $list->pincode,
                );
                $data['google_map'] = array(
                    'name'          => 'google_map',
                    'id'            => 'google_map',
                    'type'          => 'text',
                    'class'         => 'form-control',
                    'placeholder'   => 'https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d2965.0824050173574!2d-93.63905729999999!3d41.998507000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sWebFilings%2C+University+Boulevard%2C+Ames%2C+IA!5e0!3m2!1sen!2sus!4v1390839289319',
                    'value'         => $this->form_validation->set_value('google_map',$list->google_map),
                );
                $data['tags'] = array(
                    'name'          => 'tag',
                    'id'            => 'tag',
                    'type'          => 'text',
                    'class'         => 'form-control',
                    'placeholder'   => 'Tag',
                    'value'         => $this->form_validation->set_value('tag',$list->slug),
                );
                $data['negotiable'] = array(
                    'name'      => 'negotiable',
                    'id'        => 'negotiable',
                    'type'      => 'checkbox',
                    'value'     => 'negotiable',
                    'checked'   => ($list->negotiable == 'negotiable')?true:'',
                );
                $data['image'] = array(
                    'name'          => 'image',
                    'id'            => 'image',
                    'type'          => 'file',
                    // 'accept'        => 'image/*',
                    'class'         => 'form-control',
                );
                $data['cat_id'] = array(
                    'name'      => 'cat_id',
                    'id'        => 'cat_id',
                    'type'      => 'hidden',
                    'value'     => $list->category_id,
                );
                $data['sub_cat_id'] = array(
                    'name'      => 'sub_cat_id',
                    'id'        => 'sub_cat_id',
                    'type'      => 'hidden',
                    'value'     => $list->sub_category_id,
                );
                $data['edit_image'] = array(
                    'name'      => 'edit_image',
                    'id'        => 'edit_image',
                    'type'      => 'hidden',
                    'value'     => $list->listing_image,
                );
                $data['page_title'] = "Edit Listing";
                $this->template->build('edit_listing',$data);
            }
        }else{
            show_404();
        }
    }
    
    public function search(){
        $config['base_url'] = base_url()."index.php/listings/search";
        $config['per_page'] = 2;
        $config['uri_segment'] = '3';
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

        if($this->input->get('search') || $this->input->get('city')){
            $search = $this->input->get('search');
            $city = $this->input->get('city');
            $total_rows = $this->listings_model->record_count_search($search, $city);
            if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
            $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            $config['total_rows'] = $total_rows;
            $this->pagination->initialize($config);
            $data['search'] = $search;
            $data['listings'] = $this->listings_model->getSearchResult($config['per_page'],$this->uri->segment(3),$search, $city);
            $data['blogs'] = $this->listings_model->getBlogs();
            $data['listing'] = $this->listings_model->getListings();
            $data['page_title'] = "Search Listings";
            $this->template->build('car',$data);
        }else{
            show_404();
        }
            //else{
            // $total_rows = $this->listings_model->record_count();
            // $config['total_rows'] = $total_rows;
            // $this->pagination->initialize($config);
            // $data['listings'] = $this->listings_model->getListingsAll($config['per_page'],$this->uri->segment(3));
            // $data['blogs'] = $this->listings_model->getBlogs();
            // $data['listing'] = $this->listings_model->getListings();
            // $data['page_title'] = "Listings";
            // $this->template->build('car',$data);
        // }
	}
    
    function searchSuggetions(){
        if($this->input->get('term') && $this->input->get('city_name')){
            $city = $this->input->get('city_name');
            $term = $this->input->get('term');
            $data = $this->listings_model->suggetions($term, $city);
            echo json_encode($data);
        }
    }
    
    public function view_listing($slug = NULL){
        if(!$slug){
            show_404(); 
        }else{
            $sl = $this->listings_model->get_slug($slug);
            // echo '<pre>';
            // print_r($sl);exit;
            if($sl){
                // Visitor Counter
                $data['blogs'] = $this->listings_model->getBlogs();
                // echo '<pre>';
                // print_r($data['blogs']);exit;
                $this->add_count($slug);
                // if (!$this->session->userdata('timeout') || $this->session->userdata('timeout') < time()) {
                    // $this->session->set_userdata('timeout', time() + 100);
                    // $update = $this->listings_model->updateViews($sl->id,$sl->views);
                // }
                $data['listing_id'] = $sl->id;
                $data['user_id'] = $sl->user_id;
                $data['user'] = $this->listings_model->getUserByID($sl->user_id);
                $data['list'] = $sl;
                $data['other_listings'] = $this->listings_model->getOtherListings($sl->id,$sl->user_id);
                $data['releted_listings'] = $this->listings_model->getReletedListings($sl->category_id,$sl->id);
                // echo '<pre>';
                // print_r($data['other_listings']);exit;
                $data['page_title'] = "Listing &middot; ".ucfirst($sl->listing_name);
                $this->template->build('carforsale',$data);
            }else{
               show_404(); 
            }
        }
    }
    
    // This is the counter function.. 
    function add_count($slug = NULL) { 
        // load cookie helper $this->load->helper('cookie'); 
        // this line will return the cookie which has slug name 
        $check_visitor = $this->input->cookie($slug, true);
        // this line will return the visitor ip address 
        $ip = $this->input->ip_address(); 
        // if the visitor visit this article for first time then 
        // 
        //set new cookie and update article_views column .. 
        //you might be notice we used slug for cookie name and ip 
        //address for value to distinguish between articles views 
        if ($check_visitor == false) { 
            $cookie = array( 
                "name" => urldecode($slug), 
                "value" => "$ip", 
                "expire" => time() + 7200, 
                "secure" => false 
            );
            // echo '<pre>';
            // print_r($cookie);exit;
            $this->input->set_cookie($cookie); 
            $this->listings_model->updateViews($slug); 
        } 
    } 
    
    public function review_listing($slug = NULL){
        if (!$this->ion_auth->logged_in()){
            
            // redirect them to the login page
			redirect('auth/login', 'refresh');
		}
        $sl = $this->listings_model->get_slug($slug);
        // echo $sl->id;exit;
        if($sl){
            $data['listing'] = $this->listings_model->getListingByID($sl->id);
            $list = $this->listings_model->getListingByID($sl->id);
            $data['phone'] = array(
                'id'        => 'phone',
                'name'      => 'phone',
                'type'      => 'hidden',
                'value'     => $list->phone,
            );
            $data['country'] = array(
                'id'        => 'country',
                'name'      => 'country',
                'type'      => 'hidden',
                'value'     => $list->country,
            );
            $data['city'] = array(
                'id'        => 'city',
                'name'      => 'city',
                'type'      => 'hidden',
                'value'     => $list->city,
            );
            $data['pincode'] = array(
                'name'      => 'pincode',
                'id'        => 'pincode',
                'type'      => 'hidden',
                'value'     => $list->pincode,
            );
            $data['title'] = array(
                'name'      => 'item_name_1',
                'id'        => 'item_name_1',
                'type'      => 'hidden',
                'value'     => $list->listing_name,
            );
            $data['listing_id'] = array(
                'id'        => 'item_number_1',
                'name'      => 'item_number_1',
                'type'      => 'hidden',
                'value'     => $sl->id
            );
            if($list->listing_type == 'paid'){
                $listing_price = $this->listings_model->get_listing_price();
                $data['list_price'] = $listing_price->listing_price;
                $data['price'] = array(
                    'id'        => 'amount_1',
                    'name'      => 'amount_1',
                    'value'     => $listing_price->listing_price,
                    'type'      => 'hidden',
                );
            }else{
                $data['price'] = array(
                    'id'        => 'amount_1',
                    'name'      => 'amount_1',
                    'value'     => 0,
                    'type'      => 'hidden',
                );
            }
            
            // echo '<pre>';
            // print_r($data['listing']);exit;
            $data['page_title'] = "Review Listing";
            $this->template->build('review_listing',$data);
        }else{
            show_404();
        }
    }
    
    function edit_user($id = NULL){
        if (!$this->ion_auth->logged_in()){
            
            // redirect them to the login page
			redirect('auth/login', 'refresh');
		}
        // validation for edit user
        $this->form_validation->set_rules('fname','First Name','trim|required|xss_clean');
        $this->form_validation->set_rules('lname','Last Name','trim|required|xss_clean');
        $this->form_validation->set_rules('email','Email','trim|required|xss_clean');
        $this->form_validation->set_rules('website','Website','trim|xss_clean');
        $this->form_validation->set_rules('abtme','About Me','trim|xss_clean');
        $this->form_validation->set_rules('twitter','Twitter','trim|xss_clean');
        $this->form_validation->set_rules('facebook','Facebook','trim|xss_clean');
        $this->form_validation->set_rules('phone','Phone','trim|xss_clean');
        $this->form_validation->set_rules('city','City','trim|xss_clean');
        $this->form_validation->set_rules('state','State','trim|xss_clean');
        $this->form_validation->set_rules('zip','Pincode','trim|xss_clean');
        $this->form_validation->set_rules('country','Country','trim|xss_clean');
        
        if($this->form_validation->run() > 0){
            
            if($_FILES['profile']['size'] > 0)
            {
                $ext = end(explode(".", $_FILES['profile']['name']));
                $file_name = $this->input->post('fname').".".$ext;
                $image_path = realpath(APPPATH."../themes/front/uploads/users/");
                $config = array(
                'upload_path' => $image_path,
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'file_name' => $file_name
                );
                // echo '<pre>';
                // print_r($config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('profile'))
                {
                    $data = array('profile' => $this->upload->data());
                }
                else
                {
                    // echo '<pre>';    
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);
                    $this->load->view('create_listing', $error);
                }
            }else{
                $data['profile']['file_name'] = $this->input->post('edit_image');
            }
            $user = array(
                'first_name'            => $this->input->post('fname'),
                'last_name'             => $this->input->post('lname'),
                'email'                 => $this->input->post('email'),
                'website'               => $this->input->post('website'),
                'about'                 => $this->input->post('abtme'),
                'twitter'               => $this->input->post('twitter'),
                'facebook'              => $this->input->post('facebook'),
                'phone'                 => $this->input->post('phone'),
                'city'                  => $this->input->post('city'),
                'state'                 => $this->input->post('state'),
                'pincode'               => $this->input->post('zip'),
                'country'               => $this->input->post('country'),
                'image'                 => $data['profile']['file_name'],
            );
            // echo '<pre>';
            // print_r($user);exit;
        }
        
        if(($this->form_validation->run() == true) && $this->listings_model->update_profile($user,$id)){
            $this->session->set_flashdata('success','User updated successfully.');
            redirect('listings/myad_listing','refresh');
        }else{
            show_404();
        }
    }
    
    function addQuery(){
        //set validation rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric');
        $this->form_validation->set_rules('query', 'Query', 'trim|required');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim');
        $this->form_validation->set_rules('listing_id', 'Listing Id', 'trim');
        
        //run validation check
        if ($this->form_validation->run() == true)
        {   
            //get the form data
            $dataCustomer = array(
                'name'              => $this->input->post('name'),
                'address'           => $this->input->post('address'),
                'mobile'            => $this->input->post('phone'),
                'user_id'           => $this->input->post('to_user'),
                'listing_id'        => $this->input->post('listing_id'),
                'query'             => $this->input->post('query'),
                'creation_time'     => date('Y-m-d H:m:s')
            );
        }

        if(($this->form_validation->run() == true) && $this->listings_model->addQuery($dataCustomer)){
            // $this->session->set_flashdata('success','Customer added successfully.');
            echo 'YES';
        }else{
            //validation fails
            echo validation_errors();
        }
    }
    
    public function order_summary($tx = NULL){
        if (!$this->ion_auth->logged_in()){
            
            // redirect them to the login page
			redirect('auth/login', 'refresh');
		}
        // if($tx){
            $data['page_title'] = "Order Summary";
            $data['success'] = $this->verifyWithPayPal($_GET['tx']);
            $this->template->build('order_summary',$data);
        // }else{
            // show_404();
        // }
    }
    
    public function order_summary_free($tx = NULL){
        if (!$this->ion_auth->logged_in()){
            
            // redirect them to the login page
			redirect('auth/login', 'refresh');
		}
        $data['page_title'] = "Order Summary";
        $this->template->build('order_summary_free',$data);
    }
    
    function getListProducts($result){
        $i=1;
        $data = array();
        foreach($result as $key=>$value){
            if(0 === strpos($key,'item_number')){
                $product = array(
                    'item_number'   => $result['item_number'.$i],
                    'item_name'     => $result['item_name'.$i],
                    'quantity'      => $result['quantity'.$i],
                    'mc_gross'      => $result['mc_gross_'.$i]
                );
                
                array_push($data,$product);
                $i++;
            }
        }
        return $data;
    }
    
    function verifyWithPayPal($tx){
        $tx = $_REQUEST['tx'];
        $token = $this->config->item('authtoken');
        $paypal_url = $this->config->item('posturl').'?cmd=_notify-synch&tx='.$tx.'&at='.$token;
        $curl = curl_init($paypal_url);
        $data = array(
            "cmd"       => "_notify-synch",
            "tx"        => $tx,
            "at"        => $token
        );
        $data_string = json_encode($data);
        curl_setopt($curl, CURLOPT_HEADER,0);
        curl_setopt($curl,CURLOPT_POST,1);
        curl_setopt($curl,CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        
        $headers = array(
            'Content-Type: application/x-www-form-urlencoded',
            'Host: www.sandbox.paypal.com',
            'Connection: close'
        );
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
        $response = curl_exec($curl);
        $lines = explode("\n",$response);
        $keyarray = array();
        // echo '<pre>';
        // print_r($lines);exit;
        if(strcmp($lines[0],"SUCCESS") == 0){
            for($i = 1; $i<(count($lines)-1); $i++){
                list($key,$val) = explode("=",$lines[$i]);
                $keyarray[urldecode($key)] = urldecode($val);
            }
            $keyarray['listProducts'] = $this->getListProducts($keyarray);
        }
        foreach($keyarray['listProducts'] as $val){
            // echo '<pre>';
            // print_r($val);exit;
            $tx = $this->listings_model->checkTransaction($keyarray['txn_id']);
            if($tx){
                // echo 'if';exit;
                // ignore
            }else{
                $data = array(
                    'transaction_id'        => $keyarray['txn_id'],
                    'listing_id'            => $val['item_number'],
                    'amount_paid'           => $val['mc_gross'],
                    'transaction_date'      => date('Y-m-d'),
                    'creation_time'         => date('Y-m-d H:m:s')
                );
                // echo '<pre>';
                // print_r($data);exit;
                // echo 'else';exit;
                $this->listings_model->addTransaction($data);
            }
        }
        // $keyarray['txn_id']
        return $keyarray;
    }
    
    // delete listing
    function delete($slug = NULL){
        $sl = $this->listings_model->get_slug($slug);
        // echo '<pre>';
        // print_r($sl);exit;
        if($sl){
            if($this->listings_model->delete($sl->id)){
                $this->session->set_flashdata('success',"$sl->listing_name is deleted successfully.");
                redirect('listings/myad_listing','refresh');
            }
        }else{
            show_404();
        }
    }
    // pause listing
    function pause($slug = NULL){
        $sl = $this->listings_model->get_slug($slug);
        // echo '<pre>';
        // print_r($sl);exit;
        if($sl){
            if($this->listings_model->pause($sl->id)){
                $this->session->set_flashdata('success',"$sl->listing_name is paused successfully.");
                redirect('listings/myad_listing','refresh');
            }
        }else{
            show_404();
        }
    }
    
    // mark as sold
    function sold($slug = NULL){
        $sl = $this->listings_model->get_slug($slug);
        if($sl){
            // echo '<pre>';
            // print_r($sl);exit;
            if($this->listings_model->mark_sold($sl->id)){
                $this->session->set_flashdata('success',"$sl->listing_name is sold out.");
                redirect('listings/myad_listing','refresh');
            }
        }else{
            show_404();
        }
    }
    
    // mark as unsold
    function unsold($slug = NULL){
        $sl = $this->listings_model->get_slug($slug);
        if($sl){
            // echo '<pre>';
            // print_r($sl);exit;
            if($this->listings_model->mark_unsold($sl->id)){
                $this->session->set_flashdata('success',"$sl->listing_name is unsold.");
                redirect('listings/myad_listing','refresh');
            }
        }else{
            show_404();
        }
    }
    
    // mark as unpause
    function unpause($slug = NULL){
        $sl = $this->listings_model->get_slug($slug);
        if($sl){
            // echo '<pre>';
            // print_r($sl);exit;
            if($this->listings_model->unpause($sl->id)){
                $this->session->set_flashdata('success',"$sl->listing_name is played.");
                redirect('listings/myad_listing','refresh');
            }
        }else{
            show_404();
        }
    }

    // get subcategory from category selected via ajax
    function getSubCategory(){
        if($this->input->post('category')){
            $category = $this->input->post('category');
            $sub = $this->listings_model->getSubCategoryByCatID($category);
            echo json_encode($sub);
        }
    }
    
    // get transactions by status
    function getTransactions(){
        if($status = $this->input->post('status')){
            $st = explode(',',$status);
            $txn = $this->listings_model->getTransactionByStatus($st);
            echo json_encode($txn);
        }
        
    }
}
?>