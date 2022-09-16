<?php 

	if(empty($_POST['description'])){
		header('location:index.php?error=Description cannot be empty!');
		exit();
	}

	$description = mysqli_real_escape_string($connect, $_POST['description']);
	if(strlen($description) > 500){
		header('location:index.php?error=Description cannot exceed 500 characters!');
		exit();
	}