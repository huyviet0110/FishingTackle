<?php 

	function check_error($form_file_name, $input, $input_name, $regex, $number_of_characters){

		if(empty($_POST[$input])){
			header('Location:' . $form_file_name . '?error=' . $input_name . ' cannot be empty!');
			exit();
		}

		// $input = $_POST[$input];
		// $input = mysqli_real_escape_string($connect, $_POST);

		if(!preg_match($regex, $_POST[$input])){
			header('Location:' . $form_file_name . '?error=Wrong ' . $input_name . ' format!');
			exit();
		}

		if(strlen($_POST[$input]) > $number_of_characters){
			header('Location:' . $form_file_name . '?error=' . $input_name . ' cannot exceed ' . $number_of_characters . ' characters!');
			exit();
		}
		
	}