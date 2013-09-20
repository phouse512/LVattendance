<?php
	$user_id = $_POST['userID'];
	$event_id = $_POST['eventID'];

	$connection = mysqli_connect('localhost', 'nuaaivco_event', 'pmh518', 'nuaaivco_events');

	$sql_attendance = "INSERT INTO attendance (user_id, event_id, status) VALUES(". $user_id .", ". $event_id .", 1) ON DUPLICATE KEY UPDATE status=1";
	if($res2 = mysqli_query($connection, $sql_attendance)){
		echo "success";
	}

	echo $sql_attendance;
?>