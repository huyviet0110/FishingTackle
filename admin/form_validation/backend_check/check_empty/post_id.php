<?php 
	
	if(empty($_POST['id'])){
		header('location:' . $form_file_name . '?error=Invalid ID!');
		exit();
	}
	$id = $_POST['id'];