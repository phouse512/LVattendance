<?php
	session_start();
	$connection = mysqli_connect('localhost', 'nuaaivco_event', 'pmh518', 'nuaaivco_events');

	$query = "SELECT * FROM events WHERE event_id=" . $_SESSION["event_id"] . " LIMIT 1";
	$res = mysqli_query($connection, $query);
	$rows = mysqli_fetch_array($res, MYSQLI_ASSOC);	

	$output = "<div class='event_id' id='" . $rows['event_id'] . "'>Currently tracking for " . $rows['event_name'] . " " . $rows['event_date'] . "</div>";
	echo $output;
?>