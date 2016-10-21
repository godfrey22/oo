<?php
	include('database.php');
	$database = new DB();
	if($database->connDB()){
		echo "success";
	}else{
		echo "fail";
	}
?>

