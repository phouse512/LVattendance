<?php
	$connection = mysqli_connect('localhost', 'nuaaivco_event', 'pmh518', 'nuaaivco_events');
	// host username pwd dbname
	$sql = "SELECT * FROM events";
	$res = mysqli_query($connection, $sql);

	$xml = new XMLWriter();

	$xml->openURI("php://output");
	$xml->startDocument();
	$xml->setIndent(true);

	$xml->startElement('events');

	while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
	  $xml->startElement("event");

	  $xml->startElement("event_id");
	  $xml->writeRaw($row['event_id']);
	  $xml->endElement();

	  $xml->startElement("event_name");
	  $xml->writeRaw($row['event_name']);
	  $xml->endElement();

	  $xml->startElement("event_date");
	  $xml->writeRaw($row['event_date']);
	  $xml->endElement();

	  $xml->endElement();
	}
	$xml->endElement();
	header('Content-type: text/xml');
	$xml->flush();
?>