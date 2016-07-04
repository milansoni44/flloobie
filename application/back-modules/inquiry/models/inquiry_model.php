<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inquiry_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function getInquiry(){
        $q = $this->db->get('contact_inquiry');
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getInquiryByID($id = NULL){
        $q = $this->db->get_where('contact_inquiry',array('id'=>$id));
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
}
?>