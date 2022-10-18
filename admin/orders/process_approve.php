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

	if(empty($_GET['id'])){
		header('location:index.php?error=Invalid ID!');
		exit();
	}

	$id = $_GET['id'];

	require_once '../connect.php';
	$sql = "select id from orders
			where id = '$id'";
	$result = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows === 0){
		header('location:index.php?error=Invalid ID!');
		exit();
	}

	$page = 1;
	if(!empty($_GET['page']) && is_numeric($_GET['page'])){
		$page = $_GET['page'];
	}

	$sql = "update orders
			set 
				status = 1
			where id = '$id'";
	mysqli_query($connect, $sql);

	header("location:index.php?page=$page");