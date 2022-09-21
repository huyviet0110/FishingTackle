<?php
	
	require_once '../connect.php';

	$table_name = 'styles';
	$table_name_display = 'style';
	require_once '../form_validation/backend_check/check_empty/id_post.php';
	require_once '../form_validation/backend_check/check_empty/id.php';
	require_once '../form_validation/backend_check/page_post.php';
	
	$form_file_name = 'form_update.php?id=' . $id . '&';
	require_once '../form_validation/backend_check/old_image.php';
	if(!empty($_FILES['image']['tmp_name'])){
		require_once '../form_validation/backend_check/image.php';
	}
	require_once '../form_validation/backend_check/check_error.php';
	require_once '../form_validation/backend_check/name.php';

	require_once '../form_validation/backend_check/check_duplicates/name.php';

	$sql = "update $table_name
			set
				image = '$file_name',
				name = '$name'
			where id = '$id'";
	mysqli_query($connect, $sql);
	require_once '../form_validation/backend_check/query_error.php';

	mysqli_close($connect);

	if(!empty($_FILES['image']['tmp_name'])){
		unlink($file_name_old);
		move_uploaded_file($file['tmp_name'], $target_file);
	}

	header("location:index.php?success=Successfully updated $table_name_display!&page=$page");