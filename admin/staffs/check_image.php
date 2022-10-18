<?php 
	
	if(empty($_FILES['avatar']['name'])){
		header('Location:' . $form_file_name . 'error=You must upload image file!');
		exit();
	}
	
	$file = $_FILES['avatar'];
	$folder = 'avatars/';
	$file_element_array = explode('.', $file['name']);
	$file_extension = end($file_element_array);

	$images_extensions_allowed = array('png', 'jpg', 'jpec', 'gif');
	if(!in_array($file_extension, $images_extensions_allowed)) {
		header('Location:' . $form_file_name . '&error=The image file is not in the correct format!');
		exit();
	}
	
	$file_name = time() . '.' . $file_extension;
	$target_file = $folder . $file_name;
	