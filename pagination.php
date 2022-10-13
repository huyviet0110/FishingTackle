<?php

	$sql = "select * from $table_name";
		
	$products = mysqli_query($connect, $sql);
	$number_of_records = mysqli_num_rows($products);

	if($number_of_records > 0){
		$number_of_pages = ceil($number_of_records / $number_of_records_per_page);
		$number_of_records_to_skip = ($page - 1) * $number_of_records_per_page;

		if($page > $number_of_pages){
			header("location:index.php?page=$number_of_pages");
			exit();
		} else if($page < 1){
			header("location:index.php?page=1");
			exit();
		}

		$sql = "select 
					$table_name.*, 
					(SELECT sub_images.image FROM sub_images
	 				 WHERE product_id = products.id
	 				 LIMIT 1) as sub_image,
					(select products_detail.price from products_detail
					 where products_detail.product_id = $table_name.id
					 limit 1) as price
				from $table_name
				order by id asc
				limit $number_of_records_per_page
				offset $number_of_records_to_skip";
		$products = mysqli_query($connect, $sql);
		$number_of_records = mysqli_num_rows($products);
	}