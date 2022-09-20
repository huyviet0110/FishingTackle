<?php
	
	require_once '../connect.php';

	$table_name = 'manufacturers';
	$table_name_display = 'manufacturer';
	require_once '../form_validation/backend_check/check_empty/id_post.php';
	require_once '../form_validation/backend_check/check_empty/id.php';
	require_once '../form_validation/backend_check/old_image.php';
	require_once '../form_validation/backend_check/page_post.php';
	
	$form_file_name = 'form_update.php?id=' . $id . '&';
	require_once '../form_validation/backend_check/check_error.php';
	if(!empty($_FILES['image']['tmp_name'])){
		require_once '../form_validation/backend_check/image.php';
	}
	require_once '../form_validation/backend_check/name.php';
	require_once '../form_validation/backend_check/description.php';
	require_once '../form_validation/backend_check/phone_number.php';
	require_once '../form_validation/backend_check/address.php';
	require_once '../form_validation/backend_check/email.php';

	require_once '../form_validation/backend_check/check_duplicates/name.php';
	require_once '../form_validation/backend_check/check_duplicates/email.php';

	$sql = "update $table_name
			set
				image = '$file_name',
				name = '$name',
				description = '$description',
				phone_number = '$phone_number',
				address = '$address',
				email = '$email'
			where id = '$id'";
	mysqli_query($connect, $sql);
	require_once '../form_validation/backend_check/query_error.php';

	mysqli_close($connect);

	if(!empty($_FILES['image']['tmp_name'])){
		move_uploaded_file($file['tmp_name'], $target_file);
		unlink($file_name_old);
	}

	header("location:index.php?success=Successfully updated $table_name_display!&page=$page");