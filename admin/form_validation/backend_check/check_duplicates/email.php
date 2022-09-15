<?php 

	$sql = "select email from $table_name where email = '$email' and id <> '$id'";
	$result = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows > 0){
		header('location:index.php?error=Manufacturer email already exists!');
		exit();
	}