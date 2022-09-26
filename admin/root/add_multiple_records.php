<?php 

	require 'get_id_max.php';

	for ($i = 0; $i < count($array_input); $i++, $id++) { 

		if(empty($array_input[$i]) || empty($file_input['tmp_name'][$i])){
			continue;
		}
		
		array_push($array_id, $id);
		$file = $file_input;
		require 'image_insert.php';
		move_uploaded_file($file['tmp_name'][$i], $target_file);

		$sql = "insert into $table_name (id, image, name)
				values ('$id', '$file_name', '$array_input[$i]')";
		mysqli_query($connect, $sql);
		require '../form_validation/backend_check/query_error.php';

	}