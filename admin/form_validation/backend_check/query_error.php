<?php 

	$error = mysqli_error($connect);
	if(!empty($error)){
		header('Location:index.php?error=Query error!');
		exit();
	}