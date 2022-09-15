<?php 

	if(empty($_POST['id'])){
		header('location:index.php?error=ID cannot be empty!');
		exit();
	}
	
	require_once '../connect.php';

	$id = $_POST['id'];
	$page = 1;
	if(empty($_POST['page'])){
		$page = $_POST['page'];
	}
	$table_name = 'manufacturers';
	
	require_once '../form_validation/backend_check/check_empty/id.php';
	require_once '../form_validation/backend_check/old_image.php';

	$sql = "delete from manufacturers
			where id = '$id'";
	mysqli_query($connect, $sql);
	require_once '../form_validation/backend_check/query_error.php';

	unlink($file_name_old);

	mysqli_close($connect);

	header("location:index.php?success=Successfully deleted the manufacturer!&page=$page");