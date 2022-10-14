<?php 

	require_once 'admin/connect.php';

    // if(empty($_GET['id']) || !is_numeric($_GET['id'])){
	// 	header('location:' . $_SERVER['HTTP_REFERER']);
	// 	exit();
	// }

	// $id = $_GET['id'];

	// $sql = "select id from products
	// 		where id = $id";
	// $result = mysqli_query($connect, $sql);
	// $result_num_rows = mysqli_num_rows($result);
	// if($result_num_rows < 1){
	// 	header('location:' . $_SERVER['HTTP_REFERER']);
	// 	exit();
	// }

	// $sql = "select 
	// 			products.*, 
	// 			(select price from products_detail
	// 			 where product_id = products.id
	// 			 limit 1) as price
	// 		from products
	// 		where id = $id";
	// $result = mysqli_query($connect, $sql);
	// $this_product = mysqli_fetch_array($result);

	// $sql = "select image from sub_images
	// 		where product_id = $id";
	// $sub_images = mysqli_query($connect, $sql);

	// $sql = "select 
	// 			id, image, name,
	// 			(select image 
	// 			 from sub_images
	// 			 where product_id = products.id 
	// 			 limit 1) as sub_image,
	// 			(select price 
	// 			 from products_detail
	// 			 where product_id = products.id 
	// 			 group by price) as price 
	// 	    from products
	// 	    where id in (select product_id from products_types
	// 	    			 where type_id in (select type_id from products_types
	// 	    			 				   where product_id = $id))
	// 	    order by id desc 
	// 	    limit 4";
	// $related_products = mysqli_query($connect, $sql);
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/page.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/banner.css">
	<link rel="stylesheet" type="text/css" href="css/view_cart.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>
	<div id="page">

		<?php 
			require_once 'header.php';
			require_once 'menu.php';
		?>

		<div id="container">
			<div class="cart">
				<div class="above">
					<h1>SHOPING CART</h1>
				</div>
				<div class="center">
					<form method="post" action="update_cart.php">
						<table width="80%">
							<tr>
								<th>PRODUCT</th>
								<th></th>
								<th>PRICE</th>
								<th>QUANTITY</th>
								<th>TOTAL</th>
								<th>ACTION</th>
							</tr>

							<?php foreach ($result as $each): ?>
								<tr>
									<td>
										<img src="admin/products/images/<?php echo $each['image'] ?>">
									</td>
									<td><?php echo $each['name'] ?></td>
									<td><?php echo $each['price'] ?></td>
									<td><?php echo $each['quantity'] ?></td>
									<td><?php echo $each['total'] ?></td>
									<td><?php echo "delete" ?></td>
								</tr>
							<?php endforeach ?>
						</table>
					</form>
				</div>
				<div class="below">

				</div>
			</div>
		</div>

		<?php require_once 'footer.php'; ?>

	</div>

</body>
</html>