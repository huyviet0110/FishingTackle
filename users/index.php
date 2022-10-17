<?php 
	session_start();
	require_once '../admin/connect.php';

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

	if(!isset($_SESSION['id'])){
		header('location:../sign_in.php');
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="../admin/css/menu.css">
	<link rel="stylesheet" type="text/css" href="../admin/css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../admin/css/header.css">
	<link rel="stylesheet" type="text/css" href="../admin/css/content.css">
	<link rel="stylesheet" type="text/css" href="../admin/css/footer.css">
	
	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>

	<div id="sidebar">
		<div class="dashboard-logo">
			<a href="index.php">
				<i class="fa-solid fa-gauge-high"></i>
				<span>Dashboard</span>
			</a>
			<hr>
		</div>

		<div class="profile">
			<a href="personal_information">
				<?php if(empty($_SESSION['avatar'])) { ?>
					<i class="fa-solid fa-user"></i>
					<span>Profile</span>
				<?php } else { ?>
					<img src="personal_information/avatars/<?php echo $_SESSION['avatar'] ?>" height="40px" width="40px" style="border: 1px solid white; border-radius: 50%; margin-top: 0px;">
					<span style="margin-left: 72px;">Profile</span>
				<?php } ?>
			</a>
			<hr>
		</div>

		<div class="search-box">
			<form method="get" action="index.php">
				<input type="search" name="search_nav_item" placeholder="Search"> 
				<button type="submit">
					<i class="fa-solid fa-magnifying-glass"></i>
				</button>
			</form>
		</div>

		<div class="nav-bar">
			<ul>
				<li class="nav-item">
					<a href="personal_information">
						<i class="fa-solid fa-address-card"></i>
						<p>
							Personal information
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="payment_history">
						<i class="fa-solid fa-dumpster-fire"></i>
						<p>
							Payment history
						</p>
					</a>
				</li>
			</ul>
		</div>
	</div>

	<div id="dashboard">

		<div class="header">
			<div class="left">
				<a href="../" style="text-decoration: none;">
					<p>Home</p>
				</a>
			</div>
			<div class="right">
				<?php if(!empty($_SESSION['avatar'])){ ?>
					<img src="personal_information/avatars/<?php echo $_SESSION['avatar'] ?>" height="40px" width="40px" style="border: 1px solid white; border-radius: 50%;">
				<?php } else { ?>
					<i class="fa-solid fa-user"></i>
				<?php } ?>
				<p><?php echo $_SESSION['name'] ?> / </p>
				<a href="../sign_out.php">
					Sign out
				</a>
			</div>
		</div>

		<?php 
		
			$sql = "select 
					products.* from products
					order by id desc
					limit 4";
			$this_product = mysqli_query($connect, $sql);
			$result_num_rows = mysqli_num_rows($this_product);

		?>

		<div class="content">
			<div class="above">
				<ul>
					<li>
						<a href="#" style="background-color: #17A2B8;">
							<p class="statistics">25</p>
							<i class="fa-solid fa-bag-shopping"></i>
							<p>
								New Orders
							</p>
						</a>
					</li>
					<li>
						<a href="#" style="background-color: #28A745;">
							<p  class="statistics">25%</p>
							<i class="fa-solid fa-signal"></i>
							<p>
								Cancellation Rate
							</p>
						</a>
					</li>
					<li>
						<a href="#" style="background-color: #FFC107;">
							<p  class="statistics">1000</p>
							<i class="fa-solid fa-user-plus"></i>
							<p> 
								User Registrations
							</p>
						</a>
					</li>
					<li>
						<a href="#" style="background-color: #DC3545;">
							<p  class="statistics">500</p>
							<i class="fa-solid fa-eye"></i>
							<p>
								Unique Visitors
							</p>
						</a>
					</li>
				</ul>
			</div>

			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h3 class="h3-format">New products</h3>
					</div>
					<div class="card-search">
						<form method="get" action="index.php">
							<div class="card-search-box">
								<input type="search" name="search" placeholder="Search">
							</div>
							<div class="card-search-button">
								<button type="submit">
									<i class="fa-solid fa-magnifying-glass"></i>
								</button>
							</div>
						</form>
					</div>
				</div>

				<div class="card-content">
					<table width="94%">
						<tr style="text-align: center;">
							<th>No</th>
							<th>Image</th>
							<th>Name</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>created_at</th>
						</tr>

						<?php if($result_num_rows > 0) { ?>

							<?php $i = 1 ?>

							<?php foreach ($this_product as $each): ?>

								<tr style="text-align: center;">
									<td><?php echo $i ?></td>
									<td>
										<img src="products/images/<?php echo $each['image'] ?>" height="100px" width="100px">
									</td>
									<td><?php echo $each['name'] ?></td>

									<?php 
									$product_id = $each['id'];
									$sql = "select 
									price, 
									sum(quantity) as quantity
									from products_detail
									join products on products.id = products_detail.product_id
									where product_id = '$product_id'
									group by price";
									$price_quantity = mysqli_query($connect, $sql);
									$each_price_quantity = mysqli_fetch_array($price_quantity);
									?>

									<td><?php echo $each_price_quantity['price'] ?></td>
									<td><?php echo $each_price_quantity['quantity'] ?></td>

									<?php 
									$date = date_create($each['created_at']);
									$created_at = date_format($date, "H:i:s d/m/Y");
									?>
									<td><?php echo $created_at ?></td>
								</tr>

								<?php $i++ ?>

							<?php endforeach ?>

						<?php } ?>
					</table>
				</div>
			</div>
		</div>

		<?php mysqli_close($connect) ?>

		<div class="footer">
			<p>
				<strong>
					Copyright
					<i class="fa-regular fa-copyright"></i>
					2021-2022 
					<a href="../admin">FishingTackle.</a>
				</strong>
				All rights reserved
			</p>
		</div>
	</div>

</body>
</html>