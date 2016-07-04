<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class City_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function getStates(){
        $q = $this->db->get_where('states',array('country_id'=>'231'));
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getCitiesAll(){
        $q = $this->db->get('cities');
        // echo $this->db->last_query();exit;
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function getCities($id = NULL){
        $s_ids = explode(',',$id);
        $q = $this->db->select('*')->from('cities')->where_in('state_id',$s_ids)->get();
        // echo $this->db->last_query();
        if($q->num_rows() > 0){
            return $q->result_array();
        }
        return false;
    }
    
    function AllowStatesCities($data = array()){
        $st = explode(',',$data['states']);
        $ct = explode(',',$data['cities']);
        foreach($st as $rw){
            $this->db->where('id',$rw);
            if($this->db->update('states',array('allow'=>0))){
                foreach($ct as $rt){
                    $this->db->where('id',$rt);
                    $this->db->update('cities',array('allow'=>0));
                }
            }
        }
        return true;
    }
    
    function getAllowedCities(){
        $q = $this->db->get_where('cities',array('allow'=>0));
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $row1[] = $row;
            }
            return $row1;
        }
        return false;
    }
    
    function disable($id = NULL){
        $this->db->where('id',$id);
        if($this->db->update('cities',array('allow'=>1))){
            return true;
        }
        return false;
    }
}
?>