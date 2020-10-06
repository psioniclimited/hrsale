<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class project_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_projects()
	{
	  return $this->db->get("xin_projects");
	}
	 
	 public function read_project_information($id) {
	
		$sql = 'SELECT * FROM xin_projects WHERE project_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function read_bug_information($id) {
	
		$sql = 'SELECT * FROM xin_projects_bugs WHERE bug_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows()> 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	
	// Function to add record in table
	public function add($data){
		$this->db->insert('xin_projects', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('project_id', $id);
		$this->db->delete('xin_projects');
		
	}
	
	// Function to Delete selected record from table
	public function delete_bug_record($id){
		$this->db->where('bug_id', $id);
		$this->db->delete('xin_projects_bugs');
		
	}
	
	// get attachments > projects
	public function get_attachments($id) {
		
		$sql = 'SELECT * FROM xin_projects_attachment WHERE project_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	// get clients projects
	public function get_client_projects($id) {
		
		$sql = 'SELECT * FROM xin_projects WHERE client_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	public function get_all_projects()
	{
	  $query = $this->db->query("SELECT * from xin_projects");
  	  return $query->result();
	}
	
	// Function to add record in table > add attachment
	public function add_new_attachment($data){
		$this->db->insert('xin_projects_attachment', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_attachment_record($id){
		$this->db->where('project_attachment_id', $id);
		$this->db->delete('xin_projects_attachment');
		
	}
	
	// get project discussion
	public function get_discussion($id) {
		
		$sql = 'SELECT * FROM xin_projects_discussion WHERE project_id = ? order by discussion_id desc';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	// get project bugs/issues
	public function get_bug($id) {
		
		$sql = 'SELECT * FROM xin_projects_bugs WHERE project_id = ? order by bug_id desc';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	// Function to add record in table > add discussion
	public function add_discussion($data){
		$this->db->insert('xin_projects_discussion', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to add record in table > add bug
	public function add_bug($data){
		$this->db->insert('xin_projects_bugs', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to update record in table
	public function update_bug($data, $id){
		$this->db->where('bug_id', $id);
		if( $this->db->update('xin_projects_bugs',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('project_id', $id);
		if( $this->db->update('xin_projects',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// get single record > company | projects
	 public function ajax_company_projects($id) {
	
		$sql = 'SELECT * FROM xin_projects WHERE company_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// get total project tasks 
	public function total_project_tasks($id) {
		
		$sql = 'SELECT * FROM xin_tasks WHERE project_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query->num_rows();
	}
	
	// get total project bugs 
	public function total_project_bugs($id) {
		
		$sql = 'SELECT * FROM xin_projects_bugs WHERE project_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query->num_rows();
	}
	
	// get total project files 
	public function total_project_files($id) {
		
		$sql = 'SELECT * FROM xin_projects_attachment WHERE project_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query->num_rows();
	}
	
	// get total project > deffered
	public function deffered_projects() {
		
		$sql = 'SELECT * FROM xin_projects WHERE status = ?';
		$binds = array(3);
		$query = $this->db->query($sql, $binds);
		
		return $query->num_rows();
	}
	
	// get total project > completed
	public function complete_projects() {
		
		$sql = 'SELECT * FROM xin_projects WHERE status = ?';
		$binds = array(2);
		$query = $this->db->query($sql, $binds);
		
		return $query->num_rows();
	}
	
	// get total project > in progress
	public function inprogress_projects() {
		
		$sql = 'SELECT * FROM xin_projects WHERE status = ?';
		$binds = array(1);
		$query = $this->db->query($sql, $binds);
		
		return $query->num_rows();
	}
	
	// get total project > not started
	public function not_started_projects() {
		
		$sql = 'SELECT * FROM xin_projects WHERE status = ?';
		$binds = array(0);
		$query = $this->db->query($sql, $binds);
		
		return $query->num_rows();
	}
		
	//clients // get total project > deffered
	public function deffered_client_projects($id) {
		
		$sql = 'SELECT * FROM xin_projects WHERE status = ? and client_id = ?';
		$binds = array(3,$id);
		$query = $this->db->query($sql, $binds);
		
		return $query->num_rows();
	}
	
	//clients // get total project > completed
	public function complete_client_projects($id) {
		
		$sql = 'SELECT * FROM xin_projects WHERE status = ? and client_id = ?';
		$binds = array(2,$id);
		$query = $this->db->query($sql, $binds);
		
		return $query->num_rows();
	}
	
	//clients // get total project > in progress
	public function inprogress_client_projects($id) {
		
		$sql = 'SELECT * FROM xin_projects WHERE status = ? and client_id = ?';
		$binds = array(1,$id);
		$query = $this->db->query($sql, $binds);
		
		return $query->num_rows();
	}
	
	//clients // get total project > not started
	public function not_started_client_projects($id) {
		
		$sql = 'SELECT * FROM xin_projects WHERE status = ? and client_id = ?';
		$binds = array(0,$id);
		$query = $this->db->query($sql, $binds);
		
		return $query->num_rows();
	}
	
	// get all project tasks>completed
	public function completed_project_bugs($id) {
	
		$sql = 'SELECT * FROM xin_projects_bugs WHERE project_id = ? and status = ?';
		$binds = array($id,1);
		$query = $this->db->query($sql, $binds);
		
		$cTasks = $query->num_rows();
		$pQuery = $this->total_project_bugs($id);
		if($pQuery==0) {
			return $ctTasks = 0;
		} else {
			// get actual data
			$calTasks = $cTasks / $pQuery * 100;
			$ctTasks = round($calTasks);
			return $ctTasks;
		}
	}

	// get all project tasks>completed
	public function completed_project_tasks($id) {
	  
		$sql = 'SELECT * FROM xin_tasks WHERE project_id = ? and task_status = ?';
		$binds = array($id,2);
		$query = $this->db->query($sql, $binds);
		
		$cTasks = $query->num_rows();
		$pQuery = $this->total_project_tasks($id);
		if($pQuery==0) {
			return $ctTasks = 0;
		} else {
			// get actual data
			$calTasks = $cTasks / $pQuery * 100;
			$ctTasks = round($calTasks);
			return $ctTasks;
		}
	}
	// get company projects
	public function get_company_projects($company_id) {
	
		$sql = 'SELECT * FROM xin_projects WHERE company_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	// get employee projects
	public function get_employee_projects($id) {
	
		$sql = "SELECT * FROM `xin_projects` where assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'";
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
}
?>