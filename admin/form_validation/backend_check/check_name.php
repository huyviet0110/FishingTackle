<?php 

	$name = $_POST['name'];
	$regex = "/^(?:[ ]?(?:\w{1,20}))+$/";

	if(!preg_match($regex, $name)){
		header('location:index.php?error=Wrong name format!');
		exit();
	}

	if(strlen($name) > 100){
		header('location:index.php?error=Name cannot exceed 100 characters!');
		exit();
	}