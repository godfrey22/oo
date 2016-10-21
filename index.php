<?php
	include('model/database.class.php');
	include('model/property.class.php');
	include('model/property_feature.class.php');
	include('model/property_type.class.php');
	include('controller/SearchController.php');

	$database = new DB();
	$property = new Property($database->get_conn());
	$property_feature = new Property_Feature($database->get_conn());
	$property_type = new Property_Type($database->get_conn());

	$search = new SearchController($database->get_conn());


	$where['SUBURB'] = 'Huntingdale';
    $where['TYPE_ID'] = '103';
    print_r($property->find($where));
	//print_r($property_feature->find_property_feature_by_id(1));
	//print_r($property->find_property_by_id(170));


?>

