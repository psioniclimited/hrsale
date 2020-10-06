<?php $system = $this->Xin_model->read_setting_info(1); ?>
<?php
if(isset($_POST['set_date'])){
	$set_date = $_POST['set_date'];
} else {
	$set_date = date('Y-m-d');
}
?>
<script type="text/javascript">
$(document).ready(function(){
	
	/* initialize the calendar
	-----------------------------------------------------------------*/
	$('#calendar_hr').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek'
		},
		views: {
			listDay: { buttonText: 'list day' },
			listWeek: { buttonText: 'list week' }
		  },
		eventRender: function(event, element) {
		element.attr('title',event.title).tooltip();
		element.attr('href', event.urllink);
		},
		defaultDate: '<?php echo $set_date;?>',
		eventLimit: false, // allow "more" link when too many events
		navLinks: true, // can click day/week names to navigate views
		events: [
			<?php foreach($all_projects->result() as $projects):?>
			{
				title: '<?php echo $projects->title;?>',
				start: '<?php echo $projects->start_date?>',
				end: '<?php echo $projects->end_date?>',
				urllink: '<?php echo site_url().'admin/project/detail/'.$projects->project_id;?>',
				color: '#F8B195'
			},
			<?php endforeach;?>
			<?php foreach($all_tasks->result() as $tasks):?>
			{
				title: '<?php echo $tasks->task_name;?>',
				start: '<?php echo $tasks->start_date?>',
				end: '<?php echo $tasks->end_date?>',
				urllink: '<?php echo site_url().'admin/timesheet/task_details/id/'.$tasks->task_id;?>',
				color: '#6C5B7B'
			},
			<?php endforeach;?>
		]
	});
	
	/* initialize the external events
	-----------------------------------------------------------------*/

	$('#external-events .fc-event').each(function() {

		// Different colors for events
        $(this).css({'backgroundColor': $(this).data('color'), 'borderColor': $(this).data('color')});

		// store data so the calendar knows to render an event upon drop
		$(this).data('event', {
			title: $.trim($(this).text()), // use the element's text as the event title
			color: $(this).data('color'),
			stick: true // maintain when user navigates (see docs on the renderEvent method)
		});

	});


});
</script>