<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_model extends MX_Controller {
    public function __construct(){
        parent::__construct();
    }
    
    function getBlogBySlug($slug = NULL){
        // $q = $this->db->get_where('blog',array('blog_keywords'=>$slug));
        $q = $this->db->select('blog.*,users.first_name,users.last_name')->from('blog')->join('users','users.id = blog.user_id')->where('blog_keywords',$slug)->get();
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function get_blog($limit = NULl, $offset = NULL){
        $q = $this->db->select('blog.*,users.first_name,users.last_name')->from('blog')->join('users','users.id = blog.user_id')->limit($limit,$offset)->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function count_records(){
        $q = $this->db->get('blog');
        if($q->num_rows() > 0){
            return $q->num_rows();
        }
        return false;
    }
    
    function getBlogs(){
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
    
    function getListings(){
        $this->db->order_by('id','desc');
        $q = $this->db->get('listings',5);
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