<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['application_id']) && $_GET['data']=='view_application'){
	$result = $this->Job_post_model->read_job_information($job_id);
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('xin_jobs_cover_letter_for').' '.$result[0]->job_title;?></h4>
</div>
<form class="m-b-1">
  <div class="modal-body" style="overflow: auto; height: 430px;">
    <table class="footable-details table table-striped table-hover toggle-circle">
      <tbody>
        <tr>
          <td style="display: table-cell;"><?php echo html_entity_decode($message);?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('xin_close');?></button>
  </div>
<?php echo form_close(); ?>
<?php }
?>
