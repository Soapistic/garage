<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BetterPlanner</title>
</head>
<body>

	<?php 
	$currentData = date('Y-m-d');
	?>

	<style>
		html {
			font-family: Arial;
		}
	</style>
		

	<!-- Calendar Container -->
	<div id='calendar-container'>
    	<div id='calendar'></div>
  	</div>

  	<!-- jQuery -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

  	<!-- Fullcalendar  -->
	<script type="text/javascript" src="fullcalendar/dist/index.global.min.js"></script>

	<!-- Sweetalert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
	document.addEventListener('DOMContentLoaded', function() {
	    var calendarEl = document.getElementById('calendar');

	    var calendar = new FullCalendar.Calendar(calendarEl, {
	      	initialDate: '<?= $currentData ?>',
	      	height: '600px',
	      	selectable: true,
	      	editable: true,
	      	dayMaxEvents: true, // allow "more" link when too many events
	      	events: 'fetchevents.php', // Fetch all events
	      	select: function(arg) { // Create Event
	        	
	        	// Alert box to add event
		        Swal.fire({
				  	title: 'Add New Event',
					showCancelButton: true,
					confirmButtonText: 'Create',
				  	html:
				    '<input id="eventtitle" class="swal2-input" placeholder="Event name" style="width: 84%;"  >' +
				    '<textarea id="eventdescription" class="swal2-input" placeholder="Event description" style="width: 84%; height: 100px;"></textarea>',
				  	focusConfirm: false,
				  	preConfirm: () => {
					    return [
					      	document.getElementById('eventtitle').value,
					      	document.getElementById('eventdescription').value
					    ]
				  	}
				}).then((result) => {
				  
				  	if (result.isConfirmed) {
				    	
				    	var title = result.value[0].trim();
				    	var description = result.value[1].trim();
				    	var start_date = arg.startStr;
				    	var end_date = arg.endStr;

				    	if(title != '' && description != ''){

				    		// AJAX - Add event
				    		$.ajax({
						  		url: 'ajaxfile.php',
						  		type: 'post',
						  		data: {request: 'addEvent',title: title,description: description,start_date: start_date,end_date: end_date},
						  		dataType: 'json',
						  		success: function(response){

						  			if(response.status == 1){

						  				// Add event
						  				calendar.addEvent({
								            eventid: response.eventid,
								            title: title,
								            description: description,
								            start: arg.start,
								            end: arg.end,
								            allDay: arg.allDay
							          	}) 

							          	// Alert message
						  				Swal.fire(response.message,'','success');

						  			}else{
						  				// Alert message
						  				Swal.fire(response.message,'','error');
						  			}
						  			
						  		}
						  	});
				    	}
				    	
				  	}
				})

	        	calendar.unselect()
	      	},
	      	eventDrop: function (event, delta) { // Move event

	      		// Event details
	      		var eventid = event.event.extendedProps.eventid;
	      		var newStart_date = event.event.startStr;
	      		var newEnd_date = event.event.endStr;
	           	
	           	// AJAX request
	           	$.ajax({
					url: 'ajaxfile.php',
					type: 'post',
					data: {request: 'moveEvent',eventid: eventid,start_date: newStart_date, end_date: newEnd_date},
					dataType: 'json',
					async: false,
					success: function(response){

						console.log(response);
									
					}
				}); 

	        },
	      	eventClick: function(arg) { // Edit/Delete event
	      		
	      		// Event details
	      		var eventid = arg.event._def.extendedProps.eventid;
	      		var description = arg.event._def.extendedProps.description;
	      		var title = arg.event._def.title;

	      		// Alert box to edit and delete event
	      		Swal.fire({
				  	title: 'Edit Event',
				  	showDenyButton: true,
					showCancelButton: true,
					confirmButtonText: 'Update',
					denyButtonText: 'Delete',
				  	html:
				    '<input id="eventtitle" class="swal2-input" placeholder="Event name" style="width: 84%;" value="'+ title +'" >' +
				    '<textarea id="eventdescription" class="swal2-input" placeholder="Event description" style="width: 84%; height: 100px;">' + description + '</textarea>',
				  	focusConfirm: false,
				  	preConfirm: () => {
					    return [
					      	document.getElementById('eventtitle').value,
					      	document.getElementById('eventdescription').value
					    ]
				  	}
				}).then((result) => {
				  
				  	if (result.isConfirmed) { // Update
				    	
				    	var newTitle = result.value[0].trim();
				    	var newDescription = result.value[1].trim();

				    	if(newTitle != '' && newDescription != ''){

				    		// AJAX - Edit event
				    		$.ajax({
								url: 'ajaxfile.php',
								type: 'post',
								data: {request: 'editEvent',eventid: eventid,title: newTitle, description: newDescription},
								dataType: 'json',
								async: false,
								success: function(response){

									if(response.status == 1){
										
										// Refetch all events
										calendar.refetchEvents();

										// Alert message
										Swal.fire(response.message, '', 'success');
									}else{

										// Alert message
										Swal.fire(response.message, '', 'error');
									}
										
								}
							}); 
				    	}
				    	
				  	} else if (result.isDenied) { // Delete

				  		// AJAX - Delete Event
				    	$.ajax({
							url: 'ajaxfile.php',
							type: 'post',
							data: {request: 'deleteEvent',eventid: eventid},
							dataType: 'json',
							async: false,
							success: function(response){

								if(response.status == 1){

									// Remove event from Calendar
									arg.event.remove();

									// Alert message
									Swal.fire(response.message, '', 'success');
								}else{

									// Alert message
									Swal.fire(response.message, '', 'error');
								}
									
							}
						}); 
				  	}
				})
	      		
	      	}
	    });

	    calendar.render();
	});

	</script>
</body>
</html>