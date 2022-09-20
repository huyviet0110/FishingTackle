<?php 

	$error = mysqli_error($connect);
	if(!empty($error)){
		header('Location:' . $form_file_name . 'error=Query error!');
		exit();
	}