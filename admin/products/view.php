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

	$table_name = 'products';
	require '../root/get_data_from_id.php';

	$sql = "select
				products.*,
				manufacturers.name as manufacturer_name
			from products
			join manufacturers on manufacturers.id = products.manufacturer_id
			where products.id = $id";
	$result = mysqli_query($connect, $sql);
	$this_product = mysqli_fetch_array($result);

	$sql = "select price, quantity
			from products_detail
			where product_id = $id
			group by price, quantity";
	$result = mysqli_query($connect, $sql);
	$price_quantity = mysqli_fetch_array($result);

	$sql = "select 
				types.id,
				types.name
			from types
			join products_types on products_types.type_id = types.id
			where products_types.product_id = '$id'";
	$types_selected = mysqli_query($connect, $sql);

	$sql = "select
				colors.id,
				colors.image,
				colors.name
			from colors
			join products_detail on products_detail.color_id = colors.id
			where product_id = '$id'
			group by color_id";
	$colors_selected = mysqli_query($connect, $sql);

	$sql = "select
				styles.id,
				styles.image,
				styles.name
			from styles
			join products_detail on products_detail.style_id = styles.id
			where product_id = '$id'
			group by style_id";
	$styles_selected = mysqli_query($connect, $sql);

	$sql = "select
				options.id,
				options.image,
				options.name
			from options
			join products_detail on products_detail.option_id = options.id
			where product_id = '$id'
			group by option_id";
	$options_selected = mysqli_query($connect, $sql);

	$sql = "select
				sizes.id,
				sizes.name
			from sizes
			join products_detail on products_detail.size_id = sizes.id
			where product_id = '$id'
			group by size_id";
	$sizes_selected = mysqli_query($connect, $sql);

	$sql = "select
				sub_images.id,
				sub_images.image
			from sub_images
			join products on products.id = sub_images.product_id
			where product_id = '$id'";
	$sub_images_selected = mysqli_query($connect, $sql);
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

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
	<style type="text/css">
		#layout {
			height: 5000px;
		}
		#dashboard {
			height: 100%;
		}
		.content {
			height: calc(100% - 50px - 67px);
		}
		.choices__inner {
			padding: 0;
		}
		.choices__input {
			padding-top: 8px;
		}
	</style>

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
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
						<h3 class="h3-format">Products Detail</h3>
					</div>
				</div>

				<div class="card-content">
					<table width="97%">
						<tr>
							<th class="th-td-id">ID</th>
							<th class="th-td-image">Image</th>
							<th class="th-td-normal">Name</th>
							<th class="th-td-normal">Manufacturer</th>
							<th class="th-td-normal">Price</th>
							<th class="th-td-normal">Quantity</th>
							<th class="th-td-normal">Created at</th>
							<th class="th-td-action">Action</th>
						</tr>
						
						<tr>
							<td><?php echo $this_product['id'] ?></td>
							<td>
								<img src="images/<?php echo $this_product['image'] ?>" height="100px" width="100px">
							</td>
							<td><?php echo trim($this_product['name']) ?></td>
							<td><?php echo trim($this_product['manufacturer_name']) ?></td>
							<td><?php echo trim($price_quantity['price']) ?></td>
							<td><?php echo trim($price_quantity['quantity']) ?></td>
							<?php 
								$date = date_create($this_product['created_at']);
								$created_at = date_format($date, "H:i:s d/m/Y");
							?>
							<td><?php echo trim($created_at) ?></td>
							<td class="th-td-action">
								<?php include '../root/card_update.php' ?>
							</td>
							<td class="th-td-action">
								<?php include '../root/card_delete.php' ?>
							</td>
						</tr>
					</table>

					<br>
					<br>

					<table width="97%">
						<tr>
							<th>Description</th>
						</tr>

						<tr>
							<td><?php echo nl2br(trim($this_product['description'])) ?></td>
						</tr>
					</table>

					<br>
					<br>

					<div class="card-header" style="padding-top: 10px;">
						<div class="card-title">
							<h3 class="h3-format">Types</h3>
						</div>
					</div>

					<table width="40%">
						<tr>
							<th class="th-td-id">No</th>
							<th class="th-td-normal">Name</th>
						</tr>

						<?php $i = 1 ?>

						<?php foreach ($types_selected as $each): ?>

							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $each['name'] ?></td>
							</tr>

							<?php $i++ ?>

						<?php endforeach ?>
						
					</table>

					<br>
					<br>

					<div class="card-header" style="padding-top: 10px;">
						<div class="card-title">
							<h3 class="h3-format">Colors</h3>
						</div>
					</div>

					<table width="40%">
						<tr>
							<th class="th-td-id">No</th>
							<th class="th-td-image">Image</th>
							<th class="th-td-normal">Name</th>
						</tr>

						<?php $i = 1 ?>

						<?php foreach ($colors_selected as $each): ?>

							<tr>
								<td><?php echo $i ?></td>
								<td>
									<img src="color_images/<?php echo $each['image'] ?>" height="100px" width="100px">
								</td>
								<td><?php echo $each['name'] ?></td>
							</tr>

							<?php $i++ ?>

						<?php endforeach ?>
						
					</table>

					<br>
					<br>

					<div class="card-header" style="padding-top: 10px;">
						<div class="card-title">
							<h3 class="h3-format">Styles</h3>
						</div>
					</div>

					<table width="40%">
						<tr>
							<th class="th-td-id">No</th>
							<th class="th-td-image">Image</th>
							<th class="th-td-normal">Name</th>
						</tr>

						<?php $i = 1 ?>

						<?php foreach ($styles_selected as $each): ?>

							<tr>
								<td><?php echo $i ?></td>
								<td>
									<img src="style_images/<?php echo $each['image'] ?>" height="100px" width="100px">
								</td>
								<td><?php echo $each['name'] ?></td>
							</tr>

							<?php $i++ ?>

						<?php endforeach ?>
						
					</table>

					<br>
					<br>

					<div class="card-header" style="padding-top: 10px;">
						<div class="card-title">
							<h3 class="h3-format">Options</h3>
						</div>
					</div>

					<table width="40%">
						<tr>
							<th class="th-td-id">No</th>
							<th class="th-td-image">Image</th>
							<th class="th-td-normal">Name</th>
						</tr>

						<?php $i = 1 ?>

						<?php foreach ($options_selected as $each): ?>

							<tr>
								<td><?php echo $i ?></td>
								<td>
									<img src="option_images/<?php echo $each['image'] ?>" height="100px" width="100px">
								</td>
								<td><?php echo $each['name'] ?></td>
							</tr>

							<?php $i++ ?>

						<?php endforeach ?>
						
					</table>

					<br>
					<br>

					<div class="card-header" style="padding-top: 10px;">
						<div class="card-title">
							<h3 class="h3-format">Sizes</h3>
						</div>
					</div>

					<table width="30%">
						<tr>
							<th>No</th>
							<th>Name</th>
						</tr>

						<?php $i = 1 ?>

						<?php foreach ($sizes_selected as $each): ?>

							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $each['name'] ?></td>
							</tr>

							<?php $i++ ?>

						<?php endforeach ?>
						
					</table>

					<br>
					<br>

					<div class="card-header" style="padding-top: 10px;">
						<div class="card-title">
							<h3 class="h3-format">Sub images</h3>
						</div>
					</div>

					<table width="97%">
						<tr style="text-align: center;">
							<?php $i = 1 ?>
							<?php foreach ($sub_images_selected as $each): ?>

								<th>No <?php echo $i ?></th>

								<?php $i++ ?>

							<?php endforeach ?>
						</tr>

						<tr style="text-align: center;">

							<?php $i = 1 ?>

							<?php foreach ($sub_images_selected as $each): ?>

								<td>
									<img src="sub_images/<?php echo $each['image'] ?>" height="100px" width="100px">
								</td>

								<?php $i++ ?>

							<?php endforeach ?>

						</tr>
					</table>
				</div>
			</div>
		</div>
			 
		<?php require_once '../root/footer.php' ?>

	</div>

</div>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

	<script>
		$(document).ready(function(){

			var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
				removeItemButton: true,
				maxItemCount:7,
				searchResultLimit:5,
				renderChoiceLimit:8
			}); 

		});
	</script>

	<?php mysqli_close($connect) ?>

	<script src="../form_validation/frontend_check/confirm_delete.js"></script>
</body>
</html>