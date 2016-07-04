<?php if( !defined('BASEPATH')) exit('No Direct Script access allowed.');
class Announcements_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function getAnnouncement(){
        $q = $this->db->get('announcement');
        if( $q->num_rows() > 0 ){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getAnnouncementStatus(){
        $this->db->where('user_id',USER_ID);
        $q = $this->db->get('announcement_status');
        // echo $this->db->last_query();exit;
        if( $q->num_rows() > 0 ){
            foreach($q->result() as $row){
                $row1[] = $row->announcement_id;
            }
            return $row1;
        }
        return false;
    }
    
    function changeStatus($id = NULL){
        // if entry not exist in status table then insert 
        // else
        // update status table
        $q = $this->db->get_where('announcement_status',array('announcement_id'=>$id));
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            return false;
        }else{
            $data = array(
                'announcement_id'       => $id,
                'user_id'               => USER_ID,
                'creation_time'         => date('Y-m-d H:m:s'),
            );
            if($this->db->insert('announcement_status',$data)){
                return true;
            }
        }
        
    }
    
    function get_admin(){
        $q = $this->db->get_where('users',array('id'=>1));
        if($q->num_rows() > 0){
            return $q->row();
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
}
?> 