<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Messages_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function getMessages(){
        $this->db->where('is_deleted','0');
        $q = $this->db->get_where('inbox1',array('user_id'=>USER_ID));
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getMessageByID($id = NULL){
        $this->db->select('inbox1.*,listings.listing_name');
        $this->db->from('inbox1');
        $this->db->join('listings','listings.id = inbox1.listing_id');
        $this->db->where('inbox1.id',$id);
        $q = $this->db->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function getUserDetail(){
        $q = $this->db->get_where('users',array('id'=>USER_ID));
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function delete($id = NULL){
        $this->db->where('id',$id);
        if($this->db->update('inbox1',array('is_deleted'=>'1'))){
            return true;
        }
        return false;
    }
}
?>