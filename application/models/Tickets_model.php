<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_tickets() {
	  return $this->db->get("xin_support_tickets");
	}
	 
	 public function read_ticket_information($id) {
	
		$sql = 'SELECT * FROM xin_support_tickets WHERE ticket_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	
	// Function to add record in table
	public function add($data){
		$this->db->insert('xin_support_tickets', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	
	// Function to add record in table
	public function add_comment($data){
		$this->db->insert('xin_tickets_comments', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to add record in table
	public function add_new_attachment($data){
		$this->db->insert('xin_tickets_attachment', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('ticket_id', $id);
		$this->db->delete('xin_support_tickets');
		
	}
	
	// Function to Delete selected record from table
	public function delete_comment_record($id){
		$this->db->where('comment_id', $id);
		$this->db->delete('xin_tickets_comments');
		
	}
	
	// Function to Delete selected record from table
	public function delete_attachment_record($id){
		$this->db->where('ticket_attachment_id', $id);
		$this->db->delete('xin_tickets_attachment');
		
	}
	
	public function get_employee_tickets($id) {
	 	
		$sql = 'SELECT * FROM xin_support_tickets WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	public function get_company_tickets($id) {
	 	
		$sql = 'SELECT * FROM xin_support_tickets WHERE company_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('ticket_id', $id);
		if( $this->db->update('xin_support_tickets',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table
	public function assign_ticket_user($data, $id){
		$this->db->where('ticket_id', $id);
		if( $this->db->update('xin_support_tickets',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table
	public function update_status($data, $id){
		$this->db->where('ticket_id', $id);
		if( $this->db->update('xin_support_tickets',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table
	public function update_note($data, $id){
		$this->db->where('ticket_id', $id);
		if( $this->db->update('xin_support_tickets',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// get comments
	public function get_comments($id) {
	
		$sql = 'SELECT * FROM xin_tickets_comments WHERE ticket_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	// get attachments
	public function get_attachments($id) {
	
		$sql = 'SELECT * FROM xin_tickets_attachment WHERE ticket_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	// get all ticket users
	public function read_ticket_users_information($id) {
	
		$sql = 'SELECT * FROM xin_support_tickets WHERE ticket_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query->result();
	}
}
?>