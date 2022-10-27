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

	$page = 1;
	if(isset($_GET['page']) && is_numeric($_GET['page'])){
		$page = $_GET['page'];
	}

	$title = 'All the products';
	$number_of_products_by_type = 0;
	$number_of_records_per_page = 12;

	if(empty($_GET['type_id'])){
		$table_name = 'products';
		require 'pagination.php';
	} else if(!empty($_GET['type_id']) && is_numeric($_GET['type_id'])){
		$type_id = $_GET['type_id'];

		$sql = "select id from types where id = $type_id";
		$products = mysqli_query($connect, $sql);
		$result_num_rows = mysqli_num_rows($products);
		if($result_num_rows > 0){
			$sql = "select product_id from products_types
					where type_id = $type_id";
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
							types.name as type_name,
							products.id,
							products.image,
							products.name,
							(select products_detail.price from products_detail
							 where products_detail.product_id = products_types.product_id
							 limit 1) as price,
							(select sub_images.image from sub_images
							 where sub_images.product_id = products.id
							 limit 1) as sub_image
						from types 
						join products_types on products_types.type_id = types.id 
						join products on products.id = products_types.product_id
						where types.id = $type_id
						limit $number_of_records_per_page
						offset $number_of_records_to_skip";
				$products = mysqli_query($connect, $sql);
				$number_of_records = mysqli_num_rows($products);
				$number_of_products_by_type = $number_of_records;
				$title = mysqli_fetch_array($products)['type_name'];
			}
		}
	}

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
	<link rel="stylesheet" type="text/css" href="css/collections.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="admin/css/pagination.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>
	<div id="page">

		<?php 
			require_once 'header.php';
			require_once 'menu.php';
		?>

		<div id="collections">
			<div class="browse">
				<h4 style="padding-bottom: 10px;">BROWSE</h4>

				<ul class="nav-bar">

					<li class="nav-item"><a href="collections.php">All Products</a></li>

					<?php foreach ($result as $each): ?>

						<li class="nav-item">
							<a href="collections.php?type_id=<?php echo $each['id'] ?>">
								<?php echo $each['name'] ?>
							</a>
						</li>

					<?php endforeach ?>

				</ul>
			</div>

			<div class="right">
				<div class="above">
					<div class="left">
						<h1 style="font-size: 24px; padding-left: 15px"><?php echo $title ?></h1>
					</div>
					<div class="right">
						<i id="search-icon" class="fa-solid fa-magnifying-glass"></i>
						<img id="project-icon" src="" class="ui-state-default" alt  height="100px">
						<input id="project" placeholder="Search">
						<input type="hidden" id="project-id">
					</div>
				</div>

				<div class="below">

					<?php foreach ($products as $each): ?>
						
						<div class="product">
							<a href="product_detail.php?id=<?php echo $each['id'] ?>">
								<img src="admin/products/images/<?php echo $each['image'] ?>">
								<p style="font-family: schoolbook-web,Georgia,serif;">
									<?php echo $each['name'] ?>
								</p>
								<p style="color: #646569; padding-top: 4px; font-size: 18px;">
									<?php 
										$price = $each['price'];
										$price = number_format($price, 2, '.', ',');
										echo "\$" . $price;
									?>
								</p>
							</a>

							<a href="product_detail.php?id=<?php echo $each['id'] ?>" class="sub-image">
								<img src="admin/products/sub_images/<?php echo $each['sub_image'] ?>">
							</a>
						</div>

					<?php endforeach ?>

				</div>

					<?php 
						if($number_of_records > 0){
							require_once 'show_pagination.php' ;
						}
					?>

			</div>
		</div>

		<?php require_once 'footer.php'; ?>

	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script>
		$( function() {
			$( "#project" ).autocomplete({
				source: "search.php",
				focus: function( event, ui ) {
					$( "#project" ).val( ui.item.name );
					return false;
				}
			})
			.autocomplete( "instance" )._renderItem = function( ul, item ) {
				return $( "<li>" )
				.append( `<div class="product-detail-jquery-ui"> 
										<a href="product_detail.php?id=${item.id}"> 
											<p>${item.name}</p>
											<br> 
											<img src="admin/products/images/${item.image}" height="100px"/> 
										</a> 
								  </div>` )
				.appendTo( ul );
			};
		} );
	</script>

	<?php mysqli_close($connect) ?>
</body>
</html>