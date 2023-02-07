<?php 
	try {
		session_start();
		if(empty($_POST['id']) || !is_numeric($_POST['id'])){
			throw new Exception("Invalid ID", 1);
		}
		$id = $_POST['id'];

		if(empty($_SESSION['cart'][$id])){
			require_once 'admin/connect.php';
			$sql = "select 
						image,
						name,
						(
							select price from products_detail
							where product_id = '$id'
							limit 1
						) as price
					from products
					where id = '$id'";
			$result = mysqli_query($connect, $sql);
			$result_num_rows = mysqli_num_rows($result);
			if($result_num_rows === 1){
				$each = mysqli_fetch_array($result);
				$image = $each['image'];
				$name = $each['name'];
				$price = $each['price'];

				$_SESSION['cart'][$id]['image'] = $image;
				$_SESSION['cart'][$id]['name'] = $name;
				$_SESSION['cart'][$id]['price'] = $price;
				$_SESSION['cart'][$id]['quantity'] = 1;
			}
		} else {
			$_SESSION['cart'][$id]['quantity']++;
		}
		
		echo 1;
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	
	

	