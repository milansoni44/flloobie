<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Subcategory_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function getCategories(){
        $q = $this->db->get('category');
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getSubCategories(){
        $q = $this->db->select('*')->from('sub_category')->join('category','category.id = sub_category.category_id')->get();
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getSubCategoryByID($id = NULL){
        $q = $this->db->get_where('sub_category',array('id'=>$id));
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function addSubCategory($data = array()){
        if($this->db->insert('sub_category',$data)){
            return true;
        }
        return false;
    }
    
    function updateSubCategory($data = array(), $id = NULL){
        $this->db->where('id',$id);
        if($this->db->update('sub_category',$data)){
            return true;
        }
        return false;
    }
}
?>