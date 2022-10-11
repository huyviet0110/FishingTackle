<?php 
	
	if(empty($_POST['description'])){
		header('Location:' . $form_file_name . 'error=Description cannot be empty!');
		exit();
	}

	$description = mysqli_real_escape_string($connect, $_POST['description']);
	$description = trim($description);
	$input_name = 'Description';
	$regex = "/^(?:(?:.{1,20})(?: .{1,20})?|[\n])*$/";
	$number_of_characters = 5000;

	check_error($form_file_name, $description, $input_name, $regex, $number_of_characters);
