<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['tax_id']) && $_GET['data']=='tax'){
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data">Edit Product Tax</h4>
</div>
<?php $attributes = array('name' => 'edit_tax', 'id' => 'edit_tax', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', '_token' => $tax_id);?>
<?php echo form_open('admin/invoices/update_tax/'.$tax_id, $attributes, $hidden);?>
  <div class="modal-body">
    <div class="form-group">
      <label for="tax_name">Tax Name</label>
      <input type="text" class="form-control" name="tax_name" placeholder="Tax Name" value="<?php echo $name;?>">
    </div>
    <div class="form-group">
      <label for="tax_rate">Tax Rate</label>
      <input type="text" class="form-control" name="tax_rate" placeholder="Tax Rate" value="<?php echo $rate;?>">
    </div>
    <div class="form-group">
      <label for="tax_type">Tax Type</label>
      <select class="form-control" name="tax_type" data-plugin="select_hrm" data-placeholder="Tax Type">
        <option value=""></option>
        <option value="fixed" <?php if($type=='fixed'){?> selected="selected"<?php } ?>>Fixed</option>
        <option value="percentage" <?php if($type=='percentage'){?> selected="selected"<?php } ?>>Percentage</option>
      </select>
    </div>
    <div class="form-group">
      <label for="message">Description</label>
      <textarea class="form-control" placeholder="Description" name="description" id="description2"><?php echo $description;?></textarea>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Update</button>
  </div>
<?php echo form_close(); ?>
<script type="text/javascript">
 $(document).ready(function(){
					
		// On page load: datatable
		var xin_table = $('#xin_table').dataTable({
			"bDestroy": true,
			"ajax": {
				url : "<?php echo site_url("admin/invoices/taxes_list") ?>",
				type : 'GET'
			},
			"fnDrawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();          
			}
    	});
		
		$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 
		
		/* Edit data */
		$("#edit_tax").submit(function(e){
		/*Form Submit*/
		e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.save').prop('disabled', true);
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=2&edit_type=tax&form="+action,
				cache: false,
				success: function (JSON) {
					if (JSON.error != '') {
						toastr.error(JSON.error);
						$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
						$('.save').prop('disabled', false);
					} else {
						$('.edit-modal-data').modal('toggle');
						xin_table.api().ajax.reload(function(){ 
							toastr.success(JSON.result);
							$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
						}, true);
						$('.save').prop('disabled', false);				
					}
				}
			});
		});
	});	
  </script>
<?php }
?>
