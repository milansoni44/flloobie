<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    
    function getCategory($code = NULL){
        $q = $this->db->get_where('category',array('category_code'=>$code));
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            return $q->row();
        }
        return false;
    }
    
    function count_records($id = NULL){
        $q = $this->db->select('listings.*,users.first_name')->from('listings')->join('users','users.id = listings.user_id')->join('category','category.id = listings.category_id')->where('category.id',$id)->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            return $q->num_rows();
        }
        return false;
    }
    
    function getAdvByCategory($limit = NULL, $offset = NULL, $id = NULL){
        // $q = $this->db->get_where('listings',array('category_id'=>$id));
        $q = $this->db->select('listings.*,users.first_name')->from('listings')->join('users','users.id = listings.user_id')->join('category','category.id = listings.category_id')->where('category.id',$id)->limit($limit,$offset)->get();
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
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
    
    function getPost(){
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