<?php 
	
	$sql = "select name from $table_name where name = '$name' and id <> '$id'";
	$result = mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows > 0){
		header('location:' . $form_file_name . 'error=' . $table_name_display . "'s name already exists!");
		exit();
	}