<?php 
	
	$sql = "select id from $table_name where id = '$id'";
	$result = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows < 1){
		header('location:' . $form_file_name . '?error=Invalid ID!');
		exit();
	}