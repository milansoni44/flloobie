<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function getUsers(){
        // $q = $this->db->get('users');
        $q = $this->db->select('count(id) as no')->from('users')->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function getListings(){
        $q = $this->db->select('count(id) as number_listing')->from('listings')->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function getLoggedInUsers(){
        $this->db->select('count(id) as logged_in')->from('login_activity');
        $this->db->like('timestamp', date('Y-m-d'));
        $q = $this->db->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function getTodayListing(){
        $this->db->select('listings.*,category.category_name');
        $this->db->from('listings');
        $this->db->like('listings.creation_time', date('Y-m-d'));
        $this->db->join('category','category.id = listings.category_id');
        $q = $this->db->get();
        
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
}
?>