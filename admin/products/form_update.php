<?php 
	
	$table_name = 'products';
	require '../root/get_data_from_id.php';

	$sql = "select
				p.*,
				m.id as manufacturer_id,
				m.name as manufacturer_name,
				d.price,
				d.quantity
			from products as p
			join manufacturers as m on m.id = p.manufacturer_id
			join products_detail as d on d.product_id = p.id
			where p.id = $id
			limit 1";
	$result = mysqli_query($connect, $sql);
	$each = mysqli_fetch_array($result);

	$sql = "select id,name from manufacturers";
	$manufacturers_result = mysqli_query($connect, $sql);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/content.css">
	<link rel="stylesheet" type="text/css" href="../css/card.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
	<style type="text/css">
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
</head>
<body>

<div id="layout">

	<?php require_once '../root/menu.php' ?>

	<div id="dashboard">

		<?php require_once '../root/header.php' ?>

		<div class="content">

			<div id="notification" style="margin-bottom: 20px; font-size: 20px;"></div>

			<div class="form">
				<div class="form-title">
					<h3 class="h3-format">Update this product</h3>
				</div>
				<div class="form-content">
					<form method="post" action="process_update.php" enctype="multipart/form-data">
						<!-- <input type="hidden" name="id" value="<?php echo $each['id'] ?>">
						<input type="hidden" name="page" value="<?php echo $page ?>">
						<div class="form-input">
							<p>New main image</p>
							<input type="file" name="image" id="input_image">
							<div id="image_error"></div>
						</div> -->
						<!-- <div class="form-old-image">
							<p>Old main image</p>
							<img src="images/<?php echo $each['image'] ?>" height="180px">
						</div>
						<div class="form-input">
							<p>Name</p>
							<input type="text" name="name" id="input_name" value="<?php echo $each['name'] ?>">
							<div id="name_error"></div>
						</div>
						<div class="form-textarea">
							<p>Description</p>
							<textarea name="description" id="input_description"><?php echo $each['description'] ?></textarea>
							<div id="description_error"></div>
						</div>
						<div class="form-input">
							<p>Manufacturer</p>
							<select name="manufacturer_id" style="font-size: 16px">

								<?php foreach ($manufacturers_result as $each_manufacturer): ?>
									<option value="<?php echo $each_manufacturer['id'] ?>"
											<?php if($each_manufacturer['id'] === $each['manufacturer_id']) { ?>
												selected
											<?php } ?>
										>
											<?php echo $each_manufacturer['name'] ?>
									</option>
								<?php endforeach ?>

							</select>
							<div id="manufacturer_error"></div>
						</div>
						<div class="form-input">
							<p>Price</p>
							<input type="number" name="price" id="input_price" value="<?php echo $each['price'] ?>" step="any">
							<div id="price_error"></div>
						</div>
						<div class="form-input">
							<p>Quantity</p>
							<input type="number" name="quantity" id="input_quantity" value="<?php echo $each['quantity'] ?>">
							<div id="quantity_error"></div>
						</div> -->
						<!-- <div class="form-input">
							<p>Types</p>
							<select id="choices-multiple-remove-button" placeholder="Select upto 7 tags      " name="types_id[]" multiple autocomplete="off">
								<?php 
									$table_name = 'types';
									include '../root/get_all_records.php';
								?>

								<?php foreach ($result as $each): ?>

									<option value="<?php echo $each['id'] ?>">
										<?php echo $each['name'] ?>
									</option>

								<?php endforeach ?>
							</select>

							<div id="type_error"></div>
						</div>
						<div class="form-input">
							<p>Sizes</p>
							<select id="choices-multiple-remove-button" placeholder="Select upto 7 tags      " name="sizes_id[]" multiple autocomplete="off">
								<?php $table_name = 'sizes'; include '../root/get_all_records.php';?>
								<?php foreach ($result as $each): ?>
									<option value="<?php echo $each['id'] ?>">
										<?php echo $each['name'] ?>
									</option>
								<?php endforeach ?>
							</select>
							<div id="type_error"></div>
						</div> -->
						<!-- <br> -->
						<!-- <div class="save-button"><button type="submit" onclick="return check();">
								Save Changes
							</button></div> -->
					</form>
				</div>
			</div>
		</div>
		
		<?php require_once '../root/footer.php' ?>

	</div>
</div>
	
	<!-- <script src="../form_validation/frontend_check/check_error.js"></script>
	<script src="../form_validation/frontend_check/image.js"></script>
	<script src="../form_validation/frontend_check/update_image.js"></script>
	<script src="../form_validation/frontend_check/name.js"></script>
	<script src="../form_validation/frontend_check/description.js"></script>
	<script src="../form_validation/frontend_check/phone_number.js"></script>
	<script src="../form_validation/frontend_check/address.js"></script>
	<script src="../form_validation/frontend_check/email.js"></script>

	<script type="text/javascript">
		function check() {
			let count = 0;
			const result_check = [
				check_update_image(),
				check_name(), 
				check_description(), 
				check_phone_number(), 
				check_address(), 
				check_email()
			];
			for(let i = 0; i < result_check.length; i++){
				if(result_check[i] === true){
					count++;
				}
			}
			return (count === result_check.length) ? true : false;
		}
	</script> -->

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
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

	<?php require_once '../root/notification.php' ?>

	<?php mysqli_close($connect) ?>

</body>
</html>