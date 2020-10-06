<?php
/* Performance Appraisal view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>
<?php $role_resources_ids = $this->Xin_model->user_role_resource(); ?>
<?php if(in_array('302',$role_resources_ids)) {?>
<?php $user_info = $this->Xin_model->read_user_info($session['user_id']);?>
<div class="box mb-4 <?php echo $get_animate;?>">
  <div id="accordion">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo $this->lang->line('xin_give_performance_appraisal');?></h3>
      <div class="box-tools pull-right"> <a class="text-dark collapsed" data-toggle="collapse" href="#add_form" aria-expanded="false">
        <button type="button" class="btn btn-xs btn-primary"> <span class="ion ion-md-add"></span> <?php echo $this->lang->line('xin_add_new');?></button>
        </a> </div>
    </div>
    <div id="add_form" class="collapse add-form <?php echo $get_animate;?>" data-parent="#accordion" style="">
      <div class="box-body">
        <?php $attributes = array('name' => 'add_appraisal', 'id' => 'xin-form', 'autocomplete' => 'off');?>
        <?php $hidden = array('user_id' => $session['user_id']);?>
        <?php echo form_open('admin/performance_appraisal/add_appraisal', $attributes, $hidden);?>
        <div class="row m-b-1">
          <div class="col-md-12">
            <div class="bg-white">
              <div class="row">
                <div class="col-md-12">
                  <?php if($user_info[0]->user_role_id==1){ ?>
                  <div class="row">
                    <div class="col-md-3 control-label">
                      <div class="form-group">
                        <label for="employee"><?php echo $this->lang->line('left_company');?></label>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <select class="form-control" name="company_id" id="aj_company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('left_company');?>">
                          <option value=""></option>
                          <?php foreach($get_all_companies as $company) {?>
                          <option value="<?php echo $company->company_id?>"><?php echo $company->name?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <?php } else { ?>
                  <?php $ecompany_id = $user_info[0]->company_id;?>
                  <div class="row">
                    <div class="col-md-3 control-label">
                      <div class="form-group">
                        <label for="employee"><?php echo $this->lang->line('left_company');?></label>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <select class="form-control" name="company_id" id="aj_company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('left_company');?>">
                          <option value=""></option>
                          <?php foreach($get_all_companies as $company) {?>
							  <?php if($ecompany_id == $company->company_id):?>
                              <option value="<?php echo $company->company_id?>"><?php echo $company->name?></option>
                              <?php endif;?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="row">
                    <div class="col-md-3 control-label">
                      <div class="form-group">
                        <label for="employee"><?php echo $this->lang->line('dashboard_single_employee');?></label>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group" id="employee_ajax">
                        <select class="select2" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_choose_an_employee');?>" name="employee_id" id="employee_id">
                          <option value=""></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 control-label">
                      <div class="form-group">
                        <label for="month_year"><?php echo $this->lang->line('xin_select_month');?></label>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <input class="form-control month_year" placeholder="<?php echo $this->lang->line('xin_select_month');?>" readonly id="month_year" name="month_year" type="text">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row m-b-1">
              <div class="col-md-6">
                <div class="bg-white">
                  <table class="table table-grey-head m-md-b-0">
                    <thead>
                      <tr>
                        <th colspan="5"><?php echo $this->lang->line('xin_performance_technical_competencies');?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th colspan="2"><?php echo $this->lang->line('xin_indicator');?></th>
                        <th colspan="2"><?php echo $this->lang->line('xin_expected_value');?></th>
                        <th><?php echo $this->lang->line('xin_set_value');?></th>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_customer_experience');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_intermediate');?></td>
                        <td><select name="customer_experience" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                            <option value="4"> <?php echo $this->lang->line('xin_performance_expert');?></option>
                          </select></td>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_marketing');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_advanced');?></td>
                        <td><select name="marketing" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                            <option value="4"> <?php echo $this->lang->line('xin_performance_expert');?></option>
                          </select></td>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_management');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_advanced');?></td>
                        <td><select name="management" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                            <option value="4"> <?php echo $this->lang->line('xin_performance_expert');?></option>
                          </select></td>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_administration');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_advanced');?></td>
                        <td><select name="administration" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                            <option value="4"> <?php echo $this->lang->line('xin_performance_expert');?></option>
                          </select></td>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_present_skill');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_expert');?></td>
                        <td><select name="presentation_skill" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                            <option value="4"> <?php echo $this->lang->line('xin_performance_expert');?></option>
                          </select></td>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_quality_work');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_expert');?></td>
                        <td><select name="quality_of_work" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                            <option value="4"> <?php echo $this->lang->line('xin_performance_expert');?></option>
                          </select></td>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_efficiency');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_expert');?></td>
                        <td><select name="efficiency" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                            <option value="4"> <?php echo $this->lang->line('xin_performance_expert');?></option>
                          </select></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="bg-white">
                  <table class="table table-grey-head m-md-b-0">
                    <thead>
                      <tr>
                        <th colspan="5"><?php echo $this->lang->line('xin_performance_behv_technical_competencies');?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th colspan="2"><?php echo $this->lang->line('xin_indicator');?></th>
                        <th colspan="2"><?php echo $this->lang->line('xin_expected_value');?></th>
                        <th><?php echo $this->lang->line('xin_set_value');?></th>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_integrity');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_beginner');?></td>
                        <td><select name="integrity" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                          </select></td>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_professionalism');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_beginner');?></td>
                        <td><select name="professionalism" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                          </select></td>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_team_work');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_intermediate');?></td>
                        <td><select name="team_work" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                          </select></td>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_critical_think');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_advanced');?></td>
                        <td><select name="critical_thinking" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                          </select></td>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_conflict_manage');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_intermediate');?></td>
                        <td><select name="conflict_management" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                          </select></td>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_attendance');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_intermediate');?></td>
                        <td><select name="attendance" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                          </select></td>
                      </tr>
                      <tr>
                        <td scope="row" colspan="2"><?php echo $this->lang->line('xin_performance_meet_deadline');?></td>
                        <td colspan="2"><?php echo $this->lang->line('xin_performance_advanced');?></td>
                        <td><select name="ability_to_meet_deadline" class="form-control">
                            <option value=""><?php echo $this->lang->line('xin_performance_none');?></option>
                            <option value="1"> <?php echo $this->lang->line('xin_performance_beginner');?></option>
                            <option value="2"> <?php echo $this->lang->line('xin_performance_intermediate');?></option>
                            <option value="3"> <?php echo $this->lang->line('xin_performance_advanced');?></option>
                          </select></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="m-b-1">
            <div class="col-md-12">
              <div class="bg-white">
                <div class="form-group">
                  <label for="remarks"><?php echo $this->lang->line('xin_remarks');?></label>
                  <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('xin_remarks');?>" name="remarks" id="remarks"></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="form-actions box-footer">
                  <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php echo form_close(); ?> </div>
    </div>
  </div>
</div>
<?php } ?>
<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_performance_apps');?> </h3>
  </div>
  <div class="box-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="xin_table">
        <thead>
          <tr>
            <th><?php echo $this->lang->line('xin_action');?></th>
            <th><?php echo $this->lang->line('left_company');?></th>
            <th><i class="fa fa-user"></i> <?php echo $this->lang->line('dashboard_single_employee');?></th>
            <th><?php echo $this->lang->line('left_department');?></th>
            <th><?php echo $this->lang->line('dashboard_designation');?></th>
            <th><i class="fa fa-calendar"></i> <?php echo $this->lang->line('xin_performance_app_date');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<style type="text/css">
.hide-calendar .ui-datepicker-calendar { display:none !important; }
.hide-calendar .ui-priority-secondary { display:none !important; }
</style>
