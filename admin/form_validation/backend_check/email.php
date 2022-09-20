<?php 
	
	if(empty($_POST['email'])){
		header('Location:' . $form_file_name . 'error=Email cannot be empty!');
		exit();
	}

	$email = mysqli_real_escape_string($connect, $_POST['email']);
	$email = trim($email);
	$input_name = 'Email';
	$regex = "/^\w+@\w+(?:.\w+)*$/";
	$number_of_characters = 100;

	check_error($form_file_name, $email, $input_name, $regex, $number_of_characters);
