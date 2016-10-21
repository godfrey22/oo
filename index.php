<?php
	include('database.class.php');
	include('property.class.php');

	$database = new DB();
	$property = new Property($database->get_conn());


	$where=array();
	$where['SUBURB']='huntingdale';
	print_r($property->find([$where]));

?>

