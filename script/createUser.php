<?php
	$userEmail = $_POST['email'];
	$firstName = $_POST['first'];
	$lastName = $_POST['last'];
	$year = $_POST['study'];
	$dorm = $_POST['dorm'];
	$eventID = $_POST['eventID'];

	$connection = mysqli_connect('localhost', 'nuaaivco_event', 'pmh518', 'nuaaivco_events');

	$sql = "INSERT INTO users (first_name, last_name, year, email, dorm) VALUES ('". $firstName . "', '". $lastName ."', '". $year ."', '". $userEmail ."', '". $dorm ."')";
	if ($res = mysqli_query($connection, $sql)){
		//echo "successful insert " . mysqli_insert_id($connection);
		$user_id = mysqli_insert_id($connection);

		$sql_attendance = "INSERT INTO attendance (user_id, event_id, status, first_time) VALUES(". $user_id .", ". $eventID .", 1, 1)";
		if($res2 = mysqli_query($connection, $sql_attendance)){
			echo "success";
		}
	} else{
		echo 'fail';
	}
?>