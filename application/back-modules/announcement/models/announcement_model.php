<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Announcement_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function getAnnouncement(){
        $q = $this->db->get('announcement');
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getAnnouncementByID($id = NULL){
        $q = $this->db->get_where('announcement',array('id'=>$id));
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function addAnnouncement($data = array()){
        if($this->db->insert('announcement',$data)){
            return true;
        }
        return false;
    }
    
    function editAnnouncement($data = array(), $id = NULL){
        $this->db->where('id',$id);
        if($this->db->update('announcement',$data)){
            return true;
        }
        return false;
    }
}
?>