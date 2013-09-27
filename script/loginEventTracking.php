<?php
	session_start();

	$username = $_POST['userName'];
	$pw = $_POST['password'];
	$event_id = $_POST['eventID'];
	
	$connection = mysqli_connect('localhost', 'nuaaivco_event', 'pmh518', 'nuaaivco_events');

	$query = "SELECT * FROM admins WHERE username = '" . $username . "' AND password = '" . $pw . "' LIMIT 1";
	$res = mysqli_query($connection, $query);
	$rows = mysqli_fetch_array($res, MYSQLI_ASSOC);	

	if (mysqli_num_rows($res) == 1){
		//login successful
		$_SESSION["valid_id"] = $rows['admin_id'];
		$_SESSION["attendance_login"] = $username;
		$_SESSION["event_id"] = $event_id;
		$_SESSION["valid_time"] = time();

		echo "success";
	} else {
		echo "fail";
	}
?>