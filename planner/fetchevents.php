<?php 

include "config.php";
$sql = "SELECT * FROM events";
$eventsList = mysqli_query($con,$sql);
	
$response = array();
while($row = mysqli_fetch_assoc($eventsList)){
	$response[] = array(
		"eventid" => $row['id'],
		"title" => $row['title'],
		"description" => $row['description'],
		"start" => $row['start_date'],
		"end" => $row['end_date'],
	);
}

echo json_encode($response);
exit;