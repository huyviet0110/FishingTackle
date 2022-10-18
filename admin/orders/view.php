<?php 
	session_start();
	if(empty($_SESSION['admin_id'])){
		header('location:../index.php');
		exit();
	}

	if($_SESSION['admin_level'] === 1){
		header('location:../admin_page.php');
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

	<link rel="stylesheet" type="text/css" href="../css/layout.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/content.css">
	<link rel="stylesheet" type="text/css" href="../css/card.css">
	<link rel="stylesheet" type="text/css" href="../css/notification_crud.css">
	<link rel="stylesheet" type="text/css" href="../css/pagination.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">

	<style type="text/css">
		#dashboard {
			height: 100%;
		}
		.content {
			height: calc(100% - 50px - 67px);
		}
	</style>
</head>
<body>

<div id="layout">

	<?php require_once '../root/menu.php' ?>

	<div id="dashboard">

		<?php require_once '../root/header.php' ?>

		<div class="content">
			<div class="card">
				<div class="card-header" style="padding-top: 10px;">
					<div class="card-title">
						<h3 class="h3-format">Orders Detail</h3>
					</div>
				</div>

				<div class="card-content">
					<table width="97%">
						<tr style="text-align: center;">
							<th>No</th>
							<th>ID</th>
							<th>Image</th>
							<th>Name</th>
							<th>Price</th>
							<th>Quantity</th>
						</tr>

						<?php $i = 1 ?>
						
						<?php foreach ($result as $each): ?>

							<tr style="text-align: center;">
								<td><?php echo $i ?></td>
								<td><?php echo $each['product_id'] ?></td>
								<td>
									<img src="../products/images/<?php echo $each['image'] ?>" height="100px" width="160px">
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
			 
		<?php require_once '../root/footer.php' ?>

	</div>

</div>
	
	<?php mysqli_close($connect) ?>

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
	<script src="../form_validation/frontend_check/confirm_delete.js"></script>
</body>
</html>