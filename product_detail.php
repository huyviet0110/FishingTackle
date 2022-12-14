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
	<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
	<style type="text/css">
		.rating { 
		  border: none;
		  float: left;
		}

		.rating > input { display: none; } 
		.rating > label:before { 
		  margin: 5px;
		  font-size: 1.6em;
		  font-family: FontAwesome;
		  display: inline-block;
		  content: "\f005";
		}

		.rating > .half:before { 
		  content: "\f089";
		  position: absolute;
		}

		.rating > label { 
		  color: #ddd; 
		 float: right; 
		}

		/***** CSS Magic to Highlight Stars on Hover *****/

		.rating > input:checked ~ label, /* show gold star when clicked */
		.rating:not(:checked) > label:hover, /* hover current star */
		.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

		.rating > input:checked + label:hover, /* hover current star when changing rating */
		.rating > input:checked ~ label:hover,
		.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
		.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
	</style>
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
							<form action="view_cart.php">
								<button>BUY IT NOW</button>
							</form>
					</div>

					<div class="below">
						<p><?php echo nl2br($this_product['description']) ?></p>
					</div>
				</div>
			</div>

			<div id="rating">
				<h1>Rating for the product</h1>
				<form id="form-rating">
					<fieldset class="rating">
						<input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
						<input type="radio" id="star4.5" name="rating" value="4.5"/><label class="half" for="star4.5" title="Pretty good - 4.5 stars"></label>
						<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
						<input type="radio" id="star3.5" name="rating" value="3.5" /><label class="half" for="star3.5" title="Meh - 3.5 stars"></label>
						<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
						<input type="radio" id="star2.5" name="rating" value="2.5" /><label class="half" for="star2.5" title="Kinda bad - 2.5 stars"></label>
						<input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
						<input type="radio" id="star1.5" name="rating" value="1.5" /><label class="half" for="star1.5" title="Meh - 1.5 stars"></label>
						<input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
						<input type="radio" id="star0.5" name="rating" value="0.5" /><label class="half" for="star0.5" title="Sucks big time - 0.5 stars"></label>
					</fieldset>
					<br><br><br>

					<textarea name="review" spellcheck="false" placeholder="Please write a review about this product"></textarea>
					<br><br>

					<input type="hidden" name="product_id" value="<?php echo $id ?>">
					<?php if (!empty($_SESSION['id'])): ?>
						<input type="hidden" name="customer_id" value="<?php echo $_SESSION['id'] ?>">
					<?php endif ?>
					<button>SEND</button>
				</form>

				<br><br>

				<h1>Recent reviews</h1>
				<div id="recent-reviews"></div>
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
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
	<script type="text/javascript">
		function htmlDecode(input) {
			var doc = new DOMParser().parseFromString(input, "text/html");
			return doc.documentElement.textContent;
		}

		function get_recent_reviews(id) {
			$.ajax({
				url: 'get_recent_reviews.php',
				type: 'POST',
				dataType: 'json',
				data: {id},
			})
			.done(function(response) {
				const recent_reviews =Object.values(response);

				recent_reviews.forEach((each) => {
					$("#recent-reviews").append(`
						<div class="customer-review">
							<div class="avatar-name">
								<img src="users/avatars/${each.avatar}"/>
								<p>${each.name}</p>
							</div>

							<div class="created-at">
								<p>Review at ${each.created_at}</p>
							</div>

							<div class="rating-star">
								<fieldset class="rating">
									` + htmlDecode(each.rating) + `
								</fieldset>
							</div>

							<div class="review-content">
								<p>${each.review}</p>
							</div>
						</div>
					`);
				});
			});
		}

		$(document).ready(function() {
			const id = <?php echo $id ?>;
			get_recent_reviews(id);
		});

		$(document).ready(function() {
			$(".btn-add-to-cart").click(function() {
				let id = $(this).data('id');
				$.ajax({
					url: 'add_to_cart.php',
					type: 'POST',
					data: {id},
				})
				.done(function(response) {
					if(response == 1){
						alert('Add to cart successfully');
					} else {
						alert(response);
					}
				});
			});
		});

		$(document).ready(function() {
			$("#form-rating").validate({
				submitHandler: function() {
					$.ajax({
						url: 'insert_rating.php',
						type: 'POST',
						data: $("#form-rating").serializeArray(),
					})
					.done(function(response) {
						const id = <?php echo $id ?>;
						if(response == 1){
							$("#recent-reviews").text('');
							get_recent_reviews(id);
						} else if(response == -1) {
							alert('You need to sign in!');
						} else {
							alert('Rating failed!');
						}
					});
				}
			});
		});
	</script>

	<?php mysqli_close($connect) ?>

</body>
</html>