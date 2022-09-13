<?php 

	$error = mysqli_error($connect);
	if(!empty($error)){
		header('location:index.php?error=Query error!');
		exit();
	}