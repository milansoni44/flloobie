<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Listings_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function getCity($id = NULL){
        $q = $this->db->get_where('cities',array('id'=>$id));
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function getCitiesAllowed(){
        $q = $this->db->get_where('cities',array('allow'=>0));
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getCountry($id = NULL){
        $q = $this->db->get_where('countries',array('id'=>$id));
		$this->db->last_query();
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function getStates(){
        $q = $this->db->get_where('states',array('allow'=>0));
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getCategories(){
        $q = $this->db->get('category');
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getSubCategories(){
        $q = $this->db->get('sub_category');
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getUser(){
        $q = $this->db->get_where('users',array('id'=>USER_ID));
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function getCategoryName($id = NULL){
        $q = $this->db->get_where('category',array('id'=>$id));
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                return $row->category_name;
            }
        }
        return false;
    }
    
    function getSubCategoryName($id = NULL){
        $q = $this->db->get_where('sub_category',array('id'=>$id));
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                return $row->sub_category_name;
            }
        }
        return false;
    }
    
    function get_slug($slug){
        $q = $this->db->get_where('listings',array('slug'=>$slug));
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function getListingByID($id = NULL){
        // $q = $this->db->get_where('listings',array('id'=>$id));
        $q = $this->db->select('listings.*,category.category_name,users.phone,users.city,users.country,users.pincode')->from('listings')->join('category','category.id = listings.category_id')/*->join('sub_category','sub_category.id = listings.sub_category_id')*/->join('users','users.id = listings.user_id')->where('listings.id',$id)->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function getReletedListings($cat_id = NULl, $list_id = NULl){
        $this->db->where('category_id',$cat_id);
        // $this->db->order_by('id','desc');
        $this->db->where_not_in('id',$list_id);
        $q = $this->db->get('listings',4);
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function get_listing_price(){
        $q = $this->db->get('settings');
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function createListings($data = array()){
        if($this->db->insert('listings',$data)){
            // return true;
            return $data['slug'];
        }
        return false;
    }
    
    function updateListings($data = array(), $id){
        $this->db->where('id',$id);
        if($this->db->update('listings',$data)){
            return true;
        }
        return false;
    }
    
    function getUserByID($id = NULL){
        $q = $this->db->get_where('users',array('id'=>$id));
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function getOtherListings($id = NULL, $user_id = NULL){
        $ignore = array($id);
        $q = $this->db->select('*')->from('listings')->where('user_id',$user_id)->where_not_in('id',$id)->limit(5,0)->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getListingsByUser($id = null){
        $this->db->where('is_deleted',0);
        $q = $this->db->get_where('listings',array('user_id'=>$id));
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function updateViews($slug){
        // return current article views 
        $this->db->where('slug', urldecode($slug)); 
        $this->db->select('views'); 
        $count = $this->db->get('listings')->row(); 
        // then increase by one 
        $this->db->where('slug', urldecode($slug)); 
        $this->db->set('views', ($count->views + 1)); 
        $this->db->update('listings');
    }
    
    public function getBlogs(){
        $this->db->order_by('id','desc');
        $q = $this->db->get('blog');
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function update_profile($data = array(), $id = NULL){
        $this->db->where('id',$id);
        if($this->db->update('users',$data)){
            return true;
        }
        return false;
    }
    
    function addQuery($data = array()){
        if($this->db->insert('inbox1',$data)){
            return true;
        }
        return false;
    }
    
    function getListingsAll($limit = NULL, $offset = NULL){
        $q = $this->db->select('listings.*,users.first_name,users.last_name')->from('listings')->join('users','users.id = listings.user_id')->limit($limit,$offset)->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function record_count(){
        return $this->db->count_all('listings');
    }
    
    function getListings(){
        $this->db->order_by('id','desc');
        $q = $this->db->get('listings',5);
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getSearchResult($limit = NULL, $offset = NULL, $search_term = NULL, $city = NULL){
        if($city == 'All' && $search_term != ''){
            $this->db->limit($limit, $offset);
            $this->db->select('listings.*,users.first_name,last_name')->from('listings');
            $this->db->like('listing_name', $search_term);
            $this->db->join('users','users.id = listings.user_id');
            $q = $this->db->get();
            // echo $this->db->last_query();exit;
            if($q->num_rows() > 0){
                // return $q->result_array();
                foreach($q->result() as $row){
                    $row1[] = $row;
                }
                return $row1;
            }
        }else if($search_term != '' && $city != 'All'){
            $this->db->limit($limit, $offset);
            $this->db->select('listings.*,users.first_name,last_name')->from('listings');
            $this->db->like('listing_name', $search_term);
            $this->db->join('users','users.id = listings.user_id');
            $this->db->join('cities','cities.id = users.city');
            $this->db->where('cities.name',$city);
            $q = $this->db->get();
            // echo $this->db->last_query();exit;
            if($q->num_rows() > 0){
                // return $q->result_array();
                foreach($q->result() as $row){
                    $row1[] = $row;
                }
                return $row1;
            }
        }else if($search_term = '' && $city != 'All'){
            $this->db->limit($limit, $offset);
            $this->db->select('listings.*,users.first_name,last_name')->from('listings');
            $this->db->join('users','users.id = listings.user_id');
            $this->db->join('cities','cities.id = users.city');
            $this->db->where('cities.name',$city);
            $q = $this->db->get();
            // echo $this->db->last_query();exit;
            if($q->num_rows() > 0){
                // return $q->result_array();
                foreach($q->result() as $row){
                    $row1[] = $row;
                }
                return $row1;
            }
        }else{
            $this->db->limit($limit, $offset);
            $this->db->select('listings.*,users.first_name,last_name')->from('listings');
            $this->db->join('users','users.id = listings.user_id');
            $q = $this->db->get();
            // echo $this->db->last_query();exit;
            if($q->num_rows() > 0){
                // return $q->result_array();
                foreach($q->result() as $row){
                    $row1[] = $row;
                }
                return $row1;
            }
        }
        return false;
    }
    
    function record_count_search($search_term = NULL, $city = NULL){
        if($city == 'All' && $search_term != ''){
            $this->db->select('listings.*,users.first_name,last_name')->from('listings');
            $this->db->like('listing_name', $search_term);
            $this->db->join('users','users.id = listings.user_id');
            $q = $this->db->get();
            // echo $this->db->last_query();exit;
            if($q->num_rows() > 0){
                return $q->num_rows();
            }
        }else if($search_term != '' && $city != 'All'){
            $this->db->select('listings.*,users.first_name,last_name')->from('listings');
            $this->db->like('listing_name', $search_term);
            $this->db->join('users','users.id = listings.user_id');
            $this->db->join('cities','cities.id = users.city');
            $this->db->where('cities.name',$city);
            $q = $this->db->get();
            // echo $this->db->last_query();exit;
            if($q->num_rows() > 0){
                return $q->num_rows();
            }
        }else if($search_term = '' && $city != 'All'){
            $this->db->select('listings.*,users.first_name,last_name')->from('listings');
            $this->db->join('users','users.id = listings.user_id');
            $this->db->join('cities','cities.id = users.city');
            $this->db->where('cities.name',$city);
            $q = $this->db->get();
            // echo $this->db->last_query();exit;
            if($q->num_rows() > 0){
                return $q->num_rows();
            }
        }else{
            $this->db->select('listings.*,users.first_name,last_name')->from('listings');
            $this->db->join('users','users.id = listings.user_id');
            $q = $this->db->get();
            // echo $this->db->last_query();exit;
            if($q->num_rows() > 0){
                return $q->num_rows();
            }
        }
        return false;
    }
    
    function suggetions($term = NULL, $city = NULL){
        if($city == 'All'){
            $this->db->select('listings.*');
            $this->db->from('listings');
            $this->db->like('listing_name',$term);
            $q = $this->db->get();
            if($q->num_rows() > 0){
                foreach($q->result() as $row){
                    $name[] = $row->listing_name;
                }
                return $name;
            }
        }else{
            $this->db->select('listings.*');
            $this->db->from('listings');
            $this->db->join('users','listings.user_id = users.id');
            $this->db->join('cities','cities.id = users.city');
            $this->db->where('cities.name',$city);
            $this->db->like('listing_name',$term);
            $q = $this->db->get();
            if($q->num_rows() > 0){
                foreach($q->result() as $row){
                    $name[] = $row->listing_name;
                }
                return $name;
            }
        }
        // $q = $this->db->select('listings.*')->from('listings')->like('listing_name',$term)->get();
        return false;
    }
    
    function checkTransaction($txn_id = NULL){
        $q = $this->db->get_where('transaction',array('id'=>$txn_id));
        if($q->num_rows() > 0){
            return true;
        }
        return false;
    }
    
    function addTransaction($data = array()){
        if ($this->db->insert('transaction',$data)) {
           return true;
        }
        return true;
    }
    
    function getLiveListings($id = NULL){
        $q = $this->db->select('count(*) as num')
            ->from('transaction')
            ->join('listings','listings.id = transaction.listing_id')
            ->where('listings.user_id',$id)
            ->where('status','activated')
            ->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function getPendingListings($id = NULL){
        $q = $this->db->select('count(*) as num')
            ->from('transaction')
            ->join('listings','listings.id = transaction.listing_id')
            ->where('listings.user_id',$id)
            ->where('status','pending')
            ->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    // mark as sold
    function mark_sold($id = NULL){
        $this->db->where('id',$id);
        if($this->db->update('listings',array('is_sold'=>1))){
            return true;
        }
        return false;
    }
    
    // delete listing
    function delete($id = NULL){
        $this->db->where('id',$id);
        if($this->db->update('listings',array('is_deleted'=>1))){
            return true;
        }
        return false;
    }
    
    // pause listing
    function pause($id = NULL){
        $this->db->where('id',$id);
        if($this->db->update('listings',array('is_pause'=>1))){
            return true;
        }
        return false;
    }
    
    // mark as sold
    function mark_unsold($id = NULL){
        $this->db->where('id',$id);
        if($this->db->update('listings',array('is_sold'=>0))){
            return true;
        }
        return false;
    }
    
    // mark as sold
    function unpause($id = NULL){
        $this->db->where('id',$id);
        if($this->db->update('listings',array('is_pause'=>0))){
            return true;
        }
        return false;
    }
    
    function getPauseItem($slug = NULL){
        $this->db->where('slug',$slug);
        $q = $this->db->get_where('listings',array('is_pause'=>1));
        if($q->num_rows() > 0){
            return true;
        }
        return false;
    }
    
    function getSoldItem($slug = NULL){
        $this->db->where('slug',$slug);
        $q = $this->db->get_where('listings',array('is_sold'=>1));
        if($q->num_rows() > 0){
            return true;
        }
        return false;
    }
    
    function getTransactions(){
        $this->db->select('transaction.*,listings.listing_name');
        $this->db->from('transaction');
        $this->db->join('listings','listings.id = transaction.listing_id');
        $this->db->where('listings.user_id',USER_ID);
        $q = $this->db->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    // get transaction by status
    function getTransactionByStatus($st = NULL){
        $q = $this->db->select('transaction.*,listings.listing_name')
            ->from('transaction')
            ->join('listings','listings.id = transaction.listing_id')
            ->where('listings.user_id',USER_ID)
            ->where_in('status',$st)
            ->get();
        // return $this->db->last_query();
        if($q->num_rows() > 0){
            return $q->result_array();
        }
        return false;
    }
    
    // get subcategory by category id
    function getSubCategoryByCatID($id = NULL){
        $q = $this->db->get_where('sub_category',array('category_id'=>$id));
        if($q->num_rows() > 0){
            return $q->result_array();
        }
        return false;
    }
}
?>