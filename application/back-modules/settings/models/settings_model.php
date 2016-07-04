<?php
class Settings_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function updateSettings($data = array()){
        $this->db->where('id',1);
        if($this->db->update('settings',$data)){
            return true;
        }
        return false;
    }
    
    function getSettings(){
        $q = $this->db->get_where('settings',array('id'=>1));
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
}
?>