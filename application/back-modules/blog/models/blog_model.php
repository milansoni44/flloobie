<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Blog_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function getBlogCategories(){
        $q = $this->db->get('blog_category');
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getBlogs(){
        $q = $this->db->select('blog.*,blog_category.blog_category_name')->from('blog')->join('blog_category','blog_category.id = blog.blog_category_id')->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getBlogByID($id = NULL){
        $q = $this->db->get_where('blog',array('id'=>$id));
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function addBlog($data = array()){
        if($this->db->insert('blog',$data)){
            return true;
        }
        return false;
    }
    
    function updateBlog($data = array(), $id = NULL){
        $this->db->where('id',$id);
        if($this->db->update('blog',$data)){
            return true;
        }
        return false;
    }
}
?>