<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class performance_indicator_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_performance_indicator()
	{
	  return $this->db->get("xin_performance_indicator");
	}
	 
	 public function read_performance_indicator_information($id) {
	
		$sql = 'SELECT * FROM xin_performance_indicator WHERE performance_indicator_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	public function get_designation_performance_indicator($id) {
	 	
		$sql = 'SELECT * FROM xin_performance_indicator WHERE designation_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	public function get_company_performance_indicator($id) {
	 	
		$sql = 'SELECT * FROM xin_performance_indicator WHERE company_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	// Function to add record in table
	public function add($data){
		$this->db->insert('xin_performance_indicator', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('performance_indicator_id', $id);
		$this->db->delete('xin_performance_indicator');
		
	}
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('performance_indicator_id', $id);
		if( $this->db->update('xin_performance_indicator',$data)) {
			return true;
		} else {
			return false;
		}		
	}
}
?>