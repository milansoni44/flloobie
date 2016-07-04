<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aboutus_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function addAbout($data = array(), $id = NULL){
        $this->db->where('id',$id);
        if($this->db->update('about_us',$data)){
            return true;
        }
        return false;
    }
    
    function getAboutUs(){
        $q = $this->db->get('about_us');
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
}
?>