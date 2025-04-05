<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->db->cache_delete_all();
	}
		
	public function check_logged(){
		return ($this->session->userdata('logged_in_admin_data'))?TRUE:FALSE;
	}
	public function adminLogin($data){
		$this->db->cache_on();
		 if(!empty($data)){		
			$condition = "(email =" . "'" . $data['username'] . "' OR "." name =" . "'" . $data['username'] . "') AND " . "password =" . "'" . $data['password'] . "'";
			$this->db->select('*');
			$this->db->from('admin');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			if ($query->num_rows() == 1) {
				return  $query->row_object();
			}else{
			  return false;		
			}
		 }else{
			 return false;
		 }
	}
	public function getNumRows($table=null,$where_condition=array()){
		if(isset($where_condition) && !empty($where_condition)){
			$this->db->where($where_condition);
		}
		$q = $this->db->get($table);
		return $q->num_rows();
	}
	public function getData($table, $where_column=array(),$order_by='',$where_colum_or=array()){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where_column);
		if(isset($where_colum_or) && !empty($where_colum_or)){
			$this->db->or_where($where_colum_or);
		}
		if(isset($order_by) && !empty($order_by)){
		$this->db->order_by($order_by);
		}	
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		return $query->result();
	}
	public function addData($table,$data) {
        $this->db->insert($table, $data);
		// echo $this->db->last_query();die;	

        return $this->db->insert_id() ?: false;
    }
	public function getOneRecord($table,$field, $param, $select_column_name=null) {
		// Turn caching on
	        //$this->db->cache_on();
		$this->db->select($select_column_name);
		$this->db->where($field,$param);
		$this->db->limit(1);// only apply if you have more than same id in your table othre wise comment this line
		$query = $this->db->get($table);
		// echo $this->db->last_query();die;
                if($query->num_rows()>0){
	         return $query->row();
		}
	}
	public function update_entry($table=null, $update_data=array(), $where_conditions=array()){
		// Turn caching off for this one query
		$this->db->cache_off();
		//	print_R($update_data);
		$this->db->update($table, $update_data, $where_conditions);
		// echo $this->db->last_query(); die;	
		return $this->db->affected_rows() == 1 ? true : false ;
	}
	public function deleteWithWhereConditions($table=null, $where_conditions=array()){
		// Turn caching off for this one query
		$this->db->cache_off();
		$this->db->delete($table, $where_conditions);
		return $this->db->affected_rows() == 1 ? true : false ;
	}
	public function getOneRecordWithWhere($table=null,$where_con=array(), $select_column_name=null) {
		// Turn caching on
	  //$this->db->cache_on();
		$this->db->select($select_column_name);
		$this->db->where($where_con);
		$this->db->limit(1);// only apply if you have more than same id in your table othre wise comment this line
		$query = $this->db->get($table);
		//echo $this->db->last_query();
        if($query->num_rows()>0){
			return $query->row();
		}
	}
	public function getCategories(){
		$this->db->select('id, page_title');
		$this->db->from('categories');
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		return $query->result();
	}
	public function getCoursewithdetails(){
		$this->db->select('id, page_title');
		$this->db->from('courses');
		$this->db->where('is_detail', 1); 
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		return $query->result();
	}
	public function checkPostName($table, $post_name,$col, $action, $post_id = null)
	{
		$statusLink = 0;
		$slug = url_title($post_name, 'dash', true);
		
		if ($action == 'add-post') {
			$postDetails = $this->getOneRecord($table, $col, $post_name, 'id');
			if (!empty($postDetails)) {
				$statusLink = 1;
				$slug = '';
			}
		} elseif ($action == 'edit-post' && !empty($post_id)) {
			$where_con = array($col => $post_name, "id !=" => $post_id);
			$postDetails = $this->getOneRecordWithWhere($table, $where_con, 'id');
			if (!empty($postDetails)) {
				$statusLink = 1;
				$slug = '';
			}
		}

		return [
			'dataContent' => $statusLink,
			'slug' => $slug
		];
	}
}