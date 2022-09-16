<?php 

	$sql = "select name from $table_name where name = '$name' and id <> '$id'";
	$result = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows > 0){
		header('location:' . $form_file_name . '?error=Manufacturer name already exists!');
		exit();
	}