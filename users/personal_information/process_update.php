<?php
	
	session_start();
	require_once '../../admin/connect.php';

	if(empty($_POST)){
		header('location:form_update.php');
		exit();
	}

	if(!isset($_SESSION['id'])){
		header('location:../../sign_in.php');
		exit();
	}

	$id = $_SESSION['id'];
	$table_name = 'customers';
	$action = 'update';
	$table_name_display = 'Personal information';
	
	$form_file_name = 'form_update.php?id=' . $id . '&';
	require '../../admin/form_validation/backend_check/check_error.php';
	if(!empty($_FILES['avatar']['tmp_name'])){
		$file = $_FILES['avatar'];
		$folder = 'avatars/';
		$file_element_array = explode('.', $file['name']);
		$file_extension = end($file_element_array);

		$images_extensions_allowed = array('png', 'jpg', 'jpec', 'gif');
		if(!in_array($file_extension, $images_extensions_allowed)) {
			header('Location:' . $form_file_name . '&error=The avatar file is not in the correct format!');
			exit();
		}

		$file_name = time() . '.' . $file_extension;
		$target_file = $folder . $file_name;
	}
	require_once '../../admin/form_validation/backend_check/name.php';
	require_once '../../admin/form_validation/backend_check/phone_number.php';
	require_once '../../admin/form_validation/backend_check/address.php';

	$date_of_birth = $_POST['date_of_birth'];
	$gender = 1;

	if(strcmp($_POST['gender'], 'male') === 0){
		$gender = 1;
	} else if(strcmp($_POST['gender'], 'female') === 0){
		$gender = 0;
	}

	if(!empty($_FILES['avatar']['tmp_name'])){
		$sql = "update $table_name
				set
					avatar = '$file_name',
					name = '$name',
					date_of_birth = '$date_of_birth',
					gender = '$gender',
					phone_number = '$phone_number',
					address = '$address'
				where id = '$id'";
		mysqli_query($connect, $sql);
		require '../../admin/form_validation/backend_check/query_error.php';
	} else {
		$sql = "update $table_name
				set
					name = '$name',
					date_of_birth = '$date_of_birth',
					gender = '$gender',
					phone_number = '$phone_number',
					address = '$address'
				where id = '$id'";
		mysqli_query($connect, $sql);
		require '../../admin/form_validation/backend_check/query_error.php';
	}
	
	move_uploaded_file($file['tmp_name'], $target_file);

	header("location:index.php?success=Successfully updated $table_name_display");