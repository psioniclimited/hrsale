<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
 	// get all employes
	public function get_employees() {
	  return $this->db->get("xin_employees");
	}
	// get all employes > not super admin
	public function get_employees_for_other($cid) {
		
		$sql = 'SELECT * FROM xin_employees WHERE user_id != ? and company_id = ?';
		$binds = array(1,$cid);
		$query = $this->db->query($sql, $binds);
	    return $query;
	}
	// get all employes|company>
	public function get_company_employees_flt($cid) {
		
		$sql = 'SELECT * FROM xin_employees WHERE company_id = ?';
		$binds = array($cid);
		$query = $this->db->query($sql, $binds);
	    return $query;
	}
	// get all employes>company|location >
	public function get_company_location_employees_flt($cid,$lid) {
		
		$sql = 'SELECT * FROM xin_employees WHERE company_id = ? and location_id = ?';
		$binds = array($cid,$lid);
		$query = $this->db->query($sql, $binds);
	    return $query;
	}
	// get all employes>company|location|department >
	public function get_company_location_department_employees_flt($cid,$lid,$dep_id) {
		
		$sql = 'SELECT * FROM xin_employees WHERE company_id = ? and location_id = ? and department_id = ?';
		$binds = array($cid,$lid,$dep_id);
		$query = $this->db->query($sql, $binds);
	    return $query;
	}
	// get all employes>company|location|department|designation >
	public function get_company_location_department_designation_employees_flt($cid,$lid,$dep_id,$des_id) {
		
		$sql = 'SELECT * FROM xin_employees WHERE company_id = ? and location_id = ? and department_id = ? and designation_id = ?';
		$binds = array($cid,$lid,$dep_id,$des_id);
		$query = $this->db->query($sql, $binds);
	    return $query;
	}
	// get all employes >
	public function get_employees_payslip() {
		
		$sql = 'SELECT * FROM xin_employees WHERE user_role_id != ?';
		$binds = array(1);
		$query = $this->db->query($sql, $binds);
	    return $query;
	}
	
	// get employes
	public function get_attendance_employees() {
		
		$sql = 'SELECT * FROM xin_employees WHERE is_active = ?';
		$binds = array(1);
		$query = $this->db->query($sql, $binds);
		
	    return $query;
	}
	
	// get total number of employees
	public function get_total_employees() {
	  $query = $this->db->get("xin_employees");
	  return $query->num_rows();
	}
		 
	 public function read_employee_information($id) {
	
		$sql = 'SELECT * FROM xin_employees WHERE user_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	// check employeeID
	public function check_employee_id($id) {
	
		$sql = 'SELECT * FROM xin_employees WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}	
	// check username
	public function check_employee_username($id) {
	
		$sql = 'SELECT * FROM xin_employees WHERE username = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}
	// check email
	public function check_employee_email($id) {
	
		$sql = 'SELECT * FROM xin_employees WHERE email = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}
	
	// Function to add record in table
	public function add($data){
		$this->db->insert('xin_employees', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('user_id', $id);
		$this->db->delete('xin_employees');
		
	}
	
	/*  Update Employee Record */
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('xin_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > basic_info
	public function basic_info($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('xin_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > change_password
	public function change_password($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('xin_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > social_info
	public function social_info($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('xin_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > profile picture
	public function profile_picture($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('xin_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > contact_info
	public function contact_info_add($data){
		$this->db->insert('xin_employee_contacts', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > contact_info
	public function contact_info_update($data, $id){
		$this->db->where('contact_id', $id);
		if( $this->db->update('xin_employee_contacts',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > document_info_update
	public function document_info_update($data, $id){
		$this->db->where('document_id', $id);
		if( $this->db->update('xin_employee_documents',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > document_info_update
	public function img_document_info_update($data, $id){
		$this->db->where('immigration_id', $id);
		if( $this->db->update('xin_employee_immigration',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > document info
	public function document_info_add($data){
		$this->db->insert('xin_employee_documents', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > immigration info
	public function immigration_info_add($data){
		$this->db->insert('xin_employee_immigration', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	
	// Function to add record in table > qualification_info_add
	public function qualification_info_add($data){
		$this->db->insert('xin_employee_qualification', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > qualification_info_update
	public function qualification_info_update($data, $id){
		$this->db->where('qualification_id', $id);
		if( $this->db->update('xin_employee_qualification',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > work_experience_info_add
	public function work_experience_info_add($data){
		$this->db->insert('xin_employee_work_experience', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > work_experience_info_update
	public function work_experience_info_update($data, $id){
		$this->db->where('work_experience_id', $id);
		if( $this->db->update('xin_employee_work_experience',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > bank_account_info_add
	public function bank_account_info_add($data){
		$this->db->insert('xin_employee_bankaccount', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > bank_account_info_update
	public function bank_account_info_update($data, $id){
		$this->db->where('bankaccount_id', $id);
		if( $this->db->update('xin_employee_bankaccount',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > contract_info_add
	public function contract_info_add($data){
		$this->db->insert('xin_employee_contract', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	//for current contact > employee
	public function check_employee_contact_current($id) {
	   
	    $sql = 'SELECT * FROM xin_employee_contacts WHERE employee_id = ? and contact_type = ? limit 1';
		$binds = array($id,'current');
		$query = $this->db->query($sql, $binds);
	
		return $query;		
	}
	
	//for permanent contact > employee
	public function check_employee_contact_permanent($id) {
	
		$sql = 'SELECT * FROM xin_employee_contacts WHERE employee_id = ? and contact_type = ? limit 1';
		$binds = array($id,'permanent');
		$query = $this->db->query($sql, $binds);
		
		return $query;		
	}
	
	// get current contacts by id
	 public function read_contact_info_current($id) {
	
		$sql = 'SELECT * FROM xin_employee_contacts WHERE contact_id = ? and contact_type = ? limit 1';
		$binds = array($id,'current');
		$query = $this->db->query($sql, $binds);
	
		$row = $query->row();
		return $row;
		
	}
	
	// get permanent contacts by id
	 public function read_contact_info_permanent($id) {
	
		$sql = 'SELECT * FROM xin_employee_contacts WHERE contact_id = ? and contact_type = ? limit 1';
		$binds = array($id,'permanent');
		$query = $this->db->query($sql, $binds);
		
		$row = $query->row();
		return $row;
	}
	
	// Function to update record in table > contract_info_update
	public function contract_info_update($data, $id){
		$this->db->where('contract_id', $id);
		if( $this->db->update('xin_employee_contract',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > leave_info_add
	public function leave_info_add($data){
		$this->db->insert('xin_employee_leave', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	// Function to update record in table > leave_info_update
	public function leave_info_update($data, $id){
		$this->db->where('leave_id', $id);
		if( $this->db->update('xin_employee_leave',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > shift_info_add
	public function shift_info_add($data){
		$this->db->insert('xin_employee_shift', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > shift_info_update
	public function shift_info_update($data, $id){
		$this->db->where('emp_shift_id', $id);
		if( $this->db->update('xin_employee_shift',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > location_info_add
	public function location_info_add($data){
		$this->db->insert('xin_employee_location', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > location_info_update
	public function location_info_update($data, $id){
		$this->db->where('office_location_id', $id);
		if( $this->db->update('xin_employee_location',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// get all office shifts 
	public function all_office_shifts() {
	  $query = $this->db->query("SELECT * from xin_office_shift");
  	  return $query->result();
	}
		
	// get contacts
	public function set_employee_contacts($id) {
		
		$sql = 'SELECT * FROM xin_employee_contacts WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	    return $query;
	}
	
	// get documents
	public function set_employee_documents($id) {
	
		$sql = 'SELECT * FROM xin_employee_documents WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	    return $query;
	}
	
	// get immigration
	public function set_employee_immigration($id) {
	
		$sql = 'SELECT * FROM xin_employee_immigration WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	 	return $query;
	}
	
	// get employee qualification
	public function set_employee_qualification($id) {
	
		$sql = 'SELECT * FROM xin_employee_qualification WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	    return $query;
	}
	
	// get employee work experience
	public function set_employee_experience($id) {
	
		$sql = 'SELECT * FROM xin_employee_work_experience WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);

	    return $query;
	}
	
	// get employee bank account
	public function set_employee_bank_account($id) {
	
		$sql = 'SELECT * FROM xin_employee_bankaccount WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	// get employee bank account > Last
	 public function get_employee_bank_account_last($id) {
	
		$sql = 'SELECT * FROM xin_employee_bankaccount WHERE employee_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	// get employee contract
	public function set_employee_contract($id) {
	
		$sql = 'SELECT * FROM xin_employee_contract WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	 	return $query;
	}
	
	// get employee office shift
	public function set_employee_shift($id) {
	
		$sql = 'SELECT * FROM xin_employee_shift WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	
	// get employee leave
	public function set_employee_leave($id) {
	
		$sql = 'SELECT * FROM xin_employee_leave WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	// get employee location
	public function set_employee_location($id) {
	
		$sql = 'SELECT * FROM xin_employee_location WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);

	  	return $query;
	}
	
	 // get document type by id
	 public function read_document_type_information($id) {
	
		$sql = 'SELECT * FROM xin_document_type WHERE document_type_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// contract type
	public function read_contract_type_information($id) {
	
		$sql = 'SELECT * FROM xin_contract_type WHERE contract_type_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// contract employee
	public function read_contract_information($id) {
	
		$sql = 'SELECT * FROM xin_employee_contract WHERE contract_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// office shift
	public function read_shift_information($id) {
	
		$sql = 'SELECT * FROM xin_office_shift WHERE office_shift_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	

	
	// get all contract types
	public function all_contract_types() {
	  $query = $this->db->query("SELECT * from xin_contract_type");
  	  return $query->result();
	}
	
	// get all contracts
	public function all_contracts() {
	  $query = $this->db->query("SELECT * from xin_employee_contract");
  	  return $query->result();
	}
	
	// get all document types
	public function all_document_types() {
	  $query = $this->db->query("SELECT * from xin_document_type");
  	  return $query->result();
	}
	
	// get all education level
	public function all_education_level() {
	  $query = $this->db->query("SELECT * from xin_qualification_education_level");
  	  return $query->result();
	}
	
	// get education level by id
	 public function read_education_information($id) {
	
		$sql = 'SELECT * FROM xin_qualification_education_level WHERE education_level_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// get all qualification languages
	public function all_qualification_language() {
	  $query = $this->db->query("SELECT * from xin_qualification_language");
  	  return $query->result();
	}
	
	// get languages by id
	 public function read_qualification_language_information($id) {
	
		$sql = 'SELECT * FROM xin_qualification_language WHERE language_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// get all qualification skills
	public function all_qualification_skill() {
	  $query = $this->db->query("SELECT * from xin_qualification_skill");
  	  return $query->result();
	} 
	
	// get qualification by id
	 public function read_qualification_skill_information($id) {
	
		$sql = 'SELECT * FROM xin_qualification_skill WHERE skill_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// get contacts by id
	 public function read_contact_information($id) {
	
		$sql = 'SELECT * FROM xin_employee_contacts WHERE contact_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
				
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// get documents by id
	 public function read_document_information($id) {
	
		$sql = 'SELECT * FROM xin_employee_documents WHERE document_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// get documents by id
	 public function read_imgdocument_information($id) {
	
		$sql = 'SELECT * FROM xin_employee_immigration WHERE immigration_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// get qualifications by id
	 public function read_qualification_information($id) {
	
		$sql = 'SELECT * FROM xin_employee_qualification WHERE qualification_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// get qualifications by id
	 public function read_work_experience_information($id) {
	
		$sql = 'SELECT * FROM xin_employee_work_experience WHERE work_experience_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// get bank account by id
	 public function read_bank_account_information($id) {
	
		$sql = 'SELECT * FROM xin_employee_bankaccount WHERE bankaccount_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// get leave by id
	 public function read_leave_information($id) {
	
		$sql = 'SELECT * FROM xin_employee_leave WHERE leave_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
		
	// get shift by id
	 public function read_emp_shift_information($id) {
	
		$sql = 'SELECT * FROM xin_employee_shift WHERE emp_shift_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_contact_record($id){
		$this->db->where('contact_id', $id);
		$this->db->delete('xin_employee_contacts');
		
	}
	
	// Function to Delete selected record from table
	public function delete_document_record($id){
		$this->db->where('document_id', $id);
		$this->db->delete('xin_employee_documents');
		
	}
	
	// Function to Delete selected record from table
	public function delete_imgdocument_record($id){
		$this->db->where('immigration_id', $id);
		$this->db->delete('xin_employee_immigration');
		
	}
	
	// Function to Delete selected record from table
	public function delete_qualification_record($id){
		$this->db->where('qualification_id', $id);
		$this->db->delete('xin_employee_qualification');
		
	}
	
	// Function to Delete selected record from table
	public function delete_work_experience_record($id){
		$this->db->where('work_experience_id', $id);
		$this->db->delete('xin_employee_work_experience');
		
	}
	
	// Function to Delete selected record from table
	public function delete_bank_account_record($id){
		$this->db->where('bankaccount_id', $id);
		$this->db->delete('xin_employee_bankaccount');
		
	}
	
	// Function to Delete selected record from table
	public function delete_contract_record($id){
		$this->db->where('contract_id', $id);
		$this->db->delete('xin_employee_contract');
		
	}
	
	// Function to Delete selected record from table
	public function delete_leave_record($id){
		$this->db->where('leave_id', $id);
		$this->db->delete('xin_employee_leave');
		
	}
	
	// Function to Delete selected record from table
	public function delete_shift_record($id){
		$this->db->where('emp_shift_id', $id);
		$this->db->delete('xin_employee_shift');
		
	}
	
	// Function to Delete selected record from table
	public function delete_location_record($id){
		$this->db->where('office_location_id', $id);
		$this->db->delete('xin_employee_location');
		
	}
	
	// get location by id
	 public function read_location_information($id) {
	
		$sql = 'SELECT * FROM xin_employee_location WHERE office_location_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function record_count() {
        return $this->db->count_all("xin_employees");
    }
	// read filter record
	public function record_count_company_employees($cid) {
	
		$sql = 'SELECT * FROM xin_employees WHERE company_id = ?';
		$binds = array($cid);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}
	// read filter record
	public function record_count_company_location_employees($cid,$lid) {
	
		$sql = 'SELECT * FROM xin_employees WHERE company_id = ? and location_id= ?';
		$binds = array($cid,$lid);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}
	// read filter record
	public function record_count_company_location_department_employees($cid,$lid,$dep_id) {
	
		$sql = 'SELECT * FROM xin_employees WHERE company_id = ? and location_id= ? and department_id= ?';
		$binds = array($cid,$lid,$dep_id);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}
	// read filter record
	public function record_count_company_location_department_designation_employees($cid,$lid,$dep_id,$des_id) {
	
		$sql = 'SELECT * FROM xin_employees WHERE company_id = ? and location_id= ? and department_id= ? and designation_id= ?';
		$binds = array($cid,$lid,$dep_id,$des_id);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}

    public function fetch_all_employees($limit, $start) {
		$session = $this->session->userdata('username');
        $this->db->limit($limit, $start);
		$this->db->order_by("designation_id asc");
		//$this->db->where("user_role_id!=",1);
		$user_info = $this->Xin_model->read_user_info($session['user_id']);
		if($user_info[0]->user_role_id!=1){
			$this->db->where("company_id=",$user_info[0]->company_id);
		}
        $query = $this->db->get("xin_employees");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   // get company employees
   public function fetch_all_company_employees_flt($limit, $start,$cid) {
		$session = $this->session->userdata('username');
        $this->db->limit($limit, $start);
		$this->db->order_by("designation_id asc");
		$this->db->where("company_id=",$cid);
        $query = $this->db->get("xin_employees");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   // get company|location employees
   public function fetch_all_company_location_employees_flt($limit, $start,$cid,$lid) {
		$session = $this->session->userdata('username');
        $this->db->limit($limit, $start);
		$this->db->order_by("designation_id asc");
		$this->db->where("company_id=",$cid);
		$this->db->where("location_id=",$lid);
        $query = $this->db->get("xin_employees");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   // get company|location|department employees
   public function fetch_all_company_location_department_employees_flt($limit, $start,$cid,$lid,$dep_id) {
		$session = $this->session->userdata('username');
        $this->db->limit($limit, $start);
		$this->db->order_by("designation_id asc");
		$this->db->where("company_id=",$cid);
		$this->db->where("location_id=",$lid);
		$this->db->where("department_id=",$dep_id);
        $query = $this->db->get("xin_employees");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   // get company|location|department|designation employees
   public function fetch_all_company_location_department_designation_employees_flt($limit, $start,$cid,$lid,$dep_id,$des_id) {
		$session = $this->session->userdata('username');
        $this->db->limit($limit, $start);
		$this->db->order_by("designation_id asc");
		$this->db->where("company_id=",$cid);
		$this->db->where("location_id=",$lid);
		$this->db->where("department_id=",$dep_id);
		$this->db->where("designation_id=",$des_id);
        $query = $this->db->get("xin_employees");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   public function des_fetch_all_employees($limit, $start) {
       // $this->db->limit($limit, $start);
		
		$sql = 'SELECT * FROM xin_employees order by designation_id asc limit ?, ?';
		$binds = array($limit,$start);
		$query = $this->db->query($sql, $binds);
		
      //  $query = $this->db->get("xin_employees");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   // get employee allowances
	public function set_employee_allowances($id) {
	
		$sql = 'SELECT * FROM xin_salary_allowances WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	// get employee commissions
	public function set_employee_commissions($id) {
	
		$sql = 'SELECT * FROM xin_salary_commissions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	// get employee statutory deductions
	public function set_employee_statutory_deductions($id) {
	
		$sql = 'SELECT * FROM xin_salary_statutory_deductions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	// get employee other payments
	public function set_employee_other_payments($id) {
	
		$sql = 'SELECT * FROM xin_salary_other_payments WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	// get employee overtime
	public function set_employee_overtime($id) {
	
		$sql = 'SELECT * FROM xin_salary_overtime WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	
	// get employee allowances
	public function set_employee_deductions($id) {
	
		$sql = 'SELECT * FROM xin_salary_loan_deductions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	//-- payslip data
	// get employee allowances
	public function set_employee_allowances_payslip($id) {
	
		$sql = 'SELECT * FROM xin_salary_payslip_allowances WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	// get employee commissions
	public function set_employee_commissions_payslip($id) {
	
		$sql = 'SELECT * FROM xin_salary_payslip_commissions WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	// get employee other payments
	public function set_employee_other_payments_payslip($id) {
	
		$sql = 'SELECT * FROM xin_salary_payslip_other_payments WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	// get employee statutory_deductions
	public function set_employee_statutory_deductions_payslip($id) {
	
		$sql = 'SELECT * FROM xin_salary_payslip_statutory_deductions WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	// get employee overtime
	public function set_employee_overtime_payslip($id) {
	
		$sql = 'SELECT * FROM xin_salary_payslip_overtime WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	
	// get employee allowances
	public function set_employee_deductions_payslip($id) {
	
		$sql = 'SELECT * FROM xin_salary_payslip_loan WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	//------
	// get employee allowances
	public function count_employee_allowances_payslip($id) {
	
		$sql = 'SELECT * FROM xin_salary_payslip_allowances WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	// get employee commissions
	public function count_employee_commissions_payslip($id) {
	
		$sql = 'SELECT * FROM xin_salary_payslip_commissions WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	// get employee statutory_deductions
	public function count_employee_statutory_deductions_payslip($id) {
	
		$sql = 'SELECT * FROM xin_salary_payslip_statutory_deductions WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	// get employee other payments
	public function count_employee_other_payments_payslip($id) {
	
		$sql = 'SELECT * FROM xin_salary_payslip_other_payments WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	// get employee overtime
	public function count_employee_overtime_payslip($id) {
	
		$sql = 'SELECT * FROM xin_salary_payslip_overtime WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	
	// get employee allowances
	public function count_employee_deductions_payslip($id) {
	
		$sql = 'SELECT * FROM xin_salary_payslip_loan WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	//////////////////////
	// get employee allowances
	public function count_employee_allowances($id) {
	
		$sql = 'SELECT * FROM xin_salary_allowances WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	// get employee commissions
	public function count_employee_commissions($id) {
	
		$sql = 'SELECT * FROM xin_salary_commissions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	// get employee other payments
	public function count_employee_other_payments($id) {
	
		$sql = 'SELECT * FROM xin_salary_other_payments WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	// get employee statutory deduction
	public function count_employee_statutory_deductions($id) {
	
		$sql = 'SELECT * FROM xin_salary_statutory_deductions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	// get employee overtime
	public function count_employee_overtime($id) {
	
		$sql = 'SELECT * FROM xin_salary_overtime WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	
	// get employee allowances
	public function count_employee_deductions($id) {
	
		$sql = 'SELECT * FROM xin_salary_loan_deductions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	
	// get employee salary allowances
	public function read_salary_allowances($id) {
	
		$sql = 'SELECT * FROM xin_salary_allowances WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	// get employee salary commissions
	public function read_salary_commissions($id) {
	
		$sql = 'SELECT * FROM xin_salary_commissions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	// get employee salary other payments
	public function read_salary_other_payments($id) {
	
		$sql = 'SELECT * FROM xin_salary_other_payments WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	// get employee statutory deductions
	public function read_salary_statutory_deductions($id) {
	
		$sql = 'SELECT * FROM xin_salary_statutory_deductions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	// get employee overtime
	public function read_salary_overtime($id) {
	
		$sql = 'SELECT * FROM xin_salary_overtime WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	// get employee salary loan_deduction
	public function read_salary_loan_deductions($id) {
	
		$sql = 'SELECT * FROM xin_salary_loan_deductions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	// get employee salary loan_deduction
	public function read_single_loan_deductions($id) {
	
		$sql = 'SELECT * FROM xin_salary_loan_deductions WHERE loan_deduction_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	//Calculates how many months is past between two timestamps.
	public function get_month_diff($start, $end = FALSE) {
		$end OR $end = time();
		$start = new DateTime($start);
		$end   = new DateTime($end);
		$diff  = $start->diff($end);
		return $diff->format('%y') * 12 + $diff->format('%m');
	}
	// get employee salary allowances
	public function read_single_salary_allowance($id) {
	
		$sql = 'SELECT * FROM xin_salary_allowances WHERE allowance_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	// get employee commissions
	public function read_single_salary_commissions($id) {
	
		$sql = 'SELECT * FROM xin_salary_commissions WHERE salary_commissions_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	// get
	public function read_single_salary_statutory_deduction($id) {
	
		$sql = 'SELECT * FROM xin_salary_statutory_deductions WHERE statutory_deductions_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	public function read_single_salary_other_payment($id) {
	
		$sql = 'SELECT * FROM xin_salary_other_payments WHERE other_payments_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	// get employee overtime record
	public function read_salary_overtime_record($id) {
	
		$sql = 'SELECT * FROM xin_salary_overtime WHERE salary_overtime_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// Function to add record in table > allowance
	public function add_salary_allowances($data){
		$this->db->insert('xin_salary_allowances', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	// Function to add record in table > commissions
	public function add_salary_commissions($data){
		$this->db->insert('xin_salary_commissions', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	// Function to add record in table > statutory_deductions
	public function add_salary_statutory_deductions($data){
		$this->db->insert('xin_salary_statutory_deductions', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	// Function to add record in table > other payments
	public function add_salary_other_payments($data){
		$this->db->insert('xin_salary_other_payments', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	// Function to add record in table > loan
	public function add_salary_loan($data){
		$this->db->insert('xin_salary_loan_deductions', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	// Function to add record in table > overtime
	public function add_salary_overtime($data){
		$this->db->insert('xin_salary_overtime', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	// Function to Delete selected record from table
	public function delete_allowance_record($id){
		$this->db->where('allowance_id', $id);
		$this->db->delete('xin_salary_allowances');
		
	}
	// Function to Delete selected record from table
	public function delete_commission_record($id){
		$this->db->where('salary_commissions_id', $id);
		$this->db->delete('xin_salary_commissions');
		
	}
	// Function to Delete selected record from table
	public function delete_statutory_deductions_record($id){
		$this->db->where('statutory_deductions_id', $id);
		$this->db->delete('xin_salary_statutory_deductions');
		
	}
	// Function to Delete selected record from table
	public function delete_other_payments_record($id){
		$this->db->where('other_payments_id', $id);
		$this->db->delete('xin_salary_other_payments');
		
	}
	// Function to Delete selected record from table
	public function delete_loan_record($id){
		$this->db->where('loan_deduction_id', $id);
		$this->db->delete('xin_salary_loan_deductions');
		
	}
	// Function to Delete selected record from table
	public function delete_overtime_record($id){
		$this->db->where('salary_overtime_id', $id);
		$this->db->delete('xin_salary_overtime');
		
	}
	// Function to update record in table > update allowance record
	public function salary_allowance_update_record($data, $id){
		$this->db->where('allowance_id', $id);
		if( $this->db->update('xin_salary_allowances',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	// Function to update record in table >
	public function salary_commissions_update_record($data, $id){
		$this->db->where('salary_commissions_id', $id);
		if( $this->db->update('xin_salary_commissions',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	// Function to update record in table >
	public function salary_statutory_deduction_update_record($data, $id){
		$this->db->where('statutory_deductions_id', $id);
		if( $this->db->update('xin_salary_statutory_deductions',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	// Function to update record in table >
	public function salary_other_payment_update_record($data, $id){
		$this->db->where('other_payments_id', $id);
		if( $this->db->update('xin_salary_other_payments',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	// Function to update record in table > update allowance record
	public function salary_loan_update_record($data, $id){
		$this->db->where('loan_deduction_id', $id);
		if( $this->db->update('xin_salary_loan_deductions',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	// Function to update record in table > update allowance record
	public function salary_overtime_update_record($data, $id){
		$this->db->where('salary_overtime_id', $id);
		if( $this->db->update('xin_salary_overtime',$data)) {
			return true;
		} else {
			return false;
		}		
	}
}
?>