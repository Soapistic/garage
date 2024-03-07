<?php 

include "config.php";

$request = "";

// Read $_GET value
if(isset($_POST['request'])){
	$request = $_POST['request'];
}

// Add New event 
if($request == 'addEvent'){

	// POST data
	$title = ""; $description = ""; 
	$start_date = ""; $end_date = "";

	if(isset($_POST['title'])){
		$title = $_POST['title'];
	}
	if(isset($_POST['description'])){
		$description = $_POST['description'];
	}
	if(isset($_POST['start_date'])){
		$start_date = $_POST['start_date'];
	}
	if(isset($_POST['start_date'])){
		$end_date = $_POST['end_date'];
	}

	$response = array();
	$status = 0;
	if(!empty($title) && !empty($description) && !empty($start_date) && !empty($end_date) ){

		// Insert record
		$sql = "INSERT INTO events(title,description,start_date,end_date) VALUES('".$title."','".$description."','".$start_date."','".$end_date."')";
		if(mysqli_query($con,$sql)){
			$eventid = mysqli_insert_id($con);

			$status = 1;

			$response['eventid'] = $eventid;
			$response['status'] = 1;
			$response['message'] = 'Event created successfully.';
		}
	}	

	if($status == 0){
		$response['status'] = 0;
		$response['message'] = 'Event not created.';
	}
	
	echo json_encode($response);
	exit;
}

// Move event
if($request == 'moveEvent'){

	// POST data
	$eventid = 0; 
	$start_date = ""; $end_date = "";

	if(isset($_POST['eventid']) && is_numeric($_POST['eventid'])){
		$eventid = $_POST['eventid'];
	}
	if(isset($_POST['start_date'])){
		$start_date = $_POST['start_date'];
	}
	if(isset($_POST['end_date'])){
		$end_date = $_POST['end_date'];
	}
	
	$response = array();
	$status = 0;

	if($eventid > 0 && !empty($start_date) && !empty($end_date) ){

		// Check event id
		$sql = "SELECT id FROM events WHERE id=".$eventid;
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)){
			// Update record
			$sql = "UPDATE events SET start_date='".$start_date."',end_date='".$end_date."' WHERE id=".$eventid;
			if(mysqli_query($con,$sql)){
				$status = 1;

				$response['status'] = 1;
				$response['message'] = 'Event date updated successfully.';
			}
		}
		
	}

	if($status == 0){
		$response['status'] = 0;
		$response['message'] = 'Event date not updated.';
	}	

	echo json_encode($response);
	exit;
}

// Update event
if($request == 'editEvent'){

	// POST data
	$eventid = 0;
	if(isset($_POST['eventid']) && is_numeric($_POST['eventid'])){
		$eventid = $_POST['eventid'];
	}
	if(isset($_POST['title'])){
		$title = $_POST['title'];
	}
	if(isset($_POST['description'])){
		$description = $_POST['description'];
	}
	
	$response = array();

	if($eventid > 0 && !empty($title) && !empty($description)){

		// Check event id
		$sql = "SELECT id FROM events WHERE id=".$eventid;
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)){

			// Update record
			$sql = "UPDATE events SET title='".$title."', description='".$description."' WHERE id=".$eventid;
			if(mysqli_query($con,$sql)){

				$status = 1; 

				$response['status'] = 1;
				$response['message'] = 'Event updated successfully.';
			}
		}
		
	}

	if($status == 0){
		$response['status'] = 0;
		$response['message'] = 'Event not updated.';
	}

	echo json_encode($response);
	exit;
}

// Delete Event
if($request == 'deleteEvent'){

	// POST data
	$eventid = 0;
	if(isset($_POST['eventid']) && is_numeric($_POST['eventid'])){
		$eventid = $_POST['eventid'];
	}

	$response = array();
	$status = 0;

	if($eventid > 0){

		// Check event id
		$sql = "SELECT id FROM events WHERE id=".$eventid;
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)){

			// Delete record
			$sql = "DELETE FROM events WHERE id=".$eventid;
			if(mysqli_query($con,$sql)){
				$status = 1;

				$response['status'] = 1;
				$response['message'] = 'Event deleted successfully.';
			}
		}
		
	}
	
	if($status == 0){
		$response['status'] = 0;
		$response['message'] = 'Event not deleted.';
	}

	echo json_encode($response);
	exit;
}