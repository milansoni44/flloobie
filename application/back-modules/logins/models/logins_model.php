<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logins_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    function get_data(){
        // $this->db->order_by("timestamp", "desc"); 
        // $this->db->join('users','users.id = login_activity.user_id');
        // $q = $this->db->select('login_activity.id as ID,*')->from('login_activity')->get();
        // $q = $this->db->get('login_activity');
        $q = $this->db->select('login_activity.id as ID, login_activity.timestamp, users.first_name')
            ->from('login_activity')
            ->join('users','users.id = login_activity.user_id')
            ->order_by('login_activity.id','desc')
            ->get();
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