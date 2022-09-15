<?php 
	
	if(empty($_POST['id'])){
		header('location:index.php?error=Invalid ID!');
		exit();
	}

	require_once '../connect.php';

	$id = $_POST['id'];
	$table_name = 'manufacturers';
	require_once '../form_validation/backend_check/check_empty/id.php';

	$sql = "select * from $table_name
			where id = '$id'";
	$result = mysqli_query($connect, $sql);
	require_once '../form_validation/backend_check/query_error.php';
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows < 1){
		header('location:index.php?error=Invalid ID!');
		exit();
	}
	$each = mysqli_fetch_array($result);