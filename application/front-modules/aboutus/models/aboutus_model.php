<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aboutus_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    function getAboutUs(){
        $q = $this->db->get('about_us');
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function getBlog(){
        $this->db->order_by('id','desc');
        $q = $this->db->get('blog',5);
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