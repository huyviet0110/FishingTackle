<?php 

	session_start();
	if(empty($_SESSION['admin_id'])){
		header('location:../index.php');
		exit();
	}

	if($_SESSION['admin_level'] === 1){
		header('location:../admin_page.php');
		exit();
	}

	if(empty($_POST['id'])){
		echo 0;
		exit();
	}
	$id = $_POST['id'];
	
	require_once '../connect.php';

	$table_name = 'sizes';
	$sql = "select id from $table_name where id = '$id'";
	$result = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows < 1){
		echo 0;
		exit();
	}

	$sql = "delete from $table_name
			where id = '$id'";
	mysqli_query($connect, $sql);
	$error = mysqli_error($connect);
	if(!empty($error)){
		echo 0;
		exit();
	}

	mysqli_close($connect);

	echo 1;