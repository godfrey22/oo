<?php
	include('model/database.class.php');
	include('model/property.class.php');

	$database = new DB();
	$property = new Property($database->get_conn());


	$where=array();
	$where['SUBURB']='huntingdale';
	var_dump($where);
	echo "<br>";
	//$where['TYPE_ID'] = '103';
	print_r($property->find([$where]));

?>

