<?php 

	$sql = "select email from $table_name where email = '$email' and id <> '$id'";
	$result = mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows > 0){
		header('location:' . $form_file_name . 'error=' . $table_name_display . "'s email already exists!");
		exit();
	}