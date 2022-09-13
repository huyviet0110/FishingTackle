<?php 

	$sql = "select email from $table_name where email = '$email'";
	$result = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows === 1){
		header('location:index.php?error=Manufacturer email already exists!');
		exit();
	}