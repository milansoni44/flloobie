<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function getCategoryLimit6(){
        $this->db->limit(6);
        $q = $this->db->get('category');
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getCategoryLimit12(){
        $this->db->limit(12,6);
        $q = $this->db->get('category');
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getFeaturedLimit4(){
        $this->db->order_by('id','desc');
        $this->db->where('listing_type','paid');
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
    function getFeaturedLimit8(){
        $this->db->order_by('id','desc');
        $this->db->where('listing_type','paid');
        $q = $this->db->get('listings',4,4);
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getSearchResult($search_term = NULL){
        $this->db->select('*')->from('listings');
        $this->db->like('listing_name', $search_term);
        $q = $this->db->get();
        if($q->num_rows() > 0){
            // return $q->result_array();
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
}
?>