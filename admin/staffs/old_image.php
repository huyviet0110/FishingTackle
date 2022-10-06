<?php 

	$sql = "select avatar from $table_name
			where id = '$id'";
	$result = mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows < 1){
		header('Location:index.php?error=Cannot delete old image!');
		exit();
	}

	$folder = 'images/';
	$each = mysqli_fetch_array($result);
	$file_name = $each['avatar'];
	$file_name_old = $folder . $file_name;