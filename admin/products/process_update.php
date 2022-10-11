<?php

	require_once '../connect.php';
	require_once '../form_validation/backend_check/page_post.php';

	$table_name = 'products';
	$action = 'update';
	$table_name_display = 'Product detail';
	require_once '../form_validation/backend_check/check_empty/id_post.php';
	require_once '../form_validation/backend_check/check_empty/id.php';
	$product_id = $id;

	require_once '../form_validation/backend_check/old_image.php';
	
	$form_file_name = 'form_update.php?id=' . $id . '&';
	require '../form_validation/backend_check/check_error.php';
	if(!empty($_FILES['image']['tmp_name'])){
		require_once '../form_validation/backend_check/image.php';
		move_uploaded_file($file['tmp_name'], $target_file);
	}
	require_once '../form_validation/backend_check/name.php';
	require_once '../form_validation/backend_check/description.php';

	require_once '../form_validation/backend_check/check_duplicates/name.php';

	if(empty($_POST['name']) || empty($_POST['description']) || empty($_POST['manufacturer_id']) || empty($_POST['price']) || empty($_POST['quantity']) || empty($_POST['types_id'])){
		header('location:' . $form_file_name . 'error=You must fill in all the information!');
		exit();
	}

	$name = $_POST['name'];
	$description = $_POST['description'];
	$manufacturer_id = $_POST['manufacturer_id'];

	$sql = "update products
			set
				image = '$file_name',
				name = '$name',
				description = '$description',
				manufacturer_id = '$manufacturer_id'
			where
				id = '$product_id'";
	mysqli_query($connect, $sql);

	$colors_id = array();
	$styles_id = array();
	$options_id = array();
	$sizes_id = array();

	$colors_name = array();
	$color_images = array();
	$old_color_images = array();
	$file_name_array = array();
	$new_colors_name = array();
	$new_color_images = array();

	if(!empty($_POST['color_id'])){
		$colors_id = $_POST['color_id'];

		if(!empty($_POST['old_color_image'])){

			$old_color_images = $_POST['old_color_image'];
			if(count($colors_id) === count($old_color_images)){
				for ($i=0; $i < count($old_color_images); $i++) { 
					if(strcmp($old_color_images[$i], '') !== 0){
						array_push($file_name_array, $old_color_images[$i]);
					}
				}

				for ($i = count($old_color_images); $i < count($colors_id); $i++) { 
					$file_name_array[$i] = '';
				}
			}

			if(!empty($_FILES['color_image']['tmp_name'])){
				$color_images = $_FILES['color_image'];
				if(count($colors_id) >= count($color_images['name'])){
					for ($i=0; $i < count($colors_id); $i++) { 
						if(strcmp($color_images['name'][$i], '') !== 0){
							$folder = 'color_images/';
							$file_element_array = explode('.', $color_images['name'][$i]);
							$file_extension = end($file_element_array);
							$file_name = time() . $i . '.' . $file_extension;
							$target_file = $folder . $file_name;
							move_uploaded_file($color_images['tmp_name'][$i], $target_file);
							$file_name_array[$i] = $file_name;
						}
					}
				}
			}

			if(empty($_POST['color_name'])){
				for ($i=0; $i < count($colors_id); $i++) { 
					array_splice($colors_id, $i, 1);
				}
			} else {
				$colors_name = $_POST['color_name'];
				$array_keys = array();
				foreach ($colors_name as $key => $value) {
					array_push($array_keys, $key);
				}

				if (count($colors_id) >= count($colors_name)) {

					for ($i = 0; $i < count($colors_id); $i++) { 
						if(!in_array($i, $array_keys) || in_array($i, $array_keys) && strcmp($colors_name[$i], '') === 0){
							array_splice($colors_id, $i, 1);
						} else if(strcmp($colors_name[$i], '') !== 0){
							$sql = "update colors
									set
										image = '$file_name_array[$i]',
										name = '$colors_name[$i]'
									where
										id = '$colors_id[$i]'";
							mysqli_query($connect, $sql);
							$error = mysqli_error($connect);
							if(!empty($error)){
								$sql = "select id from options
										where name = $colors_name[$i]";
								$result = mysqli_query($connect, $sql);
								$each = mysqli_fetch_array($result)['id'];
								array_splice($colors_id, $i, 1);
							}
						}
					}
				}
			}
		}
	}

	if(!empty($_POST['new_color_name']) && !empty($_FILES['new_color_image']['tmp_name'])){

		$new_colors_name = $_POST['new_color_name'];
		$new_color_images = $_FILES['new_color_image'];
		$array_keys = array();
		$file_name_array = array();

		foreach ($new_color_images['name'] as $key => $value) {
			array_push($array_keys, $key);
		}
		$count_array = array(count($new_colors_name), count($array_keys));

		for ($i = 0; $i < count($array_keys); $i++) { 
			$folder = 'color_images/';
			if(strcmp($new_color_images['name'][$i], '') !== 0){
				$new_color_images_name = $new_color_images['name'][$i];
				$file_element_array = explode('.', $new_color_images_name);
				$file_extension = end($file_element_array);
				$file_name = time() . $i . '.' . $file_extension;
				$target_file = $folder . $file_name;
				move_uploaded_file($new_color_images['tmp_name'][$i], $target_file);
				array_push($file_name_array, $file_name);
			}
		}

		for ($i=count($new_colors_name); $i < max($count_array); $i++) { 
			$new_colors_name[$i] = '';
		}
		for ($i=count($file_name_array); $i < max($count_array); $i++) { 
			$file_name_array[$i] = '';
		}

		for ($i=0; $i < max($count_array); $i++) { 
			if(strcmp($new_colors_name[$i], '') !== 0 && strcmp($file_name_array[$i], '') !== 0){

				$table_name = 'colors';
				require '../root/get_id_max.php';

				$sql = "insert into colors (id, image, name)
						values ('$id', '$file_name_array[$i]', '$new_colors_name[$i]')";
				mysqli_query($connect, $sql);
				$error = mysqli_error($connect);
				if(!empty($error)){
					$sql = "select id from colors
							where name = '$new_colors_name[$i]'";
					$result = mysqli_query($connect, $sql);
					require '../form_validation/backend_check/query_error.php';
					$each = mysqli_fetch_array($result)['id'];
					array_push($colors_id, $each);
				} else {
					array_push($colors_id, $id);
				}
			}
		}
	}

	$styles_name = array();
	$style_images = array();
	$old_style_images = array();
	$file_name_array = array();
	$new_styles_name = array();
	$new_style_images = array();

	if(!empty($_POST['style_id'])){
		$styles_id = $_POST['style_id'];

		if(!empty($_POST['old_style_image'])){

			$old_style_images = $_POST['old_style_image'];
			if(count($styles_id) === count($old_style_images)){
				for ($i=0; $i < count($old_style_images); $i++) { 
					if(strcmp($old_style_images[$i], '') !== 0){
						array_push($file_name_array, $old_style_images[$i]);
					}
				}

				for ($i = count($old_style_images); $i < count($styles_id); $i++) { 
					$file_name_array[$i] = '';
				}
			}

			if(!empty($_FILES['style_image']['tmp_name'])){
				$style_images = $_FILES['style_image'];
				if(count($styles_id) >= count($style_images['name'])){
					for ($i=0; $i < count($styles_id); $i++) { 
						if(strcmp($style_images['name'][$i], '') !== 0){
							$folder = 'style_images/';
							$file_element_array = explode('.', $style_images['name'][$i]);
							$file_extension = end($file_element_array);
							$file_name = time() . $i . '.' . $file_extension;
							$target_file = $folder . $file_name;
							move_uploaded_file($style_images['tmp_name'][$i], $target_file);
							$file_name_array[$i] = $file_name;
						}
					}
				}
			}

			if(empty($_POST['style_name'])){
				for ($i=0; $i < count($styles_id); $i++) { 
					array_splice($styles_id, $i, 1);
				}
			} else {
				$styles_name = $_POST['style_name'];
				$array_keys = array();
				foreach ($styles_name as $key => $value) {
					array_push($array_keys, $key);
				}

				if (count($styles_id) >= count($styles_name)) {

					for ($i = 0; $i < count($styles_id); $i++) { 
						if(!in_array($i, $array_keys) || in_array($i, $array_keys) && strcmp($styles_name[$i], '') === 0){
							array_splice($styles_id, $i, 1);
						} else if(strcmp($styles_name[$i], '') !== 0){
							$sql = "update styles
									set
										image = '$file_name_array[$i]',
										name = '$styles_name[$i]'
									where
										id = '$styles_id[$i]'";
							mysqli_query($connect, $sql);
							$error = mysqli_error($connect);
							if(!empty($error)){
								$sql = "select id from options
										where name = $styles_name[$i]";
								$result = mysqli_query($connect, $sql);
								$each = mysqli_fetch_array($result)['id'];
								array_splice($styles_id, $i, 1);
							}
						}
					}
				}
			}
		}
	}

	if(!empty($_POST['new_style_name']) && !empty($_FILES['new_style_image']['tmp_name'])){

		$new_styles_name = $_POST['new_style_name'];
		$new_style_images = $_FILES['new_style_image'];
		$array_keys = array();
		$file_name_array = array();
		
		foreach ($new_style_images['name'] as $key => $value) {
			array_push($array_keys, $key);
		}
		$count_array = array(count($new_styles_name), count($array_keys));

		for ($i = 0; $i < count($array_keys); $i++) { 
			$folder = 'style_images/';
			if(strcmp($new_style_images['name'][$i], '') !== 0){
				$new_style_images_name = $new_style_images['name'][$i];
				$file_element_array = explode('.', $new_style_images_name);
				$file_extension = end($file_element_array);
				$file_name = time() . $i . '.' . $file_extension;
				$target_file = $folder . $file_name;
				move_uploaded_file($new_style_images['tmp_name'][$i], $target_file);
				array_push($file_name_array, $file_name);
			}
		}

		for ($i=count($new_styles_name); $i < max($count_array); $i++) { 
			$new_styles_name[$i] = '';
		}
		for ($i=count($file_name_array); $i < max($count_array); $i++) { 
			$file_name_array[$i] = '';
		}

		for ($i=0; $i < max($count_array); $i++) { 
			if(strcmp($new_styles_name[$i], '') !== 0 && strcmp($file_name_array[$i], '') !== 0){

				$table_name = 'styles';
				require '../root/get_id_max.php';

				$sql = "insert into styles (id, image, name)
						values ('$id', '$file_name_array[$i]', '$new_styles_name[$i]')";
				mysqli_query($connect, $sql);
				$error = mysqli_error($connect);
				if(!empty($error)){
					$sql = "select id from styles
							where name = '$new_styles_name[$i]'";
					$result = mysqli_query($connect, $sql);
					require '../form_validation/backend_check/query_error.php';
					$each = mysqli_fetch_array($result)['id'];
					array_push($styles_id, $each);
				} else {
					array_push($styles_id, $id);
				}
			}
		}
	}

	$options_name = array();
	$option_images = array();
	$old_option_images = array();
	$file_name_array = array();
	$new_options_name = array();
	$new_option_images = array();

	if(!empty($_POST['option_id'])){
		$options_id = $_POST['option_id'];

		if(!empty($_POST['old_option_image'])){

			$old_option_images = $_POST['old_option_image'];
			if(count($options_id) === count($old_option_images)){
				for ($i=0; $i < count($old_option_images); $i++) { 
					if(strcmp($old_option_images[$i], '') !== 0){
						array_push($file_name_array, $old_option_images[$i]);
					}
				}

				for ($i = count($old_option_images); $i < count($options_id); $i++) { 
					$file_name_array[$i] = '';
				}
			}

			if(!empty($_FILES['option_image']['tmp_name'])){
				$option_images = $_FILES['option_image'];
				if(count($options_id) >= count($option_images['name'])){
					for ($i=0; $i < count($options_id); $i++) { 
						if(strcmp($option_images['name'][$i], '') !== 0){
							$folder = 'option_images/';
							$file_element_array = explode('.', $option_images['name'][$i]);
							$file_extension = end($file_element_array);
							$file_name = time() . $i . '.' . $file_extension;
							$target_file = $folder . $file_name;
							move_uploaded_file($option_images['tmp_name'][$i], $target_file);
							$file_name_array[$i] = $file_name;
						}
					}
				}
			}

			if(empty($_POST['option_name'])){
				for ($i=0; $i < count($options_id); $i++) { 
					array_splice($options_id, $i, 1);
				}
			} else {
				$options_name = $_POST['option_name'];
				$array_keys = array();
				foreach ($options_name as $key => $value) {
					array_push($array_keys, $key);
				}

				if (count($options_id) >= count($options_name)) {

					for ($i = 0; $i < count($options_id); $i++) { 
						if(!in_array($i, $array_keys) || in_array($i, $array_keys) && strcmp($options_name[$i], '') === 0){
							array_splice($options_id, $i, 1);
						} else if(strcmp($options_name[$i], '') !== 0){
							$sql = "update options
									set
										image = '$file_name_array[$i]',
										name = '$options_name[$i]'
									where
										id = '$options_id[$i]'";
							mysqli_query($connect, $sql);
							$error = mysqli_error($connect);
							if(!empty($error)){
								$sql = "select id from options
										where name = $options_name[$i]";
								$result = mysqli_query($connect, $sql);
								$each = mysqli_fetch_array($result)['id'];
								array_splice($options_id, $i, 1);
							}
						}
					}
				}
			}
		}
	}

	if(!empty($_POST['new_option_name']) && !empty($_FILES['new_option_image']['tmp_name'])){

		$new_options_name = $_POST['new_option_name'];
		$new_option_images = $_FILES['new_option_image'];
		$array_keys = array();
		$file_name_array = array();
		
		foreach ($new_option_images['name'] as $key => $value) {
			array_push($array_keys, $key);
		}
		$count_array = array(count($new_options_name), count($array_keys));

		for ($i = 0; $i < count($array_keys); $i++) { 
			$folder = 'option_images/';
			if(strcmp($new_option_images['name'][$i], '') !== 0){
				$new_option_images_name = $new_option_images['name'][$i];
				$file_element_array = explode('.', $new_option_images_name);
				$file_extension = end($file_element_array);
				$file_name = time() . $i . '.' . $file_extension;
				$target_file = $folder . $file_name;
				move_uploaded_file($new_option_images['tmp_name'][$i], $target_file);
				array_push($file_name_array, $file_name);
			}
		}

		for ($i=count($new_options_name); $i < max($count_array); $i++) { 
			$new_options_name[$i] = '';
		}
		for ($i=count($file_name_array); $i < max($count_array); $i++) { 
			$file_name_array[$i] = '';
		}

		for ($i=0; $i < max($count_array); $i++) { 
			if(strcmp($new_options_name[$i], '') !== 0 && strcmp($file_name_array[$i], '') !== 0){

				$table_name = 'options';
				require '../root/get_id_max.php';

				$sql = "insert into options (id, image, name)
						values ('$id', '$file_name_array[$i]', '$new_options_name[$i]')";
				mysqli_query($connect, $sql);
				$error = mysqli_error($connect);
				if(!empty($error)){
					$sql = "select id from options
							where name = '$new_options_name[$i]'";
					$result = mysqli_query($connect, $sql);
					require '../form_validation/backend_check/query_error.php';
					$each = mysqli_fetch_array($result)['id'];
					array_push($options_id, $each);
				} else {
					array_push($options_id, $id);
				}
			}
		}
	}

	$subs_id = array();
	$sub_images = array();
	$old_sub_images = array();
	$file_name_array = array();
	$new_sub_images = array();

	if(!empty($_POST['sub_id'])){
		$subs_id = $_POST['sub_id'];

		if(!empty($_POST['old_sub_image'])){

			$old_sub_images = $_POST['old_sub_image'];
			if(count($subs_id) === count($old_sub_images)){
				for ($i=0; $i < count($old_sub_images); $i++) { 
					if(strcmp($old_sub_images[$i], '') !== 0){
						array_push($file_name_array, $old_sub_images[$i]);
					}
				}

				for ($i = count($old_sub_images); $i < count($subs_id); $i++) { 
					$file_name_array[$i] = '';
				}
			}

			if(!empty($_FILES['sub_image']['tmp_name'])){
				$sub_images = $_FILES['sub_image'];
				if(count($subs_id) >= count($sub_images['name'])){
					for ($i=0; $i < count($subs_id); $i++) { 
						if(strcmp($sub_images['name'][$i], '') !== 0){
							$folder = 'sub_images/';
							$file_element_array = explode('.', $sub_images['name'][$i]);
							$file_extension = end($file_element_array);
							$file_name = time() . $i . '.' . $file_extension;
							$target_file = $folder . $file_name;
							move_uploaded_file($sub_images['tmp_name'][$i], $target_file);
							$file_name_array[$i] = $file_name;
						}
					}
				}
			}

			for ($i=0; $i < count($file_name_array); $i++) { 

				if(strcmp($file_name_array[$i], '') === 0){
					$sql = "delete from sub_images
							where 
								product_id = '$product_id' and
								id = '$subs_id[$i]'";
					mysqli_query($connect, $sql);
					require '../form_validation/backend_check/query_error.php';
				} else {
					$sql = "update sub_images
							set 
								image = '$file_name_array[$i]'
							where 
								product_id = '$product_id' and 
								id = '$subs_id[$i]'";
					mysqli_query($connect, $sql);
					require '../form_validation/backend_check/query_error.php';
				}

			}
		}
	}

	if(!empty($_FILES['new_sub_image']['tmp_name'])){

		$new_sub_images = $_FILES['new_sub_image'];
		$array_keys = array();
		$file_name_array = array();
		
		foreach ($new_sub_images['name'] as $key => $value) {
			array_push($array_keys, $key);
		}

		for ($i = 0; $i < count($array_keys); $i++) { 
			$folder = 'sub_images/';
			if(strcmp($new_sub_images['name'][$i], '') !== 0){
				$new_sub_images_name = $new_sub_images['name'][$i];
				$file_element_array = explode('.', $new_sub_images_name);
				$file_extension = end($file_element_array);
				$file_name = time() . $i . '.' . $file_extension;
				$target_file = $folder . $file_name;
				move_uploaded_file($new_sub_images['tmp_name'][$i], $target_file);
				array_push($file_name_array, $file_name);
			}
		}

		for ($i=0; $i < count($file_name_array); $i++) { 
			$sql = "insert into sub_images (image, product_id)
					values ('$file_name_array[$i]', '$product_id')";
			mysqli_query($connect, $sql);
			require '../form_validation/backend_check/query_error.php';
		}
	}

	$types_id = array();
	$types_id = $_POST['types_id'];

	if(count($types_id) < 1){
		//...
	} else {

		$sql = "delete from products_types 
				where product_id = '$product_id'";
		mysqli_query($connect, $sql);
		require '../form_validation/backend_check/query_error.php';

		for ($i=0; $i < count($types_id); $i++) { 

			$sql = "insert into products_types (type_id, product_id)
					values ('$types_id[$i]', '$product_id')";
			mysqli_query($connect, $sql);
			require '../form_validation/backend_check/query_error.php';

		}
	}

	if(!empty($_POST['sizes_id'])){
		$sizes_id = $_POST['sizes_id'];
	}

	$price = 0;
	if(!empty($_POST['price'])){
		$price = $_POST['price'];
	}

	$quantity = 0;
	if(!empty($_POST['quantity'])){
		$quantity = $_POST['quantity'];
	}

	$count_array = array(
		count($colors_id),
		count($styles_id),
		count($options_id),
		count($sizes_id)
	);

	for ($i = count($colors_id); $i < max($count_array); $i++) { 
		$colors_id[$i] = 0;
	}
	for ($i = count($styles_id); $i < max($count_array); $i++) { 
		$styles_id[$i] = 0;
	}
	for ($i = count($options_id); $i < max($count_array); $i++) { 
		$options_id[$i] = 0;
	}
	for ($i = count($sizes_id); $i < max($count_array); $i++) { 
		$sizes_id[$i] = 0;
	}

	if(max($count_array) < 1){
		$sql = "delete from products_detail
				where product_id = '$product_id'";
		mysqli_query($connect, $sql);
		require '../form_validation/backend_check/query_error.php';

		$sql = "insert into products_detail (product_id, color_id, style_id, option_id, size_id, price, quantity)
				values ('$product_id', null, null, null, null, '$price', '$quantity')";
		mysqli_query($connect, $sql);
		require '../form_validation/backend_check/query_error.php';
	} else {

		$sql = "delete from products_detail 
				where product_id = '$product_id'";
		mysqli_query($connect, $sql);
		require '../form_validation/backend_check/query_error.php';

		for ($i_1=0; $i_1 < max($count_array); $i_1++) { 
			for ($i_2=0; $i_2 < max($count_array); $i_2++) { 
				for ($i_3=0; $i_3 < max($count_array); $i_3++) { 
					for ($i_4=0; $i_4 < max($count_array); $i_4++) { 
						
						if($colors_id[$i_1] === 0){
							$colors_id[$i_1] = 'null';
						}
						if($styles_id[$i_2] === 0){
							$styles_id[$i_2] = 'null';
						}
						if($options_id[$i_3] === 0){
							$options_id[$i_3] = 'null';
						}
						if($sizes_id[$i_4] === 0){
							$sizes_id[$i_4] = 'null';
						}

						$sql = "insert into products_detail (product_id, color_id, style_id, option_id, size_id, price, quantity)
								values ('$product_id', $colors_id[$i_1], $styles_id[$i_2], $options_id[$i_3], $sizes_id[$i_4], '$price', '$quantity')";
						mysqli_query($connect, $sql);
						require '../form_validation/backend_check/query_error.php';

					}
				}
			}
		}
	}

	mysqli_close($connect);

	header("location:index.php?success=Successfully updated $table_name_display!&page=$page");