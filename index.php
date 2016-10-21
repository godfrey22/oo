<?php
	include('database.class.php');
	include('property.class.php');
	include('property_feature.class.php');
	include('property_type.class.php');

	$database = new DB();
	$property = new Property($database->get_conn());
	$property_feature = new Property_Feature($database->get_conn());
	$property_type = new Property_Type($database->get_conn());


	$where=array();
	$where['NAME']='Parking';
	print_r($property_feature->find([$where]));

?>

