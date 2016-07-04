<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contactus_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function getBlog(){
        $this->db->order_by('id','desc');
        $q = $this->db->get('blog',5);
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function addContact($data = array()){
        if($this->db->insert('contact_inquiry',$data)){
            return true;
        }
        return false;
    }
}
?>