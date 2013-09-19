<?php
	$array = $_POST['currentArray'];
	$first_name = $_POST['first'];
	$last_name = $_POST['last'];
	$event_id = $_POST['eventID'];
	$year = $_POST['study'];
	$dorm = $_POST['dorm'];
	$email = $_POST['email'];

	$fields = array('first_name', 'last_name', 'year', 'email');
	$conditions = array();

	foreach($fields as $field){
		if(isset($_POST[$field]) && $_POST[$field] != ''){
			$conditions[] = "`$field` LIKE '" . $_POST[$field] . "%'";
		}
	}

    $query = "SELECT * FROM users ";
    // if there are conditions defined
    if(count($conditions) > 0) {
        // append the conditions
        $query .= "WHERE " . implode (' AND ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
    }

    $query .= " LIMIT 10";
   	$connection = mysqli_connect('localhost', 'nuaaivco_event', 'pmh518', 'nuaaivco_events');
   	$res = mysqli_query($connection, $query);


	echo $query;
	
	

?>