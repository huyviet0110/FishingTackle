<?php 
	
	if(empty($_POST['email'])){
		header('location:index.php?error=Email cannot be empty!');
		exit();
	}

	$email = $_POST['email'];

	if(strlen($email) > 100){
		header('location:index.php?error=Email cannot exceed 100 characters!');
		exit();
	}