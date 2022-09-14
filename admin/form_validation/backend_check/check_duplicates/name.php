<?php 

	$sql = "select name from $table_name where name = '$name' and id <> '$id'";
	$result = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows === 1){
		header('location:index.php?error=Manufacturer name already exists!');
		exit();
	}