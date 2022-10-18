<?php 
	session_start();
	require_once '../../admin/connect.php';

	if(isset($_COOKIE['remember'])){
		$token = $_COOKIE['remember'];
		$sql = "select * from customers where token = '$token'";
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
		header('location:../../sign_in.php');
		exit();
	}

	$table_name = 'orders';
	require_once 'get_data_from_id.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="../../admin/css/menu.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/header.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/content.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/card.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/notification_crud.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/pagination.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/footer.css">
	
	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>

	<?php require_once '../sidebar.php' ?>

	<div id="dashboard">

		<?php require_once '../header.php' ?>

		<div class="content">

			<div class="card">
				<div class="card-header" style="padding-top: 10px;">
					<div class="card-title">
						<h3 class="h3-format">Payment history detail</h3>
					</div>
				</div>

				<div class="card-content">
					<table width="94%">
						<tr style="text-align: center;">
							<th class="th-td-id">No</th>
							<th class="th-td-normal">Order ID</th>
							<th class="th-td-normal">Image</th>
							<th class="th-td-normal">Name</th>
							<th class="th-td-normal">Price</th>
							<th class="th-td-normal">Quantity</th>
						</tr>

						<?php $i = 1 ?>

						<?php foreach ($result as $each): ?>
							
							<tr style="text-align: center;">
								<td><?php echo $i ?></td>
								<td><?php echo $each['product_id'] ?></td>
								<td>
									<img src="../../admin/products/images/<?php echo $each['image'] ?>" height="100px" width="160px">
								</td>
								<td><?php echo trim($each['name']) ?></td>
								<td>
									<?php 
										$price = $each['price'];
										$price = number_format($price, 2, '.', ',');
										echo "\$" . $price;
									?>
								</td>
								<td><?php echo trim($each['quantity']) ?></td>
							</tr>

							<?php $i++ ?>

						<?php endforeach ?>

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

	<script src="../../admin/form_validation/frontend_check/confirm_delete.js"></script>

</body>
</html>