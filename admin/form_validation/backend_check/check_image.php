<?php 
	
	$file = $_FILES['image'];
	$folder = 'images/';
	$file_element_array = explode('.', $file['name']);
	$file_extension = end($file_element_array);

	$images_extensions_allowed = array('png', 'jpg', 'jpec', 'gif');
	if(!in_array($file_extension, $images_extensions_allowed)) {
		header('location:index.php?error=The image file is not in the correct format!');
		exit();
	}
	
	$file_name = time() . '.' . $file_extension;
	$target_file = $folder . $file_name;
	