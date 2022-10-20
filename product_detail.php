<?php 

	session_start();
	require_once 'admin/connect.php';

	if(isset($_COOKIE['remember'])){
		$token = $_COOKIE['remember'];
		$sql = "select id, avatar, name from customers where token = '$token'";
		$result = mysqli_query($connect, $sql);
		$result_num_rows = mysqli_num_rows($result);
		if($result_num_rows === 1){
			$each = mysqli_fetch_array($result);
			$_SESSION['id'] = $each['id'];
			$_SESSION['avatar'] = $each['avatar'];
			$_SESSION['name'] = $each['name'];
		}
	}

	if(empty($_GET['id']) || !is_numeric($_GET['id'])){
		header('location:' . $_SERVER['HTTP_REFERER']);
		exit();
	}

	$id = $_GET['id'];

	$sql = "select id from products
			where id = $id";
	$result = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows < 1){
		header('location:' . $_SERVER['HTTP_REFERER']);
		exit();
	}

	$sql = "select 
				products.*, 
				(select price from products_detail
				 where product_id = products.id
				 limit 1) as price
			from products
			where id = $id";
	$result = mysqli_query($connect, $sql);
	$this_product = mysqli_fetch_array($result);

	$sql = "select image from sub_images
			where product_id = $id";
	$sub_images = mysqli_query($connect, $sql);

	$sql = "select 
				id, image, name,
				(select image 
				 from sub_images
				 where product_id = products.id 
				 limit 1) as sub_image,
				(select price 
				 from products_detail
				 where product_id = products.id 
				 group by price) as price 
		    from products
		    where id in (select product_id from products_types
		    			 where type_id in (select type_id from products_types
		    			 				   where product_id = $id))
		    order by id desc 
		    limit 4";
	$related_products = mysqli_query($connect, $sql);

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
	<link rel="stylesheet" type="text/css" href="css/product_detail.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>
	<div id="page">

		<?php 
			require_once 'header.php';
			require_once 'menu.php';
		?>

		<div id="product_detail">
			<div class="main-detail">
				<div class="all-the-images">
					<div class="above">
						<a href="#">						
							<img src="admin/products/images/<?php echo $this_product['image'] ?>">
						</a>
					</div>
					<div class="below">
						<?php foreach ($sub_images as $each): ?>
							<a href="#">
								<img src="admin/products/sub_images/<?php echo $each['image'] ?>">
							</a>
						<?php endforeach ?>
					</div>
				</div>

				<div class="information">
					<div class="above">
						<h1 style="font-size: 30px;"><?php echo $this_product['name'] ?></h1>
						<p style="font-size: 22px; color: #818185;">
							<?php 
								$price = $this_product['price'];
								$price = number_format($price, 2, '.', ',');
								echo "\$" . $price;
							?>
						</p>
					</div>

					<div class="center">
							<?php 
								$table_name = 'color';
								require 'product_attributes.php';
								$table_name = 'style';
								require 'product_attributes.php';
								$table_name = 'option';
								require 'product_attributes.php';
								$table_name = 'size';
								require 'product_attributes.php';
							?>

							<br>

							<button class="btn-add-to-cart" data-id="<?php echo $id ?>">ADD TO CART</button>
							<button formaction="view_cart.php">BUY IT NOW</button>
					</div>

					<div class="below">
						<p><?php echo nl2br($this_product['description']) ?></p>
					</div>
				</div>
			</div>

			<div class="related-products">
				<div class="title">
					<h3>YOU MAY ALSO LIKE ...</h3>
				</div>
				<div class="item">
					<?php foreach ($related_products as $each): ?>
						<div class="product">
							<a href="product_detail.php?id=<?php echo $each['id'] ?>">
								<img src="admin/products/images/<?php echo $each['image'] ?>">
								<br>
								<p style="padding-top: 4px;"><?php echo $each['name'] ?></p>
								<p style="color: #646569; font-family: sans-serif; padding-top: 4px;">
									<?php 
										$price = $each['price'];
										$price = number_format($price, 2, '.', ',');
										echo "\$" . $price;
									?>
								</p>
								<img src="admin/products/sub_images/<?php echo $each['sub_image'] ?>" class="sub-image">
							</a>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>

		<?php require_once 'footer.php'; ?>

	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".btn-add-to-cart").click(function() {
				let id = $(this).data('id');
				$.ajax({
					url: 'add_to_cart.php',
					type: 'POST',
					// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
					data: {id},
				})
				.done(function(response) {
					if(response == 1){
						alert('success');
					} else {
						alert(response);
					}
				});
			});
		});
	</script>

	<?php mysqli_close($connect) ?>

</body>
</html>