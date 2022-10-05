<?php 
	
	function check_error($form_file_name, $input, $input_name, $regex, $number_of_characters){

		if(preg_match($regex, $input) === 0){
			header('Location:' . $form_file_name . 'error=Wrong ' . $input_name . ' format!');
			exit();
		} 

		if(strlen($input) > $number_of_characters){
			header('Location:' . $form_file_name . '&error=' . $input_name . ' cannot exceed ' . $number_of_characters . ' characters!');
			exit();
		}
		
	}