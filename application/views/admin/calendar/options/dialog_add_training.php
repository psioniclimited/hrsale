<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['is_ajax']) && $_GET['data']=='event'){
$session = $this->session->userdata('username');
?>
<?php $user_info = $this->Xin_model->read_user_info($session['user_id']);?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"> <?php echo $this->lang->line('xin_add_new');?> <?php echo $this->lang->line('left_training');?></h4>
</div>
<?php $attributes = array('name' => 'add_training', 'id' => 'xin-form', 'autocomplete' => 'off', 'class' => 'm-b-1');?>
<?php $hidden = array('user_id' => $session['user_id']);?>
<?php echo form_open('admin/training/add_training', $attributes, $hidden);?>
  <div class="modal-body">
    <div class="bg-white">
      <div class="box-block">
        <div class="row">
          <div class="col-md-6">
          <?php if($user_info[0]->user_role_id==1){?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="company_name"><?php echo $this->lang->line('module_company_title');?></label>
                  <select class="form-control" name="company" id="aj_company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('module_company_title');?>">
                    <option value=""><?php echo $this->lang->line('xin_select_one');?></option>
                    <?php foreach($all_companies as $company) {?>
                    <option value="<?php echo $company->company_id;?>"> <?php echo $company->name;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <?php } ?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="trainer"><?php echo $this->lang->line('xin_trainer');?></label>
                  <select class="form-control" name="trainer" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_trainer');?>">
                    <option value=""></option>
                    <?php foreach($all_trainers as $trainer) {?>
                    <option value="<?php echo $trainer->trainer_id?>"><?php echo $trainer->first_name.' '.$trainer->last_name;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="start_date"><?php echo $this->lang->line('xin_start_date');?></label>
                  <input class="form-control edate" placeholder="<?php echo $this->lang->line('xin_start_date');?>" readonly name="start_date" type="text" value="<?php echo $_GET['event_date'];?>" id="start_date">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="end_date"><?php echo $this->lang->line('xin_end_date');?></label>
                  <input class="form-control edate" placeholder="<?php echo $this->lang->line('xin_end_date');?>" readonly name="end_date" type="text" value="<?php echo $_GET['event_date'];?>" id="end_date">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="training_type"><?php echo $this->lang->line('left_training_type');?></label>
                  <select class="form-control" name="training_type" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('left_training_type');?>">
                    <option value=""></option>
                    <?php foreach($all_training_types as $training_type) {?>
                    <option value="<?php echo $training_type->training_type_id?>"><?php echo $training_type->type?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="training_cost"><?php echo $this->lang->line('xin_training_cost');?></label>
                  <input class="form-control" placeholder="<?php echo $this->lang->line('xin_training_cost');?>" name="training_cost" type="text" value="">
                </div>
              </div>
            </div>
            <?php if($user_info[0]->user_role_id==1){?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group" id="employee_ajax">
                  <label for="employee" class="control-label"><?php echo $this->lang->line('xin_employee');?></label>
                  <select multiple class="form-control" name="employee_id[]" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_employee');?>">
                    <option value=""></option>
                  </select>
                </div>
              </div>
            </div>
            <?php } else {?>
            <input type="hidden" name="employee_id[]" id="employee_id" value="<?php echo $session['user_id'];?>" />
            <input type="hidden" name="company" id="company_id" value="<?php echo $user_info[0]->company_id;?>" />
            <?php } ?>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="description"><?php echo $this->lang->line('xin_description');?></label>
              <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('xin_description');?>" name="description" id="description"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('xin_close');?></button>
    <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
  </div>
<?php echo form_close(); ?>
<script type="application/javascript">
$(document).ready(function() {
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
	$('#description').trumbowyg({
		btns: [
			['formatting'],
			'btnGrp-semantic',
			['superscript', 'subscript'],
			['removeformat'],
		],
		autogrowOnEnter: true
	});
	// Date
	$('.edate').datepicker({
	  changeMonth: true,
	  changeYear: true,
	  dateFormat:'yy-mm-dd',
	  yearRange: new Date().getFullYear() + ':' + (new Date().getFullYear() + 10),
	});
	jQuery("#aj_company").change(function(){
		jQuery.get(site_url+"training/get_employees/"+jQuery(this).val(), function(data, status){
			jQuery('#employee_ajax').html(data);
		});
	});
	/* Add data */ /*Form Submit*/
	$("#xin-form").submit(function(e){
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=1&add_type=training&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					var myCalendar = $('#calendar_hr'); 
					myCalendar.fullCalendar();
					var myEvent = {
					  training_id: JSON.re_last_id,
					  unq: '5',	
					  title: JSON.re_type,
					  start: $('#start_date').val(),
					  end: $('#end_date').val(),
					  color: '#ED5564'
					};
					myCalendar.fullCalendar( 'renderEvent', myEvent );
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
					$('.view-modal-data').modal('toggle');
					$('#module-opt').hide();
					window.location = '';
				}
			}
		});
	});
});
</script>
<?php } ?>
