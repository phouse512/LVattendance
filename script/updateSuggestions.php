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
	
	$xml = new XMLWriter();

	$xml->openURI("php://output");
	$xml->startDocument();
	$xml->setIndent(true);

	$xml->startElement('users');

	while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		$xml->startElement("user");

		$xml->startElement("user_id");
		$xml->writeRaw($row['user_id']);
		$xml->endElement();

		$xml->startElement("first_name");
		$xml->writeRaw($row['first_name']);
		$xml->endElement();

		$xml->startElement("last_name");
		$xml->writeRaw($row['last_name']);
		$xml->endElement();

		$xml->startElement("year");
		$xml->writeRaw($row['year']);
		$xml->endElement();

		$xml->startElement("email");
		$xml->writeRaw($row['email']);
		$xml->endElement();

		$xml->startElement("dorm");
		$xml->writeRaw($row['dorm']);
		$xml->endElement();

		$xml->endElement();
	}
	$xml->endElement();
	header('Content-type: text/xml');
	$xml->flush(); 
?>