<?php

	require_once '../connect.php';
	
	$form_file_name = 'form_insert.php?';
	require_once '../form_validation/backend_check/page_post.php';
	require_once '../form_validation/backend_check/image.php';
	require_once '../form_validation/backend_check/check_error.php';
	require_once '../form_validation/backend_check/name.php';
	require_once '../form_validation/backend_check/description.php';

	$table_name = 'products';
	$table_name_display = 'product';
	require_once '../form_validation/backend_check/check_duplicates/name.php';

	$manufacturer_id = $_POST['manufacturer_id'];
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
	$types_id = $_POST['types_id'];
	$sizes_id= $_POST['sizes_id'];
	$colors = $_POST['color'];
	$styles = $_POST['style'];
	$options = $_POST['option'];
	$file_color_images = $_FILES['color_image'];
	$file_style_images = $_FILES['style_image'];
	$file_option_images = $_FILES['option_image'];
	$sub_images = $_FILES['sub_image'];

	$colors_id = array();
	$styles_id = array();
	$options_id = array();

	require 'get_id_max.php';
	$product_id = $id;
	$sql = "insert into $table_name (id, image, name, description, manufacturer_id)
			values ('$product_id', '$file_name', '$name', '$description', '$manufacturer_id')";
	mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';

	for ($i = 0; $i < count($types_id); $i++) { 
		$sql = "insert into products_types (type_id, product_id)
				values ('$types_id[$i]', '$product_id')";
		mysqli_query($connect, $sql);
		require '../form_validation/backend_check/query_error.php';
	}

	move_uploaded_file($file['tmp_name'], $target_file);

	$file = $sub_images;
	$folder = 'sub_images/';
	for ($i=0; $i < count($file['tmp_name']); $i++) { 
		if(empty($file['tmp_name'][$i])){
			continue;
		}

		require 'image_insert.php';
		move_uploaded_file($file['tmp_name'][$i], $target_file);

		$sql = "insert into sub_images (image, product_id)
				values ('$file_name', '$product_id')";
		mysqli_query($connect, $sql);

	}

	$table_name = 'colors';
	$array_input = $colors;
	$array_id = $colors_id;
	$file_input = $file_color_images;
	$folder = 'color_images/';
	require '../root/add_multiple_records.php';
	$colors_id = $array_id;

	$table_name = 'styles';
	$array_input = $styles;
	$array_id = $styles_id;
	$file_input = $file_style_images;
	$folder = 'style_images/';
	require '../root/add_multiple_records.php';
	$styles_id = $array_id;

	$table_name = 'options';
	$array_input = $options;
	$array_id = $options_id;
	$file_input = $file_option_images;
	$folder = 'option_images/';
	require '../root/add_multiple_records.php';
	$options_id = $array_id;

	$array_count = array(count($colors_id), count($styles_id), count($options_id), count($sizes_id));
	$max_count = max($array_count);

	if($max_count < 1) {
		$sql = "insert into products_detail (product_id, color_id, style_id, option_id, size_id, price, quantity)
				values ('$product_id', null, null, null, null, '$price', '$quantity')";
		mysqli_query($connect, $sql);
	} else {
		for ($i_1 = 0; $i_1 < $max_count; $i_1++) { 
			for ($i_2 = 0; $i_2 < $max_count; $i_2++) { 
				for ($i_3 = 0; $i_3 < $max_count; $i_3++) { 
					for ($i_4 = 0; $i_4 < $max_count; $i_4++) { 

						$sql = "insert into products_detail (product_id, color_id, style_id, option_id, size_id, price, quantity)
						values ('$product_id', '$colors_id[$i_1]', '$styles_id[$i_2]', '$options_id[$i_3]', '$sizes_id[$i_4]', '$price', '$quantity')";
						mysqli_query($connect, $sql);
						
					}
				}
			}
		}
	}

	
	$table_name = 'products';
	require_once '../root/increase_page_after_insert_to_display.php';

	mysqli_close($connect);
	
	header("location:index.php?success=Successfully added $table_name_display!&page=$page");