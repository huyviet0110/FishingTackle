<?php 
	
	require_once '../form_validation/backend_check/check_empty/id_get.php';
	require_once '../form_validation/backend_check/page_get.php';

	require_once '../connect.php';

	require_once '../form_validation/backend_check/check_empty/id.php';

	$sql = "select 
				orders_products.order_id as id, 
				orders_products.product_id, 
				orders_products.quantity, 
				products.image,
				products.name,
				(
					select price from products_detail
					where products_detail.product_id = products.id 
					limit 1
				) as price
			from orders_products
			join products on products.id = orders_products.product_id
			where orders_products.order_id = '$id'";
	$result = mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows < 1){
		header('location:index.php?error=Invalid ID!');
		exit();
	}
	$each = mysqli_fetch_array($result);