<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Blogcategory_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function getCategories(){
        $q = $this->db->get('blog_category');
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getCategoryByID($id = NULL){
        $q = $this->db->get_where('blog_category',array('id'=>$id));
        if($q->num_rows() > 0){
           return $q->row();
        }
        return false;
    }
    
    function addCategory($data = array()){
        if($this->db->insert('blog_category',$data)){
            return true;
        }
        return false;
    }
    
    function updateCategory($data = array(), $id = NULL){
        $this->db->where('id',$id);
        if($this->db->update('blog_category',$data)){
            return true;
        }
        return false;
    }
}
?>