<?php
/* Project Details view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $u_created = $this->Xin_model->read_user_info($session['user_id']);?>
<?php
$id = $this->uri->segment(4);
$result = $this->Project_model->read_project_information($id);
if(is_null($result)){
	redirect('admin/project');
}	
?>
<?php $assigned_ids = explode(',',$result[0]->assigned_to);?>
<?php
//status
if($result[0]->status == 0) {
	$nstatus = $this->lang->line('xin_q_project_created');
} else if($result[0]->status ==1){
	$nstatus = $this->lang->line('xin_in_progress');
} else if($result[0]->status ==2){
	$nstatus = $this->lang->line('xin_completed');
} else {
	$nstatus = $this->lang->line('xin_deffered');
}
//priority
if($result[0]->priority == 1) {
	$epriority = '<span class="tag tag-default tag-danger">'.$this->lang->line('xin_highest').'</span>';
} else if($result[0]->priority ==2){
	$epriority = '<span class="tag tag-default tag-warning">'.$this->lang->line('xin_high').'</span>';
} else if($result[0]->priority ==3){
	$epriority = '<span class="tag tag-default tag-primary">'.$this->lang->line('xin_normal').'</span>';
} else {
	$epriority = '<span class="tag tag-default tag-success">'.$this->lang->line('xin_low').'</span>';
}
if($result[0]->project_progress <= 20) {
	$progress_class = 'progress-danger';
	$txt_class = 'text-danger';
} else if($result[0]->project_progress > 20 && $result[0]->project_progress <= 50){
	$progress_class = 'progress-warning';
	$txt_class = 'text-warning';
} else if($result[0]->project_progress > 50 && $result[0]->project_progress <= 75){
	$progress_class = 'progress-info';
	$txt_class = 'text-info';
} else {
	$progress_class = 'progress-success';
	$txt_class = 'text-success';
}
$project_id = $result[0]->project_id;
$projectTasks = $this->Project_model->completed_project_tasks($project_id);
$projectBugs = $this->Project_model->completed_project_bugs($project_id); 
?>
<?php // get company name by project id ?>
<?php $co_info  = $this->Project_model->read_project_information($project_id); ?>
<?php $eresult = $this->Department_model->ajax_company_employee_info($co_info[0]->company_id);?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>
<?php if($this->session->flashdata('response')):?>
<div class="callout callout-success">
<p><?php echo $this->session->flashdata('response');?></p>
</div>
<?php endif;?>
<div class="row">
  <div class="col-xs-12"> &nbsp; <small class="pull-right">
    <div class="btn-group pull-right" role="group" style="margin-top:2px">
      	<?php $quote_convert_record = 0;//$this->Quotes_model->read_quote_converted_info(1);?>
        <?php if ($quote_convert_record < 1) { ?>
        <a href="<?php echo site_url('admin/quotes/convert_to_invoice/'.$project_id);?>" class="btn btn-success btn-sm"><i class="fa fa-exchange" aria-hidden="true"></i> <?php echo $this->lang->line('xin_quote_convert_invoice');?> </a>
        <?php } else { ?>
        <a href="javascript:void(0);" class="btn btn-success btn-sm"><i class="fa fa-check-square" aria-hidden="true"></i> <?php echo $this->lang->line('xin_quote_converted_invoice');?> </a>
        <?php } ?>
    </div>
    </small> </div>
  <!-- /.col --> 
</div><br />
<div class="row <?php echo $get_animate;?>">
  <div class="col-md-12">
    <div class="card m-b-20">
      <div class="card-body">
        <div class="row text-center m-t-20">
          <div class="col-md-2">
            <h5 class=""><i class="fa fa-user"></i> <?php echo $this->lang->line('xin_client_name');?></h5>
            <p class="text-muted"><?php echo $client_name;?></p>
          </div>
          <div class="col-md-2">
            <h5 class=""><i class="fa fa-calendar"></i> <?php echo $this->lang->line('xin_start_date');?></h5>
            <p class="text-muted"><?php echo $this->Xin_model->set_date_format($start_date);?></p>
          </div>
          <div class="col-md-2">
            <h5 class=""><i class="fa fa-calendar"></i> <?php echo $this->lang->line('xin_end_date');?></h5>
            <p class="text-muted"><?php echo $this->Xin_model->set_date_format($end_date);?></p>
          </div>
          <div class="col-md-2">
            <h5 class=""><?php echo $this->lang->line('xin_p_priority');?></h5>
            <p class="text-muted"><?php echo $epriority;?></p>
          </div>
          <div class="col-md-4">
            <h5 class=""><?php echo $this->lang->line('xin_prjct_detail_overall_progress');?></h5>
            <p class="text-muted"><?php echo $progress;?>%<br />
            <div class="progress" style="height: 7px;">
              <div class="progress-bar" style="width: <?php echo $progress;?>%;"></div>
            </div>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section id="basic-listgroup">
  <div class="row match-heights <?php echo $get_animate;?>">
    <div class="col-lg-2 col-md-2">
      <div class="card">
        <div class="card-blocks">
          <div class="list-group"> <a class="list-group-item list-group-item-action nav-tabs-link active" href="#overview" data-config="1" data-config-block="overview" data-toggle="tab" aria-expanded="true" id="pj_data_1"> <i class="fa fa-home"></i> <?php echo $this->lang->line('xin_overview');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" href="#assigned" data-config="2" data-config-block="assigned" data-toggle="tab" aria-expanded="true" id="pj_data_2"><i class="fa fa-users"></i> <?php echo $this->lang->line('xin_assigned_to');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" href="#progress" data-config="3" data-config-block="progress" data-toggle="tab" aria-expanded="true" id="pj_data_3"><i class="fa fa-leaf"></i> <?php echo $this->lang->line('dashboard_xin_progress');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" href="#discussion" data-config="4" data-config-block="discussion" data-toggle="tab" aria-expanded="true" id="pj_data_4"><i class="fa fa-weixin"></i> <?php echo $this->lang->line('xin_discussion');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" href="#bugs" data-config="5" data-config-block="bugs" data-toggle="tab" aria-expanded="true" id="pj_data_5"><i class="fa fa-bug"></i> <?php echo $this->lang->line('xin_bugs_issues');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" href="#tasks" data-config="6" data-config-block="tasks" data-toggle="tab" aria-expanded="true" id="pj_data_6"><i class="fa fa-tasks"></i> <?php echo $this->lang->line('xin_tasks');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" href="#files" data-config="7" data-config-block="files" data-toggle="tab" aria-expanded="true" id="pj_data_7"><i class="fa fa-book"></i> <?php echo $this->lang->line('xin_files');?></a> <a class="list-group-item list-group-item-action nav-tabs-link" href="#note" data-config="8" data-config-block="note" data-toggle="tab" aria-expanded="true" id="pj_data_8"><i class="fa fa-paperclip"></i> <?php echo $this->lang->line('xin_note');?> </a> </div>
        </div>
      </div>
    </div>
    <div class="col-xl-10 col-lg-10  <?php echo $get_animate;?>">
      <div class="col current-tab <?php echo $get_animate;?>" id="overview"> 
        
        <!-- Description -->
        <div class="box mb-4">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('xin_project_overview');?> </h3>
          </div>
          <div class="box-body"> <?php echo html_entity_decode($description);?> </div>
        </div>
        <!-- / Description --> 
      </div>
      <div class="col current-tab <?php echo $get_animate;?>" id="assigned"  aria-expanded="false" style="display:none;">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('xin_assigned');?> <?php echo $this->lang->line('xin_users');?> </h3>
          </div>
          <div class="box-body">
            <div class="box-block">
              <div class="row">
                <div class="col-md-12">
                  <?php $attributes = array('name' => 'assign_project', 'id' => 'assign_project', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
                  <?php $hidden = array('_method' => 'EDIT');?>
                  <?php echo form_open('admin/project/assign_project/', $attributes, $hidden);?>
                  <?php
						$data = array(
						  'name'        => 'project_id',
						  'id'          => 'project_id',
						  'type'        => 'hidden',
						  'value'  	   => $project_id,
						  'class'       => 'form-control',
						);
						echo form_input($data);
					?>
                  <div class="form-group">
                    <label for="employees" class="control-label"><?php echo $this->lang->line('xin_employee');?></label>
                    <select class="form-control" name="assigned_to[]" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_employee');?>" multiple="multiple">
                      <?php foreach($eresult as $e_employee) {?>
                      <option value="<?php echo $e_employee->user_id?>" <?php if(in_array($e_employee->user_id,$assigned_ids)){ ?> selected="selected"<?php } ?>> <?php echo $e_employee->first_name.' '.$e_employee->last_name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-actions box-footer">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
                  </div>
                  <?php echo form_close(); ?> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col current-tab <?php echo $get_animate;?>" id="progress"  aria-expanded="false" style="display:none;">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('xin_project');?> <?php echo $this->lang->line('dashboard_xin_progress');?></h3>
          </div>
          <div class="box-body">
            <div class="box-block">
              <?php $attributes = array('name' => 'update_status', 'id' => 'update_status', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
              <?php $hidden = array('_method' => 'EDIT');?>
              <?php echo form_open('admin/project/update_status/', $attributes, $hidden);?>
              <?php
			$data1 = array(
			  'name'        => 'project_id',
			  'type'        => 'hidden',
			  'value'  	   => $project_id,
			  'class'       => 'form-control',
			);
			echo form_input($data1);
			?>
              <?php
			$data2 = array(
			  'name'        => 'progres_val',
			  'id'          => 'progres_val',
			  'type'        => 'hidden',
			  'value'  	   => $result[0]->project_progress,
			  'class'       => 'form-control',
			);
			echo form_input($data2);
			?>
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="progress"><?php echo $this->lang->line('dashboard_xin_progress');?></label>
                        <input type="text" id="range_grid">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="status"><?php echo $this->lang->line('dashboard_xin_status');?></label>
                        <select class="form-control" name="status" data-plugin="select_hrm" data-placeholder="Status">
                          <option value="0" <?php if($status=='0'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_not_started');?></option>
                          <option value="1" <?php if($status=='1'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_in_progress');?></option>
                          <option value="2" <?php if($status=='2'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_completed');?></option>
                          <option value="3" <?php if($status=='3'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_deffered');?></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="status"><?php echo $this->lang->line('xin_p_priority');?></label>
                        <select class="form-control" name="priority" data-plugin="select_hrm" data-placeholder="Priority">
                          <option value="1" <?php if($priority=='1'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_highest');?></option>
                          <option value="2" <?php if($priority=='2'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_high');?></option>
                          <option value="3" <?php if($priority=='3'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_normal');?></option>
                          <option value="4" <?php if($priority=='4'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_low');?></option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-actions  box-footer">
                <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
              </div>
              <?php echo form_close(); ?> </div>
          </div>
        </div>
      </div>
      <div class="col current-tab <?php echo $get_animate;?>" id="discussion"  aria-expanded="false" style="display:none;">
        <div class="box md-4">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('xin_project');?> <?php echo $this->lang->line('xin_discussion');?> </h3>
          </div>
          <div class="box-body">
            <?php $attributes = array('name' => 'set_discussion', 'id' => 'set_discussion', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
            <?php $hidden = array('_method' => 'EDIT');?>
            <?php echo form_open_multipart('admin/project/set_discussion/', $attributes, $hidden);?>
            <?php
			$data3 = array(
			  'name'        => 'user_id',
			  'type'        => 'hidden',
			  'value'  	   => $session['user_id'],
			  'class'       => 'form-control',
			);
			echo form_input($data3);
		?>
            <?php
			$data4 = array(
			  'name'        => 'discussion_project_id',
			  'id'          => 'discussion_project_id',
			  'type'        => 'hidden',
			  'value'  	   => $project_id,
			  'class'       => 'form-control',
			);
			echo form_input($data4);
		?>
            <div class="box-block">
              <div class="form-group">
                <textarea name="xin_message" id="xin_message" class="form-control" rows="4" placeholder="<?php echo $this->lang->line('xin_message');?>"></textarea>
              </div>
              <div class="form-group">
                <fieldset class="form-group">
                  <label for="logo"><?php echo $this->lang->line('xin_attachment');?></label>
                  <input type="file" class="form-control-file" id="attachment_discussion" name="attachment_discussion">
                </fieldset>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-actions box-footer">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
                  </div>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?> </div>
        </div>
        <div class="box mt-4">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('xin_project');?> <?php echo $this->lang->line('xin_discussion');?> </h3>
          </div>
          <div class="box-body">
            <div class="box-datatable table-responsive">
              <table class="datatables-demo table table-striped table-bordered" id="xin_discussion_table" style="width:100%;">
                <thead>
                  <tr>
                    <th><?php echo $this->lang->line('xin_all_discussions');?></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col current-tab <?php echo $get_animate;?>" id="bugs"  aria-expanded="false" style="display:none;">
        <div class="box md-4">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('xin_project');?> <?php echo $this->lang->line('xin_bugs_issues');?> </h3>
          </div>
          <div class="box-body">
            <?php $attributes = array('name' => 'set_bug', 'id' => 'set_bug', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
            <?php $hidden = array('_method' => 'EDIT');?>
            <?php echo form_open_multipart('admin/project/set_bug/', $attributes, $hidden);?>
            <?php
			$data5 = array(
			  'name'        => 'user_id',
			  'type'        => 'hidden',
			  'value'  	   => $session['user_id'],
			  'class'       => 'form-control',
			);
			echo form_input($data5);
		?>
            <div class="box-block">
              <input type="hidden" name="bug_project_id" id="bug_project_id" class="form-control" value="<?php echo $project_id;?>">
              <div class="form-group">
                <input type="text" name="title" id="title" class="form-control" placeholder="<?php echo $this->lang->line('dashboard_xin_title');?>">
              </div>
              <div class="form-group">
                <fieldset class="form-group">
                  <label for="logo"><?php echo $this->lang->line('xin_attachment');?></label>
                  <input type="file" class="form-control-file" id="attachment" name="attachment">
                </fieldset>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-actions box-footer">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
                  </div>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?> </div>
        </div>
        <div class="box mt-4 <?php echo $get_animate;?>">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('xin_all_bugs_issues');?> </h3>
          </div>
          <div class="box-body">
            <div class="box-datatable table-responsive">
              <table class="datatables-demo table table-striped table-bordered" id="xin_bug_table">
                <thead>
                  <tr>
                    <th><?php echo $this->lang->line('xin_all_bugs_issues');?></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col current-tab <?php echo $get_animate;?>" id="tasks"  aria-expanded="false" style="display:none;">
        <div class="box md-4">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('xin_project');?> <?php echo $this->lang->line('xin_tasks');?></h3>
          </div>
          <div class="box-body">
            <?php $attributes = array('name' => 'add_task', 'id' => 'xin-form', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
            <?php $hidden = array('_method' => 'ADD');?>
            <?php echo form_open('admin/timesheet/add_task/', $attributes, $hidden);?>
            <?php
			$data7 = array(
			  'name'        => 'user_id',
			  'type'        => 'hidden',
			  'value'  	   => $session['user_id'],
			  'class'       => 'form-control',
			);
			echo form_input($data7);
		?>
            <?php
			$data8 = array(
			  'name'        => 'type',
			  'type'        => 'hidden',
			  'value'  	   => 1,
			  'class'       => 'form-control',
			);
			echo form_input($data8);
		?>
            <div class="box-block">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="task_name"><?php echo $this->lang->line('dashboard_xin_title');?></label>
                    <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_xin_title');?>" name="task_name" type="text" value="">
                  </div>
                  <div class="row">
                    <input type="hidden" name="project_id" id="tproject_id" value="<?php echo $project_id;?>" />
                    <input type="hidden" name="company_id" id="company_id" value="<?php echo $co_info[0]->company_id;?>" />
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="start_date"><?php echo $this->lang->line('xin_start_date');?></label>
                        <input class="form-control date" placeholder="<?php echo $this->lang->line('xin_start_date');?>" readonly name="start_date" type="text" value="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="end_date"><?php echo $this->lang->line('xin_end_date');?></label>
                        <input class="form-control date" placeholder="<?php echo $this->lang->line('xin_end_date');?>" readonly name="end_date" type="text" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="task_hour" class="control-label"><?php echo $this->lang->line('xin_estimated_hour');?></label>
                        <input class="form-control" placeholder="<?php echo $this->lang->line('xin_estimated_hour');?>" name="task_hour" type="text" value="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="description"><?php echo $this->lang->line('xin_description');?></label>
                    <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('xin_description');?>" name="description" cols="30" rows="15" id="description"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="employees" class="control-label"><?php echo $this->lang->line('xin_assigned_to');?></label>
                    <select multiple class="form-control" name="assigned_to[]" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('dashboard_single_employee');?>">
                      <option value=""></option>
                      <?php foreach($eresult as $employee) {?>
                      <option value="<?php echo $employee->user_id?>"> <?php echo $employee->first_name.' '.$employee->last_name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-actions box-footer">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
                  </div>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?> </div>
        </div>
        <div class="box mt-4 <?php echo $get_animate;?>">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('xin_project');?> <?php echo $this->lang->line('xin_tasks');?> </h3>
          </div>
          <div class="box-body">
            <div class="box-datatable table-responsive">
              <table class="table table-striped table-bordered dataTable" id="xin_table" style="width:100%;">
                <thead>
                  <tr>
                    <th><?php echo $this->lang->line('xin_action');?></th>
                    <th><?php echo $this->lang->line('dashboard_xin_title');?></th>
                    <th><?php echo $this->lang->line('xin_end_date');?></th>
                    <th><?php echo $this->lang->line('dashboard_xin_status');?></th>
                    <th><?php echo $this->lang->line('xin_assigned_to');?></th>
                    <th><?php echo $this->lang->line('xin_created_by');?></th>
                    <th><?php echo $this->lang->line('dashboard_xin_progress');?></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col current-tab <?php echo $get_animate;?>" id="files"  aria-expanded="false" style="display:none;">
        <div class="box mb-4">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('xin_project');?> <?php echo $this->lang->line('xin_files');?></h3>
          </div>
          <div class="box-body">
            <?php $attributes = array('name' => 'add_attachment', 'id' => 'add_attachment', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
            <?php $hidden = array('_method' => 'ADD');?>
            <?php echo form_open_multipart('admin/project/add_attachment/', $attributes, $hidden);?>
            <?php
			$data9 = array(
			  'name'        => 'user_id',
			  'id'          => 'user_id',
			  'type'        => 'hidden',
			  'value'  	   => $session['user_id'],
			  'class'       => 'form-control',
			);
			echo form_input($data9);
		?>
            <?php
			$data10 = array(
			  'name'        => 'project_id',
			  'id'          => 'f_project_id',
			  'type'        => 'hidden',
			  'value'  	   => $project_id,
			  'class'       => 'form-control',
			);
			echo form_input($data10);
		?>
            <?php
			$data11 = array(
			  'name'        => 'type',
			  'type'        => 'hidden',
			  'value'  	   => 1,
			  'class'       => 'form-control',
			);
			echo form_input($data11);
		?>
            <div class="bg-white">
              <div class="box-block">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="task_name"><?php echo $this->lang->line('dashboard_xin_title');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_xin_title');?>" name="file_name" type="text" value="">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class='form-group'>
                      <fieldset class="form-group">
                        <label for="logo"><?php echo $this->lang->line('xin_attachment_file');?></label>
                        <input type="file" class="form-control-file" id="attachment_file" name="attachment_file">
                        <small><?php echo $this->lang->line('xin_project_files_upload');?></small>
                      </fieldset>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description"><?php echo $this->lang->line('xin_description');?></label>
                      <textarea class="form-control" placeholder="<?php echo $this->lang->line('xin_description');?>" name="file_description" rows="4" id="file_description"></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-actions box-footer">
                  <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?> </div>
        </div>
        <div class="box <?php echo $get_animate;?>">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('xin_attachment_list');?></h3>
          </div>
          <div class="box-body">
            <div class="box-datatable table-responsive">
              <table class="table table-hover table-striped table-bordered table-ajax-load" id="xin_attachment_table" style="width:100%;">
                <thead>
                  <tr>
                    <th><?php echo $this->lang->line('xin_option');?></th>
                    <th><?php echo $this->lang->line('dashboard_xin_title');?></th>
                    <th><?php echo $this->lang->line('xin_description');?></th>
                    <th><?php echo $this->lang->line('xin_date_and_time');?></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col current-tab <?php echo $get_animate;?>" id="note"  aria-expanded="false" style="display:none;">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('xin_project');?> <?php echo $this->lang->line('xin_note');?></h3>
          </div>
          <div class="box-body">
            <div class="box-block">
              <?php $attributes = array('name' => 'add_note', 'id' => 'add_note', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
              <?php $hidden = array('_method' => 'UPDATE', '_uid' => $session['user_id']);?>
              <?php echo form_open_multipart('admin/project/add_note/', $attributes, $hidden);?>
              <?php
				$data12 = array(
				  'name'        => 'note_project_id',
				  'id'          => 'note_project_id',
				  'type'        => 'hidden',
				  'value'  	   => $project_id,
				  'class'       => 'form-control',
				);
				echo form_input($data12);
			?>
              <div class="box-block">
                <div class="form-group">
                  <textarea name="project_note" id="project_note" class="form-control" rows="5" placeholder="<?php echo $this->lang->line('xin_project_note');?>"><?php echo $project_note;?></textarea>
                </div>
                <div class="form-actions box-footer">
                  <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
                </div>
              </div>
              <?php echo form_close(); ?> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<style type="text/css">
.trumbowyg-box, .trumbowyg-editor { min-height: 105px; }
</style>
