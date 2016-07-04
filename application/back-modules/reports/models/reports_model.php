<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function getActiveListings(){
        $q = $this->db->get_where('listings',array('is_active'=>0));
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getActiveListingByDate($data = array()){
        $this->db->where('creation_time >=', $data['from']);
        $this->db->where('creation_time <=', $data['to']);
        $q = $this->db->get('listings');
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getPausedListing(){
        $q = $this->db->get_where('listings',array('is_pause'=>1));
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getPaidListing(){
        $q = $this->db->get_where('listings',array('listing_type'=>'paid'));
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getPaidListingByDate($data = array()){
        $this->db->where('creation_time >=', $data['from']);
        $this->db->where('creation_time <=', $data['to']);
        $this->db->where('listing_type','paid');
        $q = $this->db->get('listings');
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getFreeListing(){
        $q = $this->db->get_where('listings',array('listing_type'=>'free'));
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getFreeListingByDate($data = array()){
        $this->db->where('creation_time >=', $data['from']);
        $this->db->where('creation_time <=', $data['to']);
        $this->db->where('listing_type','free');
        $q = $this->db->get('listings');
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getActiveUsers(){
        $q = $this->db->select('users.*,login_activity.timestamp')
            ->from('users')
            ->join('login_activity','login_activity.user_id = users.id')
            ->get();
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getActiveUserByDate($data = array()){
        $this->db->where('login_activity.timestamp >=', $data['from']);
        $this->db->where('login_activity.timestamp <=', $data['to']);
        $q = $this->db->select('users.*,login_activity.timestamp')
            ->from('login_activity')
            ->join('users','login_activity.user_id = users.id')
            ->get();
        // echo $this->db->last_query();exit;
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