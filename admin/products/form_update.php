<?php 
	
	$table_name = 'products';
	require '../root/get_data_from_id.php';

	$sql = "select
				products.*,
				manufacturers.id as manufacturer_id,
				manufacturers.name as manufacturer_name
			from products
			join manufacturers on manufacturers.id = products.manufacturer_id
			where products.id = $id
			limit 1";
	$result = mysqli_query($connect, $sql);
	$this_product = mysqli_fetch_array($result);

	$sql = "select price, quantity
			from products_detail
			where product_id = $id
			group by price, quantity";
	$result = mysqli_query($connect, $sql);
	$price_quantity = mysqli_fetch_array($result);

	$columns_need_to_get_data = 'type_id';
	$table_name = 'products_types';
	$column_for_comparison = 'product_id';
	require '../root/get_distinct_data.php';
	$types_selected = $selected;

	$columns_need_to_get_data = 'size_id';
	$table_name = 'products_detail';
	$column_for_comparison = 'product_id';
	require '../root/get_distinct_data.php';
	$sizes_selected = $selected;

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
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
	<style type="text/css">
		#layout {
			height: 9500px;
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

			<div id="notification" style="margin-bottom: 20px; font-size: 20px;"></div>

			<div class="form">
				<div class="form-title">
					<h3 class="h3-format">Update this product</h3>
				</div>
				<div class="form-content">
					<form method="post" action="process_update.php" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $this_product['id'] ?>">
						<input type="hidden" name="page" value="<?php echo $page ?>">

						<div class="form-input">
							<p>New main image</p>
							<input type="file" name="image" id="input_image">
							<div id="image_error"></div>
						</div>

						<div class="form-old-image">
							<p>Old main image</p>
							<img src="images/<?php echo $this_product['image'] ?>" height="180px">
						</div>

						<div class="form-input">
							<p>Name</p>
							<input type="text" name="name" id="input_name" value="<?php echo $this_product['name'] ?>">
							<div id="name_error"></div>
						</div>

						<div class="form-textarea">
							<p>Description</p>
							<textarea name="description" id="input_description"><?php echo $this_product['description'] ?></textarea>
							<div id="description_error"></div>
						</div>

						<div class="form-input">
							<p>Manufacturer</p>

							<?php 
								$table_name = 'manufacturers';
								require '../root/get_all_records.php';
							?>

							<select name="manufacturer_id" style="font-size: 16px">

								<?php foreach ($result as $each): ?>
									<option value="<?php echo $each['id'] ?>" 
										<?php if($each['id'] === $this_product['manufacturer_id']) { ?>
											selected
										<?php } ?>
									>
											<?php echo $each['name'] ?>
									</option>
								<?php endforeach ?>

							</select>
							<div id="manufacturer_error"></div>
						</div>

						<div class="form-input">
							<p>Price</p>
							<input type="number" name="price" id="input_price" value="<?php echo $price_quantity['price'] ?>" step="any">
							<div id="price_error"></div>
						</div>

						<div class="form-input">
							<p>Quantity</p>
							<input type="number" name="quantity" id="input_quantity" value="<?php echo $price_quantity['quantity'] ?>">
							<div id="quantity_error"></div>
						</div>

						<div class="form-input">
							<p>Types</p>
							<select id="choices-multiple-remove-button" placeholder="Select upto 7 tags      " name="types_id[]" multiple autocomplete="off">
								<?php 
									$table_name = 'types';
									include '../root/get_all_records.php';
								?>

								<?php foreach ($result as $each): ?>

									<option value="<?php echo $each['id'] ?>" 
										<?php if(in_array($each['id'], $types_selected)) { ?>
											selected
										<?php } ?>
										>

										<?php echo $each['name'] ?>
									</option>

								<?php endforeach ?>
							</select>
							<div id="type_error"></div>
						</div>
						<br>

						<div class="form-input">
							<p>Sizes</p>
							<select id="choices-multiple-remove-button" placeholder="Select upto 7 tags      " name="sizes_id[]" multiple autocomplete="off">
								<?php 
									$table_name = 'sizes'; 
									include '../root/get_all_records.php';
								?>

								<?php foreach ($result as $each): ?>

									<option value="<?php echo $each['id'] ?>" 
										<?php if(in_array($each['id'], $sizes_selected)) { ?>
											selected
										<?php } ?>
									>

										<?php echo $each['name'] ?>
									</option>

								<?php endforeach ?>
							</select>
							<div id="type_error"></div>
						</div>
						<br>

						<?php 
							$i = 1;

							$sql = "select
										products_detail.color_id as id,
										colors.name,
										colors.image
									from products_detail
									join colors on colors.id = products_detail.color_id
									where products_detail.product_id = '$id'
									group by products_detail.color_id";
							$result = mysqli_query($connect, $sql);
							$number_of_colors = mysqli_num_rows($result);
						?>

						<p style="font-weight: bold; padding-top: 20px; font-size: 20px; color: #00BCD4;">
							If there is a color you don't want to save, leave its name or image blank!
						</p>

						<?php foreach ($result as $each): ?>

							<div class="form-input input-color color-<?php echo ($i - 1) ?>">
								<p>Color <?php echo $i ?></p>
								<p style="font-weight: normal;">Name</p>
								<input type="hidden" name="color_id[<?php echo ($i - 1) ?>]" value="<?php echo $each['id'] ?>">
								<input type="text" name="color_name[<?php echo ($i - 1) ?>]"value="<?php echo $each['name'] ?>">
								<div class="color_error"></div>
							</div>
							<div class="form-input count-input color-<?php echo ($i - 1) ?>">
								<p style="font-weight: normal; padding-top: 10px;">New Image</p>
								<input type="file" name="color_image[<?php echo ($i - 1) ?>]">
								<div class="color_image_error"></div>
							</div>
							<div class="form-old-image color-<?php echo ($i - 1) ?>">
								<p style="font-weight: normal; padding-top: 10px;">Old Image</p>
								<input type="hidden" name="old_color_image[<?php echo ($i - 1) ?>]" value="<?php echo $each['image'] ?>">
								<img src="color_images/<?php echo $each['image'] ?>" height="180px">
								<div class="color_old_image_error"></div>
							</div>

							<?php $i++ ?>

						<?php endforeach ?>

						<?php for ($i = $number_of_colors + 1; $i <= 5; $i++) { ?>

							<div class="form-input input-color color-<?php echo ($i - 1) ?>">
								<p>Color <?php echo $i ?></p>
								<p style="font-weight: normal;">Name</p>
								<input type="text" name="new_color_name[<?php echo ($i - ($number_of_colors + 1)) ?>]">
								<div class="color_error"></div>
							</div>
							<div class="form-input count-input color-<?php echo ($i - 1) ?>">
								<p style="font-weight: normal; padding-top: 10px;">New Image</p>
								<input type="file" name="new_color_image[<?php echo ($i - ($number_of_colors + 1)) ?>]">
								<div class="color_image_error"></div>
							</div>

						<?php } ?>

						<br>

						<p style="font-weight: bold; padding-top: 20px; font-size: 20px; color: #00BCD4;">
							If there is a style you don't want to save, leave its name or image blank!
						</p>

						<?php 
							$i = 1;

							$sql = "select
										products_detail.style_id as id,
										styles.name,
										styles.image
									from products_detail
									join styles on styles.id = products_detail.style_id
									where products_detail.product_id = '$id'
									group by products_detail.style_id";
							$result = mysqli_query($connect, $sql);
							$number_of_styles = mysqli_num_rows($result);
						?>

						<?php foreach ($result as $each): ?>

							<div class="form-input input-style style-<?php echo ($i - 1) ?>">
								<p>Style <?php echo $i ?></p>
								<p style="font-weight: normal;">Name</p>
								<input type="hidden" name="style_id[<?php echo ($i - 1) ?>]" value="<?php echo $each['id'] ?>">
								<input type="text" name="style_name[<?php echo ($i - 1) ?>]"  value="<?php echo $each['name'] ?>">
								<div class="style_error"></div>
							</div>
							<div class="form-input count-input style-<?php echo ($i - 1) ?>">
								<p style="font-weight: normal; padding-top: 10px;">New Image</p>
								<input type="file" name="style_image[<?php echo ($i - 1) ?>]">
								<div class="style_image_error"></div>
							</div>
							<div class="form-old-image style-<?php echo ($i - 1) ?>">
								<p style="font-weight: normal; padding-top: 10px;">Old Image</p>
								<input type="hidden" name="old_style_image[<?php echo ($i - 1) ?>]" value="<?php echo $each['image'] ?>">
								<img src="style_images/<?php echo $each['image'] ?>" height="180px">
								<div class="style_old_image_error"></div>
							</div>

							<?php $i++ ?>

						<?php endforeach ?>

						<?php for ($i = $number_of_styles + 1; $i <= 5; $i++) { ?>

							<div class="form-input input-style style-<?php echo ($i - 1) ?>">
								<p>Style <?php echo $i ?></p>
								<p style="font-weight: normal;">Name</p>
								<input type="text" name="new_style_name[<?php echo ($i - ($number_of_styles + 1)) ?>]">
								<div class="style_error"></div>
							</div>
							<div class="form-input count-input style-<?php echo ($i - 1) ?>">
								<p style="font-weight: normal; padding-top: 10px;">New Image</p>
								<input type="file" name="new_style_image[<?php echo ($i - ($number_of_styles + 1)) ?>]">
								<div class="style_image_error"></div>
							</div>

						<?php } ?>

						<br>

						<p style="font-weight: bold; padding-top: 20px; font-size: 20px; color: #00BCD4;">
							If there is a option you don't want to save, leave its name or image blank!
						</p>

						<?php 
							$i = 1;

							$sql = "select
										products_detail.option_id as id,
										options.name,
										options.image
									from products_detail
									join options on options.id = products_detail.option_id
									where products_detail.product_id = '$id'
									group by products_detail.option_id";
							$result = mysqli_query($connect, $sql);
							$number_of_options = mysqli_num_rows($result);
						?>

						<?php foreach ($result as $each): ?>

							<div class="form-input input-option option-<?php echo ($i - 1) ?>">
								<p>Option <?php echo $i ?></p>
								<p style="font-weight: normal;">Name</p>
								<input type="hidden" name="option_id[<?php echo ($i - 1) ?>]" value="<?php echo $each['id'] ?>">
								<input type="text" name="option_name[<?php echo ($i - 1) ?>]" value="<?php echo $each['name'] ?>">
								<div class="option_error"></div>
							</div>
							<div class="form-input count-input option-<?php echo ($i - 1) ?>">
								<p style="font-weight: normal; padding-top: 10px;">New Image</p>
								<input type="file" name="option_image[<?php echo ($i - 1) ?>]">
								<div class="option_image_error"></div>
							</div>
							<div class="form-old-image option-<?php echo ($i - 1) ?>">
								<p style="font-weight: normal; padding-top: 10px;">Old Image</p>
								<input type="hidden" name="old_option_image[<?php echo ($i - 1) ?>]" value="<?php echo $each['image'] ?>">
								<img src="option_images/<?php echo $each['image'] ?>" height="180px">
								<div class="option_old_image_error"></div>
							</div>

							<?php $i++ ?>

						<?php endforeach ?>

						<?php for ($i = $number_of_options + 1; $i <= 5; $i++) { ?>

							<div class="form-input input-option option-<?php echo ($i - 1) ?>">
								<p>Option <?php echo $i ?></p>
								<p style="font-weight: normal;">Name</p>
								<input type="text" name="new_option_name[<?php echo ($i - ($number_of_options + 1)) ?>]">
								<div class="option_error"></div>
							</div>
							<div class="form-input count-input option-<?php echo ($i - 1) ?>">
								<p style="font-weight: normal; padding-top: 10px;">New Image</p>
								<input type="file" name="new_option_image[<?php echo ($i - ($number_of_options + 1)) ?>]">
								<div class="option_image_error"></div>
							</div>

						<?php } ?>

						<br>

						<p style="font-weight: bold; padding-top: 20px; font-size: 20px; color: #00BCD4;">
							If there is a sub image you don't want to save, leave its name or image blank!
						</p>

						<?php 
							$i = 1;

							$sql = "select id, image
									from sub_images
									where product_id = '$id'";
							$result = mysqli_query($connect, $sql);
							$number_of_sub_images = mysqli_num_rows($result);
						?>

						<?php foreach ($result as $each): ?>

							<div class="form-input count-input count-sub-image input-sub-image">
								<p>
									Sub Image <?php echo $i ?>
								</p>
								<p style="font-weight: normal; padding-top: 10px;">
									New Image
								</p>
								<input type="hidden" name="sub_id[<?php echo ($i - 1) ?>]" value="<?php echo $each['id'] ?>">
								<input type="file" name="sub_image[<?php echo ($i - 1) ?>]">
								<div class="sub_image_error"></div>
							</div>
							<div class="form-old-image">
								<p style="font-weight: normal; padding-top: 10px;">Old Image</p>
								<input type="hidden" name="old_sub_image[<?php echo ($i - 1) ?>]" value="<?php echo $each['image'] ?>">
								<img src="sub_images/<?php echo $each['image'] ?>" height="180px">
								<div class="old_sub_image_error"></div>
							</div>

							<?php $i++ ?>

						<?php endforeach ?>

						<?php for ($i = $number_of_sub_images + 1; $i <= 5; $i++) { ?>

							<div class="form-input count-input sub_image-<?php echo ($i - 1) ?>">
								<p style="font-weight: normal; padding-top: 10px;">New Image</p>
								<input type="file" name="new_sub_image[<?php echo ($i - ($number_of_sub_images + 1)) ?>]">
								<div class="sub_image_error"></div>
							</div>

						<?php } ?>

						<br>

						<div class="save-button">
							<button type="submit" onclick="return check();">
								Save Changes
							</button>
						</div>
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

	<?php 
		require_once '../root/notification.php' 
	?>

	<?php mysqli_close($connect) ?>

</body>
</html>