<?php
	include('database.class.php');
	include('property.class.php');

	$database = new DB();
	$property = new Property($database->get_conn());
	echo $property->find_property_by_id(182);
	
?>

