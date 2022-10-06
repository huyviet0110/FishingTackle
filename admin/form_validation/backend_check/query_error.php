<?php 

	$error = mysqli_error($connect);
	if(!empty($error)){
		header('Location:index.php?error=Query error, please try again!');
		exit();
		// echo $error;die();
	}