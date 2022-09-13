<?php 

	if(empty($_POST['id'])){
		header('location:index.php?error=Invalid ID');
		exit();
	}

	if(empty($_POST['image'])){
		header('location:index.php?error=Invalid image');
		exit();
	}

	$id = $_POST['id'];
	$file_name = $_POST['image'];
	$folder = 'images/';
	$image_files_need_to_be_deleted = $folder . $file_name;

	require_once '../connect.php';

	$sql = "delete from manufacturers
			where id = '$id'";
	mysqli_query($connect, $sql);

	$error = mysqli_error($connect);
	if(!empty($error)){
		header('location:index.php?error=Query error!');
		exit();
	}

	unlink($image_files_need_to_be_deleted);

	mysqli_close($connect);

	header('location:index.php?success=Successfully deleted the manufacturer!');