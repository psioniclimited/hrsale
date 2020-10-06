<?php
/* Employee Details view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $system = $this->Xin_model->read_setting_info(1);?>
<?php //$default_currency = $this->Xin_model->read_currency_con_info($system[0]->default_currency_id);?>
<?php
$eid = $this->uri->segment(4);
$eresult = $this->Employees_model->read_employee_information($eid);
?>
<?php
$ar_sc = explode('- ',$system[0]->default_currency_symbol);
$sc_show = $ar_sc[1];
?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>
<?php $leave_categories_ids = explode(',',$leave_categories);?>
<?php $view_companies_ids = explode(',',$view_companies_id);?>
<?php $user_info = $this->Xin_model->read_user_info($session['user_id']);?>
<?php $role_resources_ids = $this->Xin_model->user_role_resource(); ?>
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom mb-4">
      <ul class="nav nav-tabs">
        <li class="nav-item active"> <a class="nav-link active show" data-toggle="tab" href="#xin_general"><?php echo $this->lang->line('xin_general');?></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#xin_profile_picture"><?php echo $this->lang->line('xin_e_details_profile_picture');?></a> </li>
        <?php if(in_array('351',$role_resources_ids)) {?>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#xin_employee_set_salary"><?php echo $this->lang->line('xin_employee_set_salary');?></a> </li>
        <?php }?>
      </ul>
      <div class="tab-content">
        <div class="tab-pane <?php echo $get_animate;?> active" id="xin_general">
          <div class="card-body">
            <div class="card overflow-hidden">
              <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                  <div class="list-group list-group-flush account-settings-links"> <a class="list-group-item list-group-item-action  nav-tabs-link active" data-toggle="list" href="javascript:void(0);" data-profile="1" data-profile-block="user_basic_info" aria-expanded="true" id="user_profile_1"><?php echo $this->lang->line('xin_e_details_basic');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="2" data-profile-block="immigration" aria-expanded="true" id="user_profile_2"><?php echo $this->lang->line('xin_employee_immigration');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="3" data-profile-block="contacts" aria-expanded="true" id="user_profile_3"><?php echo $this->lang->line('xin_employee_emergency_contacts');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="4" data-profile-block="social-networking" aria-expanded="true" id="user_profile_4"><?php echo $this->lang->line('xin_e_details_social');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="5" data-profile-block="documents" aria-expanded="true" id="user_profile_5"><?php echo $this->lang->line('xin_e_details_document');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="6" data-profile-block="qualification" aria-expanded="true" id="user_profile_6"><?php echo $this->lang->line('xin_e_details_qualification');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="7" data-profile-block="work-experience" aria-expanded="true" id="user_profile_7"><?php echo $this->lang->line('xin_e_details_w_experience');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="8" data-profile-block="bank-account" aria-expanded="true" id="user_profile_8"><?php echo $this->lang->line('xin_e_details_baccount');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="9" data-profile-block="change-password" aria-expanded="true" id="user_profile_9"><?php echo $this->lang->line('xin_e_details_cpassword');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="10" data-profile-block="leave" aria-expanded="true" id="user_profile_10"><?php echo $this->lang->line('xin_e_details_leave');?></a> </div>
                </div>
                <div class="col-md-9">
                  <div class="tab-content">
                    <div class="tab-pane active current-tab <?php echo $get_animate;?>" id="user_basic_info">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_e_details_basic_info');?> </h3>
                      </div>
                      <div class="box-body">
                        <?php $attributes = array('name' => 'basic_info', 'id' => 'basic_info', 'autocomplete' => 'off');?>
                        <?php $hidden = array('user_id' => $user_id, 'u_basic_info' => 'UPDATE');?>
                        <?php echo form_open_multipart('admin/employees/basic_info', $attributes, $hidden);?>
                        <div class="bg-white">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="first_name"><?php echo $this->lang->line('xin_employee_first_name');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_employee_first_name');?>" name="first_name" type="text" value="<?php echo $first_name;?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="last_name" class="control-label"><?php echo $this->lang->line('xin_employee_last_name');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_employee_last_name');?>" name="last_name" type="text" value="<?php echo $last_name;?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="employee_id"><?php echo $this->lang->line('dashboard_employee_id');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_employee_id');?>" name="employee_id" type="text" value="<?php echo $employee_id;?>">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="username"><?php echo $this->lang->line('dashboard_username');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_username');?>" name="username" type="text" value="<?php echo $username;?>">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="email" class="control-label"><?php echo $this->lang->line('dashboard_email');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_email');?>" name="email" type="text" value="<?php echo $email;?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                          <?php if($user_info[0]->user_role_id==1){ ?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="first_name"><?php echo $this->lang->line('left_company');?></label>
                                <select class="form-control" name="company_id" id="aj_company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('left_company');?>">
                                  <option value=""></option>
                                  <?php foreach($get_all_companies as $company) {?>
                                  <option value="<?php echo $company->company_id?>" <?php if($company_id==$company->company_id):?> selected="selected"<?php endif;?>><?php echo $company->name?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <?php } else {?>
                            <?php $ecompany_id = $user_info[0]->company_id;?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="first_name"><?php echo $this->lang->line('left_company');?></label>
                                <select class="form-control" name="company_id" id="aj_company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('left_company');?>">
                                  <option value=""></option>
                                  <?php foreach($get_all_companies as $company) {?>
									  <?php if($ecompany_id == $company->company_id):?>
                                      <option value="<?php echo $company->company_id?>" <?php if($company_id==$company->company_id):?> selected="selected"<?php endif;?>><?php echo $company->name?></option>
                                      <?php endif; ?>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <?php } ?>
                            <?php $colmd=4;
								if($system[0]->is_active_sub_departments=='yes'){
									$colmd=4;
									$is_id= 'aj_subdepartments';
								} else {
									$colmd=4;
									$is_id= 'is_aj_subdepartments';
								}?>
                            <?php //$eall_departments = $this->Company_model->ajax_company_departments_info($company_id);?>
                            <?php $el_result = $this->Department_model->ajax_company_location_information($company_id);?>
                            <?php $eall_departments = $this->Department_model->ajax_location_departments_information($location_id);?>
                            <div class="col-md-4" id="location_ajax">
                            <div class="form-group">
                              <label for="name"><?php echo $this->lang->line('left_location');?></label>
                              <select name="location_id" id="location_id" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('left_location');?>">
                                <?php foreach($el_result as $location) {?>
                                <option value="<?php echo $location->location_id?>"><?php echo $location->location_name?></option>
                                <?php } ?>
                              </select>
                            </div>
                            </div>
                            <div class="col-md-<?php echo $colmd;?>">
                              <div class="form-group" id="department_ajax">
                                <label for="department"><?php echo $this->lang->line('xin_employee_department');?></label>
                                <select class="form-control" name="department_id" id="<?php echo $is_id;?>" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_employee_department');?>">
                                  <option value=""></option>
                                  <?php foreach($eall_departments as $department) {?>
                                  <option value="<?php echo $department->department_id?>" <?php if($department_id==$department->department_id):?> selected <?php endif;?>><?php echo $department->department_name?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            
                          </div>
                          <?php if($system[0]->is_active_sub_departments=='yes'){?>
                          	<?php $eall_designations = $this->Designation_model->ajax_designation_information($sub_department_id);?>
                          <?php } else {?>
                          	<?php $eall_designations = $this->Designation_model->ajax_is_designation_information($department_id);?>
                          <?php } ?>
                          <div class="row">
                            <?php $colmd=3; if($system[0]->is_active_sub_departments=='yes'){ $ncolmd = 3; } else { $ncolmd = 4;}?>
                            <?php if($system[0]->is_active_sub_departments=='yes'){?>
                            <div class="col-md-<?php echo $ncolmd;?>" id="subdepartment_ajax">
                            <?php $depid = $eresult[0]->department_id; ?>
                            <?php if(!isset($depid)): $depid = 1; else: $depid = $depid; endif;?>
                            <?php $subresult = get_sub_departments($depid);?>
                              <div class="form-group">
                                <label for="designation"><?php echo $this->lang->line('xin_hr_sub_department');?></label>
                                <select class="form-control" name="subdepartment_id" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_employee_department');?>" id="aj_subdepartment">
                                  <option value=""></option>
                                  <?php foreach($subresult as $sbdeparment) {?>
                                  <option value="<?php echo $sbdeparment->sub_department_id;?>" <?php if($sub_department_id==$sbdeparment->sub_department_id):?> selected <?php endif;?>><?php echo $sbdeparment->department_name;?></option>
								  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <?php } else {?>
                            <input type="hidden" name="subdepartment_id" value="0" />
                            <?php } ?>
                            <div class="col-md-<?php echo $ncolmd;?>">
                              <div class="form-group" id="designation_ajax">
                                <label for="designation"><?php echo $this->lang->line('xin_designation');?></label>
                                <select class="form-control" name="designation_id" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_designation');?>">
                                  <option value=""></option>
                                  <?php foreach($eall_designations as $designation) {?>
                                  <option value="<?php echo $designation->designation_id?>" <?php if($designation_id==$designation->designation_id):?> selected <?php endif;?>><?php echo $designation->designation_name?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-<?php echo $ncolmd;?>">
                              <div class="form-group">
                                <label for="date_of_joining" class="control-label"><?php echo $this->lang->line('xin_employee_doj');?></label>
                                <input class="form-control date" readonly placeholder="<?php echo $this->lang->line('xin_employee_doj');?>" name="date_of_joining" type="text" value="<?php echo $date_of_joining;?>">
                              </div>
                            </div>
                            <div class="col-md-<?php echo $ncolmd;?>">
                              <div class="form-group">
                                <label for="date_of_leaving" class="control-label"><?php echo $this->lang->line('xin_employee_dol');?></label>
                                <input class="form-control date" readonly placeholder="<?php echo $this->lang->line('xin_employee_dol');?>" name="date_of_leaving" type="text" value="<?php echo $date_of_leaving;?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="role"><?php echo $this->lang->line('xin_employee_role');?></label>
                                <select class="form-control" name="role" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_employee_role');?>">
                                  <option value=""></option>
                                  <?php foreach($all_user_roles as $role) {?>
                                  <option value="<?php echo $role->role_id?>" <?php if($user_role_id==$role->role_id):?> selected <?php endif;?>><?php echo $role->role_name?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="gender" class="control-label"><?php echo $this->lang->line('xin_employee_gender');?></label>
                                <select class="form-control" name="gender" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_employee_gender');?>">
                                  <option value="Male" <?php if($gender=='Male'):?> selected <?php endif; ?>>Male</option>
                                  <option value="Female" <?php if($gender=='Female'):?> selected <?php endif; ?>>Female</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="marital_status" class="control-label"><?php echo $this->lang->line('xin_employee_mstatus');?></label>
                                <select class="form-control" name="marital_status" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_employee_mstatus');?>">
                                  <option value="Single" <?php if($marital_status=='Single'):?> selected <?php endif; ?>>Single</option>
                                  <option value="Married" <?php if($marital_status=='Married'):?> selected <?php endif; ?>>Married</option>
                                  <option value="Widowed" <?php if($marital_status=='Widowed'):?> selected <?php endif; ?>>Widowed</option>
                                  <option value="Divorced or Separated" <?php if($marital_status=='Divorced or Separated'):?> selected <?php endif; ?>>Divorced or Separated</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="contact_no" class="control-label"><?php echo $this->lang->line('xin_contact_number');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_contact_number');?>" name="contact_no" type="text" value="<?php echo $contact_no;?>">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="status" class="control-label"><?php echo $this->lang->line('dashboard_xin_status');?></label>
                                <select class="form-control" name="status" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('dashboard_xin_status');?>">
                                  <option value="0" <?php if($is_active=='0'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_employees_inactive');?></option>
                                  <option value="1" <?php if($is_active=='1'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_employees_active');?></option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="office_shift_id" class="control-label"><?php echo $this->lang->line('xin_employee_office_shift');?></label>
                                <select class="form-control" name="office_shift_id" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_employee_office_shift');?>">
                                  <?php foreach($all_office_shifts as $shift) {?>
                                  <option value="<?php echo $shift->office_shift_id?>" <?php if($office_shift_id == $shift->office_shift_id):?> selected="selected" <?php endif; ?>><?php echo $shift->shift_name?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                          	<div class="col-md-4">
                              <div class="form-group">
                                <label for="date_of_birth"><?php echo $this->lang->line('xin_employee_dob');?></label>
                                <input class="form-control date" readonly placeholder="<?php echo $this->lang->line('xin_employee_dob');?>" name="date_of_birth" type="text" value="<?php echo $date_of_birth;?>">
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="xin_hr_leave_cat"><?php echo $this->lang->line('xin_hr_leave_cat');?></label>
                                <input type="hidden" name="leave_categories[]" value="0" />
                                <select multiple="multiple" class="form-control" name="leave_categories[]" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_hr_leave_cat');?>">
                                  <?php foreach($all_leave_types as $leave_type) {?>
                                  <option value="<?php echo $leave_type->leave_type_id?>" <?php if(isset($_GET)) { if(in_array($leave_type->leave_type_id,$leave_categories_ids)):?> selected <?php endif; }?>><?php echo $leave_type->type_name?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">  
                            <div class="col-md-12">
                              <div class="form-group">
                               <input type="hidden" value="0" name="view_companies_id[]" />
                                <label for="first_name"><?php echo $this->lang->line('xin_view_companies_data');?></label>
                                <select multiple="multiple" class="form-control" name="view_companies_id[]" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_view_companies_data');?>">
                                  <option value=""></option>
                                  <?php foreach($get_all_companies as $company) {?>
                                  <option value="<?php echo $company->company_id?>" <?php if(isset($_GET)) { if(in_array($company->company_id,$view_companies_ids)):?> selected <?php endif; }?>><?php echo $company->name?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>  
                            <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="estate"><?php echo $this->lang->line('xin_state');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_state');?>" name="estate" type="text" value="<?php echo $state;?>">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="ecity"><?php echo $this->lang->line('xin_city');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_city');?>" name="ecity" type="text" value="<?php echo $city;?>">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="ezipcode" class="control-label"><?php echo $this->lang->line('xin_zipcode');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_zipcode');?>" name="ezipcode" type="text" value="<?php echo $zipcode;?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="address"><?php echo $this->lang->line('xin_employee_address');?></label>
                                <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('xin_employee_address');?>" name="address" value="<?php echo $address;?>" />
                              </div>
                            </div>
                          </div>  
                          </div>
                          <?php $module_attributes = $this->Custom_fields_model->all_hrsale_module_attributes();?>
                          <div class="row">
                            <?php foreach($module_attributes as $mattribute):?>
                            <?php $attribute_info = $this->Custom_fields_model->get_employee_custom_data($user_id,$mattribute->custom_field_id);?>
                            <?php
								if(!is_null($attribute_info)){
									$attr_val = $attribute_info->attribute_value;
								} else {
									$attr_val = '';
								}
							?>
                            <?php if($mattribute->attribute_type == 'date'){?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                                <input class="form-control date" placeholder="<?php echo $mattribute->attribute_label;?>" name="<?php echo $mattribute->attribute;?>" type="text" value="<?php echo $attr_val;?>">
                              </div>
                            </div>
                            <?php } else if($mattribute->attribute_type == 'select'){?>
                            <div class="col-md-4">
                            <?php $iselc_val = $this->Custom_fields_model->get_attribute_selection_values($mattribute->custom_field_id);?>
                              <div class="form-group">
                                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                                <select class="form-control" name="<?php echo $mattribute->attribute;?>" data-plugin="select_hrm" data-placeholder="<?php echo $mattribute->attribute_label;?>">
                                  <?php foreach($iselc_val as $selc_val) {?>
                                  <option value="<?php echo $selc_val->attributes_select_value_id?>" <?php if($attribute_info->attribute_value==$selc_val->attributes_select_value_id):?> selected="selected"<?php endif;?>><?php echo $selc_val->select_label?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <?php } else if($mattribute->attribute_type == 'multiselect'){?>
                            <?php $multiselect_values = explode(',',$attribute_info->attribute_value);?>
                            <div class="col-md-4">
                            <?php $imulti_selc_val = $this->Custom_fields_model->get_attribute_selection_values($mattribute->custom_field_id);?>
                              <div class="form-group">
                                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                                <select multiple="multiple" class="form-control" name="<?php echo $mattribute->attribute;?>[]" data-plugin="select_hrm" data-placeholder="<?php echo $mattribute->attribute_label;?>">
                                  <?php foreach($imulti_selc_val as $multi_selc_val) {?>
                                  <option value="<?php echo $multi_selc_val->attributes_select_value_id?>" <?php if(in_array($multi_selc_val->attributes_select_value_id,$multiselect_values)):?> selected <?php endif;?>><?php echo $multi_selc_val->select_label?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <?php } else if($mattribute->attribute_type == 'textarea'){?>
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                                <input class="form-control" placeholder="<?php echo $mattribute->attribute_label;?>" name="<?php echo $mattribute->attribute;?>" type="text" value="<?php echo $attr_val;?>">
                              </div>
                            </div>
                            <?php } else if($mattribute->attribute_type == 'fileupload'){?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?>
                                <?php if($attr_val!=''):?><a href="<?php echo site_url('admin/download');?>?type=custom_files&filename=<?php echo $attr_val;?>"><?php echo $this->lang->line('xin_download');?></a>
                                <?php endif;?>
                                </label>
                                <input class="form-control-file" name="<?php echo $mattribute->attribute;?>" type="file">
                              </div>
                            </div>
                            <?php } else { ?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                                <input class="form-control" placeholder="<?php echo $mattribute->attribute_label;?>" name="<?php echo $mattribute->attribute;?>" type="text" value="<?php echo $attr_val;?>">
                              </div>
                            </div>
                            <?php }	?>
                            <?php endforeach;?>
                          </div>
                          <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                        </div>
                        <?php echo form_close(); ?> </div>                   
                    <div class="tab-pane current-tab <?php echo $get_animate;?>" id="immigration" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_add_new');?> <?php echo $this->lang->line('xin_employee_immigration');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'immigration_info', 'id' => 'immigration_info', 'autocomplete' => 'off');?>
                        <?php $hidden = array('user_id' => $user_id, 'u_document_info' => 'UPDATE');?>
                        <?php echo form_open_multipart('admin/employees/immigration_info', $attributes, $hidden);?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="relation"><?php echo $this->lang->line('xin_e_details_document');?></label>
                              <select name="document_type_id" id="document_type_id" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_e_details_choose_dtype');?>">
                                <option value=""></option>
                                <?php foreach($all_document_types as $document_type) {?>
                                <option value="<?php echo $document_type->document_type_id;?>"> <?php echo $document_type->document_type;?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="document_number" class="control-label"><?php echo $this->lang->line('xin_employee_document_number');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_employee_document_number');?>" name="document_number" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="issue_date" class="control-label"><?php echo $this->lang->line('xin_issue_date');?></label>
                              <input class="form-control date" readonly="readonly" placeholder="Issue Date" name="issue_date" type="text">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="expiry_date" class="control-label"><?php echo $this->lang->line('xin_e_details_doe');?></label>
                              <input class="form-control date" readonly="readonly" placeholder="<?php echo $this->lang->line('xin_e_details_doe');?>" name="expiry_date" type="text">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <fieldset class="form-group">
                                <label for="logo"><?php echo $this->lang->line('xin_e_details_document_file');?></label>
                                <input type="file" class="form-control-file" id="p_file2" name="document_file">
                                <small><?php echo $this->lang->line('xin_e_details_d_type_file');?></small>
                              </fieldset>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="eligible_review_date" class="control-label"><?php echo $this->lang->line('xin_eligible_review_date');?></label>
                              <input class="form-control date" readonly="readonly" placeholder="<?php echo $this->lang->line('xin_eligible_review_date');?>" name="eligible_review_date" type="text">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="send_mail"><?php echo $this->lang->line('xin_country');?></label>
                              <select class="form-control" name="country" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_country');?>">
                                <option value=""><?php echo $this->lang->line('xin_select_one');?></option>
                                <?php foreach($all_countries as $scountry) {?>
                                <option value="<?php echo $scountry->country_id;?>"> <?php echo $scountry->country_name;?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> <?php echo $this->lang->line('xin_assigned_immigration');?> <?php echo $this->lang->line('xin_records');?> </h3>
                        </div>
                        <div class="box-body">
                          <div class="box-datatable table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="xin_table_imgdocument" style="width:100%;">
                              <thead>
                                <tr>
                                  <th><?php echo $this->lang->line('xin_action');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_document');?></th>
                                  <th><?php echo $this->lang->line('xin_issue_date');?></th>
                                  <th><?php echo $this->lang->line('xin_expiry_date');?></th>
                                  <th><?php echo $this->lang->line('xin_issued_by');?></th>
                                  <th><?php echo $this->lang->line('xin_eligible_review_date');?></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane current-tab <?php echo $get_animate;?>" id="contacts" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_add_new');?> <?php echo $this->lang->line('xin_e_details_contact');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'contact_info', 'id' => 'contact_info', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_basic_info' => 'ADD');?>
                        <?php echo form_open('admin/employees/contact_info', $attributes, $hidden);?>
                        <?php
						  $data_usr1 = array(
								'type'  => 'hidden',
								'name'  => 'user_id',
								'id'    => 'user_id',
								'value' => $user_id,
						 );
						echo form_input($data_usr1);
					  ?>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <label for="relation"><?php echo $this->lang->line('xin_e_details_relation');?></label>
                              <select class="form-control" name="relation" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_select_one');?>">
                                <option value=""><?php echo $this->lang->line('xin_select_one');?></option>
                                <option value="Self"><?php echo $this->lang->line('xin_self');?></option>
                                <option value="Parent"><?php echo $this->lang->line('xin_parent');?></option>
                                <option value="Spouse"><?php echo $this->lang->line('xin_spouse');?></option>
                                <option value="Child"><?php echo $this->lang->line('xin_child');?></option>
                                <option value="Sibling"><?php echo $this->lang->line('xin_sibling');?></option>
                                <option value="In Laws"><?php echo $this->lang->line('xin_in_laws');?></option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <label for="work_email" class="control-label"><?php echo $this->lang->line('dashboard_email');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_work');?>" name="work_email" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <label>
                                <input type="checkbox" class="minimal" value="1" id="is_primary" name="is_primary">
                                <?php echo $this->lang->line('xin_e_details_pcontact');?></span> </label>
                              &nbsp;
                              <label>
                                <input type="checkbox" class="minimal" value="1" id="is_dependent" name="is_dependent">
                                <?php echo $this->lang->line('xin_e_details_dependent');?></span> </label>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_personal');?>" name="personal_email" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <label for="name" class="control-label"><?php echo $this->lang->line('xin_name');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_name');?>" name="contact_name" type="text">
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group" id="designation_ajax">
                              <label for="address_1" class="control-label"><?php echo $this->lang->line('xin_address');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_address_1');?>" name="address_1" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <label for="work_phone"><?php echo $this->lang->line('xin_phone');?></label>
                              <div class="row">
                                <div class="col-md-8">
                                  <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_work');?>" name="work_phone" type="text">
                                </div>
                                <div class="col-md-4">
                                  <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_phone_ext');?>" name="work_phone_extension" type="text">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_address_2');?>" name="address_2" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_mobile');?>" name="mobile_phone" type="text">
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-5">
                                  <input class="form-control" placeholder="<?php echo $this->lang->line('xin_city');?>" name="city" type="text">
                                </div>
                                <div class="col-md-4">
                                  <input class="form-control" placeholder="<?php echo $this->lang->line('xin_state');?>" name="state" type="text">
                                </div>
                                <div class="col-md-3">
                                  <input class="form-control" placeholder="<?php echo $this->lang->line('xin_zipcode');?>" name="zipcode" type="text">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_home');?>" name="home_phone" type="text">
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <select name="country" id="select2-demo-6" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_country');?>">
                                <option value=""></option>
                                <?php foreach($all_countries as $country) {?>
                                <option value="<?php echo $country->country_id;?>"> <?php echo $country->country_name;?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                        <?php echo form_close(); ?> </div>
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_e_details_contacts');?> </h3>
                        </div>
                        <div class="box-body">
                          <div class="box-datatable table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="xin_table_contact" style="width:100%;">
                              <thead>
                                <tr>
                                  <th><?php echo $this->lang->line('xin_action');?></th>
                                  <th><?php echo $this->lang->line('xin_employees_full_name');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_relation');?></th>
                                  <th><?php echo $this->lang->line('dashboard_email');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_mobile');?></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane current-tab <?php echo $get_animate;?>" id="documents" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_add_new');?> <?php echo $this->lang->line('xin_e_details_document');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'document_info', 'id' => 'document_info', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_document_info' => 'UPDATE');?>
                        <?php echo form_open_multipart('admin/employees/document_info', $attributes, $hidden);?>
                        <?php
				  $data_usr2 = array(
						'type'  => 'hidden',
						'name'  => 'user_id',
						'value' => $user_id,
				 );
				echo form_input($data_usr2);
			  ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="relation"><?php echo $this->lang->line('xin_e_details_dtype');?></label>
                              <select name="document_type_id" id="document_type_id" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_e_details_choose_dtype');?>">
                                <option value=""></option>
                                <?php foreach($all_document_types as $document_type) {?>
                                <option value="<?php echo $document_type->document_type_id;?>"> <?php echo $document_type->document_type;?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="date_of_expiry" class="control-label"><?php echo $this->lang->line('xin_e_details_doe');?></label>
                              <input class="form-control date" readonly placeholder="<?php echo $this->lang->line('xin_e_details_doe');?>" name="date_of_expiry" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="title" class="control-label"><?php echo $this->lang->line('xin_e_details_dtitle');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_dtitle');?>" name="title" type="text">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="email" class="control-label"><?php echo $this->lang->line('xin_e_details_notifyemail');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_notifyemail');?>" name="email" type="email">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="description" class="control-label"><?php echo $this->lang->line('xin_description');?></label>
                              <textarea class="form-control" placeholder="<?php echo $this->lang->line('xin_description');?>" data-show-counter="1" data-limit="300" name="description" cols="30" rows="3" id="d_description"></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <fieldset class="form-group">
                                <label for="logo"><?php echo $this->lang->line('xin_e_details_document_file');?></label>
                                <input type="file" class="form-control-file" id="document_file" name="document_file">
                                <small><?php echo $this->lang->line('xin_e_details_d_type_file');?></small>
                              </fieldset>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="send_mail"><?php echo $this->lang->line('xin_e_details_send_notifyemail');?></label>
                              <select name="send_mail" id="send_mail" class="form-control" data-plugin="select_hrm">
                                <option value="1"><?php echo $this->lang->line('xin_yes');?></option>
                                <option value="2"><?php echo $this->lang->line('xin_no');?></option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-actions"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_e_details_documents');?> </h3>
                        </div>
                        <div class="box-body">
                          <div class="box-datatable table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="xin_table_document" style="width:100%;">
                              <thead>
                                <tr>
                                  <th><?php echo $this->lang->line('xin_action');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_dtype');?></th>
                                  <th><?php echo $this->lang->line('dashboard_xin_title');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_notifyemail');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_doe');?></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane current-tab <?php echo $get_animate;?>" id="qualification" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_add_new');?> <?php echo $this->lang->line('xin_e_details_qualification');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'qualification_info', 'id' => 'qualification_info', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_basic_info' => 'UPDATE');?>
                        <?php echo form_open('admin/employees/qualification_info', $attributes, $hidden);?>
                        <?php
						  $data_usr3 = array(
								'type'  => 'hidden',
								'name'  => 'user_id',
								'value' => $user_id,
						 );
						echo form_input($data_usr3);
					  ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="name"><?php echo $this->lang->line('xin_e_details_inst_name');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_inst_name');?>" name="name" type="text">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="education_level" class="control-label"><?php echo $this->lang->line('xin_e_details_edu_level');?></label>
                              <select class="form-control" name="education_level" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_e_details_edu_level');?>">
                                <?php foreach($all_education_level as $education_level) {?>
                                <option value="<?php echo $education_level->education_level_id?>"><?php echo $education_level->name?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="from_year" class="control-label"><?php echo $this->lang->line('xin_e_details_timeperiod');?></label>
                              <div class="row">
                                <div class="col-md-6">
                                  <input class="form-control date" readonly="readonly" placeholder="<?php echo $this->lang->line('xin_e_details_from');?>" name="from_year" type="text">
                                </div>
                                <div class="col-md-6">
                                  <input class="form-control date" readonly="readonly" placeholder="<?php echo $this->lang->line('dashboard_to');?>" name="to_year" type="text">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="language" class="control-label"><?php echo $this->lang->line('xin_e_details_language');?></label>
                              <select class="form-control" name="language" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_e_details_language');?>">
                                <?php foreach($all_qualification_language as $qualification_language) {?>
                                <option value="<?php echo $qualification_language->language_id?>"><?php echo $qualification_language->name?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="skill" class="control-label"><?php echo $this->lang->line('xin_e_details_skill');?></label>
                              <select class="form-control" name="skill" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_e_details_skill');?>">
                                <option value=""></option>
                                <?php foreach($all_qualification_skill as $qualification_skill) {?>
                                <option value="<?php echo $qualification_skill->skill_id?>"><?php echo $qualification_skill->name?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="to_year" class="control-label"><?php echo $this->lang->line('xin_description');?></label>
                              <textarea class="form-control" placeholder="<?php echo $this->lang->line('xin_description');?>" data-show-counter="1" data-limit="300" name="description" cols="30" rows="3" id="d_description"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_e_details_qualification');?> </h3>
                        </div>
                        <div class="box-body">
                          <div class="box-datatable table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="xin_table_qualification" style="width:100%;">
                              <thead>
                                <tr>
                                  <th><?php echo $this->lang->line('xin_action');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_inst_name');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_timeperiod');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_edu_level');?></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane current-tab <?php echo $get_animate;?>" id="work-experience" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_add_new');?> <?php echo $this->lang->line('xin_e_details_w_experience');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'work_experience_info', 'id' => 'work_experience_info', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_basic_info' => 'UPDATE');?>
                        <?php echo form_open('admin/employees/work_experience_info', $attributes, $hidden);?>
                        <?php
							  $data_usr4 = array(
									'type'  => 'hidden',
									'name'  => 'user_id',
									'value' => $user_id,
							 );
							echo form_input($data_usr4);
						  ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="company_name"><?php echo $this->lang->line('xin_company_name');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_company_name');?>" name="company_name" type="text" value="" id="company_name">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="post"><?php echo $this->lang->line('xin_e_details_post');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_post');?>" name="post" type="text" value="" id="post">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="from_year" class="control-label"><?php echo $this->lang->line('xin_e_details_timeperiod');?></label>
                              <div class="row">
                                <div class="col-md-6">
                                  <input class="form-control date" readonly="readonly" placeholder="<?php echo $this->lang->line('xin_e_details_from');?>" name="from_date" type="text">
                                </div>
                                <div class="col-md-6">
                                  <input class="form-control date" readonly="readonly" placeholder="<?php echo $this->lang->line('dashboard_to');?>" name="to_date" type="text">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="description"><?php echo $this->lang->line('xin_description');?></label>
                              <textarea class="form-control" placeholder="<?php echo $this->lang->line('xin_description');?>" data-show-counter="1" data-limit="300" name="description" cols="30" rows="4" id="description"></textarea>
                              <span class="countdown"></span> </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_e_details_w_experience');?> </h3>
                        </div>
                        <div class="box-body">
                          <div class="box-datatable table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="xin_table_work_experience" style="width:100%;">
                              <thead>
                                <tr>
                                  <th><?php echo $this->lang->line('xin_action');?></th>
                                  <th><?php echo $this->lang->line('xin_company_name');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_frm_date');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_to_date');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_post');?></th>
                                  <th><?php echo $this->lang->line('xin_description');?></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane current-tab <?php echo $get_animate;?>" id="bank-account" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_add_new');?> <?php echo $this->lang->line('xin_e_details_baccount');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'bank_account_info', 'id' => 'bank_account_info', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_basic_info' => 'UPDATE');?>
                        <?php echo form_open('admin/employees/bank_account_info', $attributes, $hidden);?>
                        <?php
						  $data_usr4 = array(
								'type'  => 'hidden',
								'name'  => 'user_id',
								'value' => $user_id,
						 );
						echo form_input($data_usr4);
					  ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="account_title"><?php echo $this->lang->line('xin_e_details_acc_title');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_acc_title');?>" name="account_title" type="text" value="" id="account_name">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="account_number"><?php echo $this->lang->line('xin_e_details_acc_number');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_acc_number');?>" name="account_number" type="text" value="" id="account_number">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="bank_name"><?php echo $this->lang->line('xin_e_details_bank_name');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_bank_name');?>" name="bank_name" type="text" value="" id="bank_name">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="bank_code"><?php echo $this->lang->line('xin_e_details_bank_code');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_bank_code');?>" name="bank_code" type="text" value="" id="bank_code">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="bank_branch"><?php echo $this->lang->line('xin_e_details_bank_branch');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_bank_branch');?>" name="bank_branch" type="text" value="" id="bank_branch">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_e_details_baccount');?> </h3>
                        </div>
                        <div class="box-body">
                          <div class="box-datatable table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="xin_table_bank_account" style="width:100%;">
                              <thead>
                                <tr>
                                  <th><?php echo $this->lang->line('xin_action');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_acc_title');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_acc_number');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_bank_name');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_bank_code');?></th>
                                  <th><?php echo $this->lang->line('xin_e_details_bank_branch');?></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane current-tab <?php echo $get_animate;?>" id="social-networking" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_e_details_social');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'social_networking', 'id' => 'f_social_networking', 'autocomplete' => 'off');?>
                        <?php $hidden = array('user_id' => $user_id, 'u_basic_info' => 'UPDATE');?>
                        <?php echo form_open('admin/employees/social_info', $attributes, $hidden);?>
                        <div class="bg-white">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="facebook_profile"><?php echo $this->lang->line('xin_e_details_fb_profile');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_fb_profile');?>" name="facebook_link" type="text" value="<?php echo $facebook_link;?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="facebook_profile"><?php echo $this->lang->line('xin_e_details_twit_profile');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_twit_profile');?>" name="twitter_link" type="text" value="<?php echo $twitter_link;?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="twitter_profile"><?php echo $this->lang->line('xin_e_details_blogr_profile');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_blogr_profile');?>" name="blogger_link" type="text" value="<?php echo $blogger_link;?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="blogger_profile"><?php echo $this->lang->line('xin_e_details_linkd_profile');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_linkd_profile');?>" name="linkdedin_link" type="text" value="<?php echo $linkdedin_link;?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="blogger_profile"><?php echo $this->lang->line('xin_e_details_gplus_profile');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_gplus_profile');?>" name="google_plus_link" type="text" value="<?php echo $google_plus_link;?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="linkdedin_profile"><?php echo $this->lang->line('xin_e_details_insta_profile');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_insta_profile');?>" name="instagram_link" type="text" value="<?php echo $instagram_link;?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="linkdedin_profile"><?php echo $this->lang->line('xin_e_details_pintrst_profile');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_pintrst_profile');?>" name="pinterest_link" type="text" value="<?php echo $pinterest_link;?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="linkdedin_profile"><?php echo $this->lang->line('xin_e_details_utube_profile');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_utube_profile');?>" name="youtube_link" type="text" value="<?php echo $youtube_link;?>">
                              </div>
                            </div>
                          </div>
                          <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                    </div>
                    <div class="tab-pane current-tab <?php echo $get_animate;?>" id="change-password" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('header_change_password');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'e_change_password', 'id' => 'e_change_password', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_basic_info' => 'UPDATE');?>
                        <?php echo form_open('admin/employees/change_password', $attributes, $hidden);?>
                        <?php
						  $data_usr5 = array(
								'type'  => 'hidden',
								'name'  => 'user_id',
								'value' => $user_id,
						 );
						echo form_input($data_usr5);
					  ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="new_password"><?php echo $this->lang->line('xin_e_details_enpassword');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_enpassword');?>" name="new_password" type="text">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="new_password_confirm" class="control-label"><?php echo $this->lang->line('xin_e_details_ecnpassword');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_e_details_ecnpassword');?>" name="new_password_confirm" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-actions"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                    </div>
                    <div class="tab-pane current-tab <?php echo $get_animate;?>" id="leave" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_e_details_leave');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <div class="row">
                          <?php foreach($all_leave_types as $type) {?>
                          <?php  if(in_array($type->leave_type_id,$leave_categories_ids)){?>
                          <?php $count_l = count_leaves_info($type->leave_type_id,$this->uri->segment(4));?>
                          <?php
							if($count_l == 0){
								$progress_class = '';
								$count_data = 0;
							} else {
								$count_data = $count_l / $type->days_per_year * 100;
								// progress
								if($count_data <= 20) {
									$progress_class = 'progress-success';
								} else if($count_data > 20 && $count_data <= 50){
									$progress_class = 'progress-info';
								} else if($count_data > 50 && $count_data <= 75){
									$progress_class = 'progress-warning';
								} else {
									$progress_class = 'progress-danger';
								}
							}
						?>
                          <div class="col-md-4">
                            <div class="box mb-4">
                              <div class="box-body">
                                <div class="d-flex align-items-center">
                                  <div class="fa fa-calendar-check-o display-4 text-success"></div>
                                  <div class="ml-3">
                                    <div class="text-muted small"> <?php echo $type->type_name;?> (<?php echo $count_l;?>/<?php echo $type->days_per_year;?>)</div>
                                    <div class="text-large">
                                      <div class="progress" style="height: 6px;">
                                        <div class="progress-bar" style="width: <?php echo $count_data;?>%;"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php
							} }
							?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="xin_profile_picture"  >
          <div class="box-body">
            <div class="row no-gutters row-bordered row-border-light">
              <div class="col-md-12">
                <div class="tab-content">
                  <div class="tab-pane  <?php echo $get_animate;?> active" id="profile-picture">
                    <div class="box-body pb-2">
                      <?php $attributes = array('name' => 'profile_picture', 'id' => 'f_profile_picture', 'autocomplete' => 'off');?>
                      <?php $hidden = array('u_profile_picture' => 'UPDATE');?>
                      <?php echo form_open_multipart('admin/employees/profile_picture', $attributes, $hidden);?>
                      <?php
						  $data_usr = array(
								'type'  => 'hidden',
								'name'  => 'user_id',
								'id'    => 'user_id',
								'value' => $user_id,
						 );
						echo form_input($data_usr);
					  ?>
                      <?php
						  $data_usr = array(
								'type'  => 'hidden',
								'name'  => 'session_id',
								'id'    => 'session_id',
								'value' => $session['user_id'],
						 );
						echo form_input($data_usr);
					  ?>
                      <div class="bg-white">
                        <div class="row">
                          <div class="col-md-12">
                            <div class='form-group'>
                              <fieldset class="form-group">
                                <label for="logo"><?php echo $this->lang->line('xin_browse');?></label>
                                <input type="file" class="form-control-file" id="p_file" name="p_file">
                                <small><?php echo $this->lang->line('xin_e_details_picture_type');?></small>
                              </fieldset>
                              <?php if($profile_picture!='' && $profile_picture!='no file') {?>
                              <img src="<?php echo base_url().'uploads/profile/'.$profile_picture;?>" width="50px" style="margin-left:20px;" id="u_file">
                              <?php } else {?>
                              <?php if($gender=='Male') { ?>
                              <?php $de_file = base_url().'uploads/profile/default_male.jpg';?>
                              <?php } else { ?>
                              <?php $de_file = base_url().'uploads/profile/default_female.jpg';?>
                              <?php } ?>
                              <img src="<?php echo $de_file;?>" width="50px" style="margin-left:20px;" id="u_file">
                              <?php } ?>
                              <?php if($profile_picture!='' && $profile_picture!='no file') {?>
                              <br />
                              <label>
                                <input type="checkbox" class="minimal" value="1" id="remove_profile_picture" name="remove_profile_picture">
                                <?php echo $this->lang->line('xin_e_details_remove_pic');?></span> </label>
                              <?php } else {?>
                              <div id="remove_file" style="display:none;">
                                <label>
                                  <input type="checkbox" class="minimal" value="1" id="remove_profile_picture" name="remove_profile_picture">
                                  <?php echo $this->lang->line('xin_e_details_remove_pic');?></span> </label>
                              </div>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-action box-footer"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                      </div>
                      <?php echo form_close(); ?> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php if(in_array('351',$role_resources_ids)) {?>
        <div class="tab-pane <?php echo $get_animate;?>" id="xin_employee_set_salary"  >
          <div class="card-body">
            <div class="card overflow-hidden">
              <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                  <div class="list-group list-group-flush account-settings-links"> <a class="salary-tab-list list-group-item list-group-item-action active salary-tab" data-toggle="list" href="javascript:void(0);" data-profile="1" data-profile-block="salary" aria-expanded="true" id="suser_profile_1"><?php echo $this->lang->line('xin_employee_update_salary');?></a> <a class="salary-tab-list list-group-item list-group-item-action salary-tab" data-toggle="list" href="javascript:void(0);" data-profile="2" data-profile-block="set_allowances" aria-expanded="true" id="suser_profile_2"><?php echo $this->lang->line('xin_employee_set_allowances');?></a> <a class="salary-tab-list list-group-item list-group-item-action salary-tab" data-toggle="list" href="javascript:void(0);" data-profile="3" data-profile-block="commissions" aria-expanded="true" id="suser_profile_3"><?php echo $this->lang->line('xin_hr_commissions');?></a> <a class="salary-tab-list list-group-item list-group-item-action salary-tab" data-toggle="list" href="javascript:void(0);" data-profile="4" data-profile-block="loan_deductions" aria-expanded="true" id="suser_profile_4"><?php echo $this->lang->line('xin_employee_set_loan_deductions');?></a> <a class="salary-tab-list list-group-item list-group-item-action salary-tab" data-toggle="list" href="javascript:void(0);" data-profile="5" data-profile-block="statutory_deductions" aria-expanded="true" id="suser_profile_5"><?php echo $this->lang->line('xin_employee_set_statutory_deductions');?></a> <a class="salary-tab-list list-group-item list-group-item-action salary-tab" data-toggle="list" href="javascript:void(0);" data-profile="6" data-profile-block="other_payment" aria-expanded="true" id="suser_profile_6"><?php echo $this->lang->line('xin_employee_set_other_payment');?></a> <a class="salary-tab-list list-group-item list-group-item-action salary-tab" data-toggle="list" href="javascript:void(0);" data-profile="7" data-profile-block="overtime" aria-expanded="true" id="suser_profile_7"><?php echo $this->lang->line('dashboard_overtime');?></a> </div>
                </div>
                <div class="col-md-9">
                  <div class="tab-content active">
                    <div class="tab-pane <?php echo $get_animate;?> salary-current-tab active" id="salary">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_employee_update_salary');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'employee_update_salary', 'id' => 'employee_update_salary', 'autocomplete' => 'off');?>
                        <?php $hidden = array('user_id' => $user_id, 'u_basic_info' => 'UPDATE');?>
                        <?php echo form_open('admin/employees/update_salary_option', $attributes, $hidden);?>
                        <div class="bg-white">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="wages_type"><?php echo $this->lang->line('xin_employee_type_wages');?></label>
                                <select name="wages_type" id="wages_type" class="form-control" data-plugin="select_hrm">
                                  <option value="1" <?php if($wages_type==1):?> selected="selected"<?php endif;?>><?php echo $this->lang->line('xin_payroll_basic_salary');?></option>
                                  <option value="2" <?php if($wages_type==2):?> selected="selected"<?php endif;?>><?php echo $this->lang->line('xin_employee_daily_wages');?></option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                              <label for="basic_salary"><?php echo $this->lang->line('xin_salary_title');?></label>
                                <input class="form-control basic_salary" placeholder="<?php echo $this->lang->line('xin_salary_title');?>" name="basic_salary" type="text" value="<?php echo $basic_salary;?>">
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                              <div class="box-footer hrsale-salary-button"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                    </div>
                    <div class="tab-pane <?php echo $get_animate;?> salary-current-tab" id="set_allowances">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_employee_set_allowances');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'employee_update_allowance', 'id' => 'employee_update_allowance', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_basic_info' => 'UPDATE');?>
                        <?php echo form_open('admin/employees/employee_allowance_option', $attributes, $hidden);?>
                        <?php
						  $data_usr4 = array(
							'type'  => 'hidden',
							'name'  => 'user_id',
							'value' => $user_id,
						 );
						echo form_input($data_usr4);
					  ?>
                        <div class="row">
                          <div class="col-md-3">
                              <div class="form-group">
                                <label for="is_allowance_taxable"><?php echo $this->lang->line('xin_salary_allowance_options');?></label>
                                <select name="is_allowance_taxable" id="is_allowance_taxable" class="form-control" data-plugin="select_hrm">
                                  <option value="0"><?php echo $this->lang->line('xin_salary_allowance_non_taxable');?></option>
                                  <option value="1"><?php echo $this->lang->line('xin_salary_allowance_taxable');?></option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                              <label for="account_title"><?php echo $this->lang->line('dashboard_xin_title');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_xin_title');?>" name="allowance_title" type="text" value="" id="allowance_title">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="account_number"><?php echo $this->lang->line('xin_amount');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_amount');?>" name="allowance_amount" type="text" value="" id="allowance_amount">
                            </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                              <div class="box-footer hrsale-salary-button"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-actions box-footer"> &nbsp;</div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_employee_set_allowances');?> </h3>
                        </div>
                        <div class="box-body">
                          <div class="box-datatable table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="xin_table_all_allowances" style="width:100%;">
                              <thead>
                                <tr>
                                  <th><?php echo $this->lang->line('xin_action');?></th>
                                  <th><?php echo $this->lang->line('xin_salary_allowance_options');?></th>
                                  <th><?php echo $this->lang->line('dashboard_xin_title');?></th>
                                  <th><?php echo $this->lang->line('xin_amount');?></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane <?php echo $get_animate;?> salary-current-tab" id="commissions" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_hr_commissions');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'employee_update_commissions', 'id' => 'employee_update_commissions', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_basic_info' => 'UPDATE');?>
                        <?php echo form_open('admin/employees/employee_commissions_option', $attributes, $hidden);?>
                        <?php
							  $data_usr4 = array(
								'type'  => 'hidden',
								'name'  => 'user_id',
								'value' => $user_id,
							 );
							echo form_input($data_usr4);
						  ?>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="title"><?php echo $this->lang->line('dashboard_xin_title');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_xin_title');?>" name="title" type="text" value="" id="title">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="amount"><?php echo $this->lang->line('xin_amount');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_amount');?>" name="amount" type="text" value="" id="amount">
                            </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <div class="box-footer hrsale-salary-button"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-actions box-footer"> &nbsp;</div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_hr_commissions');?> </h3>
                        </div>
                        <div class="box-body">
                          <div class="box-datatable table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="xin_table_all_commissions" style="width:100%;">
                              <thead>
                                <tr>
                                  <th><?php echo $this->lang->line('xin_action');?></th>
                                  <th><?php echo $this->lang->line('dashboard_xin_title');?></th>
                                  <th><?php echo $this->lang->line('xin_amount');?></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane <?php echo $get_animate;?> salary-current-tab" id="loan_deductions" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_employee_set_loan_deductions');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'add_loan_info', 'id' => 'add_loan_info', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_basic_info' => 'UPDATE');?>
                        <?php echo form_open('admin/employees/employee_loan_info', $attributes, $hidden);?>
                        <?php
							  $data_usr4 = array(
									'type'  => 'hidden',
									'name'  => 'user_id',
									'value' => $user_id,
							 );
							echo form_input($data_usr4);
						  ?>
                        <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="loan_options"><?php echo $this->lang->line('xin_salary_loan_options');?></label>
                                <select name="loan_options" id="loan_options" class="form-control" data-plugin="select_hrm">
                                  <option value="1"><?php echo $this->lang->line('xin_loan_ssc_title');?></option>
                                  <option value="2"><?php echo $this->lang->line('xin_loan_hdmf_title');?></option>
                                  <option value="0"><?php echo $this->lang->line('xin_loan_other_sd_title');?></option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                              <label for="month_year"><?php echo $this->lang->line('dashboard_xin_title');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_xin_title');?>" name="loan_deduction_title" type="text">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="edu_role"><?php echo $this->lang->line('xin_employee_monthly_installment_title');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_employee_monthly_installment_title');?>" name="monthly_installment" type="text" id="m_monthly_installment">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="month_year"><?php echo $this->lang->line('xin_start_date');?></label>
                              <input class="form-control cont_date" placeholder="<?php echo $this->lang->line('xin_start_date');?>" readonly="readonly" name="start_date" type="text">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="end_date"><?php echo $this->lang->line('xin_end_date');?></label>
                              <input class="form-control cont_date" readonly="readonly" placeholder="<?php echo $this->lang->line('xin_end_date');?>" name="end_date" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="description"><?php echo $this->lang->line('xin_reason');?></label>
                              <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('xin_reason');?>" name="reason" cols="30" rows="2" id="reason2"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_employee_set_loan_deductions');?> </h3>
                        </div>
                        <div class="box-body">
                          <div class="box-datatable table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="xin_table_all_deductions" style="width:100%;">
                              <thead>
                                <tr>
                                  <th><?php echo $this->lang->line('xin_action');?></th>
                                  <th><?php echo $this->lang->line('xin_employee_set_loan_deductions');?></th>
                                  <th><?php echo $this->lang->line('xin_employee_monthly_installment_title');?></th>
                                  <th><?php echo $this->lang->line('xin_employee_loan_time');?></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane <?php echo $get_animate;?> salary-current-tab" id="statutory_deductions" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_employee_set_statutory_deductions');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'statutory_deductions_info', 'id' => 'statutory_deductions_info', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_basic_info' => 'UPDATE');?>
                        <?php echo form_open('admin/employees/set_statutory_deductions', $attributes, $hidden);?>
                        <?php
							  $data_usr4 = array(
								'type'  => 'hidden',
								'name'  => 'user_id',
								'value' => $user_id,
							 );
							echo form_input($data_usr4);
						  ?>
                        <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="statutory_options"><?php echo $this->lang->line('xin_salary_sd_options');?></label>
                                <select name="statutory_options" id="statutory_options" class="form-control" data-plugin="select_hrm">
                                  <option value="1"><?php echo $this->lang->line('xin_sd_ssc_title');?></option>
                                  <option value="2"><?php echo $this->lang->line('xin_sd_phic_title');?></option>
                                  <option value="3"><?php echo $this->lang->line('xin_sd_hdmf_title');?></option>
                                  <option value="4"><?php echo $this->lang->line('xin_sd_wht_title');?></option>
                                  <option value="0"><?php echo $this->lang->line('xin_sd_other_sd_title');?></option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                            <div class="form-group">
                              <label for="title"><?php echo $this->lang->line('dashboard_xin_title');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_xin_title');?>" name="title" type="text" value="" id="title">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="amount"><?php echo $this->lang->line('xin_amount');?>
                              <?php if($system[0]->statutory_fixed!='yes'):?> (%) <?php endif;?>
                              </label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_amount');?>" name="amount" type="text" value="" id="amount">
                            </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                              <div class="box-footer hrsale-salary-button"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-actions box-footer">&nbsp;</div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_employee_set_statutory_deductions');?> </h3>
                        </div>
                        <div class="box-body">
                          <div class="box-datatable table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="xin_table_all_statutory_deductions" style="width:100%;">
                              <thead>
                                <tr>
                                  <th><?php echo $this->lang->line('xin_action');?></th>
                                  <th><?php echo $this->lang->line('xin_salary_sd_options');?></th>
                                  <th><?php echo $this->lang->line('dashboard_xin_title');?></th>
                                  <th><?php echo $this->lang->line('xin_amount');?> <?php if($system[0]->statutory_fixed!='yes'):?> (%) <?php endif;?></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane <?php echo $get_animate;?> salary-current-tab" id="other_payment" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('xin_employee_set_other_payment');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'other_payments_info', 'id' => 'other_payments_info', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_basic_info' => 'UPDATE');?>
                        <?php echo form_open('admin/employees/set_other_payments', $attributes, $hidden);?>
                        <?php
							  $data_usr4 = array(
								'type'  => 'hidden',
								'name'  => 'user_id',
								'value' => $user_id,
							 );
							echo form_input($data_usr4);
						  ?>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="title"><?php echo $this->lang->line('dashboard_xin_title');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_xin_title');?>" name="title" type="text" value="" id="title">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="amount"><?php echo $this->lang->line('xin_amount');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_amount');?>" name="amount" type="text" value="" id="amount">
                            </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <div class="box-footer hrsale-salary-button"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-actions box-footer">&nbsp;</div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_employee_set_other_payment');?> </h3>
                        </div>
                        <div class="box-body">
                          <div class="box-datatable table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="xin_table_all_other_payments" style="width:100%;">
                              <thead>
                                <tr>
                                  <th><?php echo $this->lang->line('xin_action');?></th>
                                  <th><?php echo $this->lang->line('dashboard_xin_title');?></th>
                                  <th><?php echo $this->lang->line('xin_amount');?></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane <?php echo $get_animate;?> salary-current-tab" id="overtime" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('dashboard_overtime');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'overtime_info', 'id' => 'overtime_info', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_basic_info' => 'UPDATE');?>
                        <?php echo form_open('admin/employees/set_overtime', $attributes, $hidden);?>
                        <?php
						  $data_usr4 = array(
								'type'  => 'hidden',
								'name'  => 'user_id',
								'value' => $user_id,
						 );
						echo form_input($data_usr4);
					  ?>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="overtime_type"><?php echo $this->lang->line('xin_employee_overtime_title');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_employee_overtime_title');?>" name="overtime_type" type="text" value="" id="overtime_type">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="no_of_days"><?php echo $this->lang->line('xin_employee_overtime_no_of_days');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_employee_overtime_no_of_days');?>" name="no_of_days" type="text" value="" id="no_of_days">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="overtime_hours"><?php echo $this->lang->line('xin_employee_overtime_hour');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_employee_overtime_hour');?>" name="overtime_hours" type="text" value="" id="overtime_hours">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="overtime_rate"><?php echo $this->lang->line('xin_employee_overtime_rate');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_employee_overtime_rate');?>" name="overtime_rate" type="text" value="" id="overtime_rate">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_save'))); ?> </div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('dashboard_overtime');?> </h3>
                        </div>
                        <div class="box-body">
                          <div class="box-datatable table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="xin_table_emp_overtime" style="width:100%;">
                              <thead>
                                <tr>
                                  <th><?php echo $this->lang->line('xin_action');?></th>
                                  <th><?php echo $this->lang->line('xin_employee_overtime_title');?></th>
                                  <th><?php echo $this->lang->line('xin_employee_overtime_no_of_days');?></th>
                                  <th><?php echo $this->lang->line('xin_employee_overtime_hour');?></th>
                                  <th><?php echo $this->lang->line('xin_employee_overtime_rate');?></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
