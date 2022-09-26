<?php 
	require_once '../form_validation/backend_check/page_get.php';
	require_once '../connect.php';
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
	<link rel="stylesheet" type="text/css" href="../css/notification.css">
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
						<h3 class="h3-format">Add a new product</h3>
					</div>
					<div class="form-content">
						<form method="post" action="process_insert.php" enctype="multipart/form-data">

							<input type="hidden" name="page" value="<?php echo $page ?>">

							<div class="form-input">
								<p>Main Image (Correct format: png, jpg, jpec, gif)</p>
								<input type="file" name="image" id="input_image">
								<div id="image_error"></div>
							</div>

							<div class="form-input">
								<p>Name</p>
								<input type="text" name="name" id="input_name">
								<div id="name_error"></div>
							</div>

							<div class="form-textarea">
								<p>Description</p>
								<textarea name="description" id="input_description"></textarea>
								<div id="description_error"></div>
							</div>

							<div class="form-input">
								<p>Manufacturer</p>
								<select name="manufacturer_id" style="font-size: 16px;">
									<?php 
										$table_name = 'manufacturers';
										include '../root/get_all_records.php';
									?>

									<?php foreach ($result as $each): ?>

										<option value="<?php echo $each['id'] ?>"><?php echo $each['name'] ?></option>

									<?php endforeach ?>
								</select>
								<div id="manufacturer_error"></div>
							</div>

							<div class="form-input">
								<p>Price (!Note: You can change the price for each style, size, ... in the update after adding the product)</p>
								<input type="number" name="price" id="input_price" step="any">
								<div id="price_error"></div>
							</div>

							<div class="form-input">
								<p>Quantity (!Note: You can change the quantity for each style, size, ... in the update after adding the product)</p>
								<input type="number" name="quantity" id="input_quantity">
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

										<option value="<?php echo $each['id'] ?>"><?php echo $each['name'] ?></option>

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

										<option value="<?php echo $each['id'] ?>"><?php echo $each['name'] ?></option>

									<?php endforeach ?>
								</select>

								<div id="type_error"></div>
							</div>
							<br>

							<div class="form-input">
								<p>Color 1</p>
								<p style="font-weight: normal;">Name</p>
								<input type="text" name="color[0]">
								<div class="color_error"></div>
							</div>
							<div class="form-input count-input">
								<p style="font-weight: normal; padding-top: 10px;">Image File</p>
								<input type="file" name="color_image[0]">
								<div class="color_image_error"></div>
							</div>
							<div id="new_color">
								<div class="card-insert card_insert_color" style="margin: 0; padding-top: 10px">
									<button type="button" style="width: 150px" onclick="return add_a_new_color()">
										<i class="fa-solid fa-plus"></i>
										<p>Add a new color</p>
									</button>
								</div>
							</div>
							<br>

							<div class="form-input">
								<p>Style 1</p>
								<p style="font-weight: normal;">Name</p>
								<input type="text" name="style[0]">
								<div class="style_error"></div>
							</div>
							<div class="form-input count-input">
								<p style="font-weight: normal; padding-top: 10px;">Image File</p>
								<input type="file" name="style_image[0]">
								<div class="style_image_error"></div>
							</div>
							<div id="new_style">
								<div class="card-insert card_insert_style" style="margin: 0; padding-top: 10px">
									<button type="button" style="width: 150px" onclick="return add_a_new_style()">
										<i class="fa-solid fa-plus"></i>
										<p>Add a new style</p>
									</button>
								</div>
							</div>
							<br>

							<div class="form-input">
								<p>Option 1</p>
								<p style="font-weight: normal;">Name</p>
								<input type="text" name="option[0]">
								<div class="option_error"></div>
							</div>
							<div class="form-input count-input">
								<p style="font-weight: normal; padding-top: 10px;">Image File</p>
								<input type="file" name="option_image[0]">
								<div class="option_image_error"></div>
							</div>
							<div id="new_option">
								<div class="card-insert card_insert_option" style="margin: 0; padding-top: 10px">
									<button type="button" style="width: 160px" onclick="return add_a_new_option()">
										<i class="fa-solid fa-plus"></i>
										<p>Add a new option</p>
									</button>
								</div>
							</div>
							<br>

							<div class="form-input count-input count-sub-image">
								<p>Sub Image (Correct format: png, jpg, jpec, gif) - Upto 10 images</p>
								<input type="file" name="sub_image[0]">
								<div class="sub_image_error"></div>
							</div>
							<div id="new_sub_image">
								<div class="card-insert card_insert_sub_image" style="margin: 0; padding-top: 10px">
									<button type="button" style="width: 190px" onclick="return add_a_new_sub_image()">
										<i class="fa-solid fa-plus"></i>
										<p>Add a new sub image</p>
									</button>
								</div>
							</div>
							<br>

							<div class="create-button">
								<button type="submit" onclick="return check();">
									Create
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
	<script src="../form_validation/frontend_check/insert_image.js"></script>
	<script src="../form_validation/frontend_check/name.js"></script>
	<script src="../form_validation/frontend_check/description.js"></script>
	<script src="../form_validation/frontend_check/phone_number.js"></script>
	<script src="../form_validation/frontend_check/address.js"></script>
	<script src="../form_validation/frontend_check/email.js"></script> -->
	
	<!-- <script type="text/javascript">
		function check() {
			let count = 0;
			const result_check = [
				check_insert_image(),
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

	<?php require '../root/add_a_new_one.php' ?>
	<script type="text/javascript">
		function add_a_new_color(){
			let element = 'card_insert_color';
			let label = 'Color';
			let name = 'color';
			let button_width = 150;

			add_a_new_one(element, label, name, button_width);
		}

		function add_a_new_style(){
			let element = 'card_insert_style';
			let label = 'Style';
			let name = 'style';
			let button_width = 150;

			add_a_new_one(element, label, name, button_width);
		}

		function add_a_new_option(){
			let element = 'card_insert_option';
			let label = 'Option';
			let name = 'option';
			let button_width = 160;

			add_a_new_one(element, label, name, button_width);
		}
		
		function add_a_new_sub_image(){
			let element = 'card_insert_sub_image';
			let label = 'Sub image';
			let name = 'sub_image';
			let button_width = 190;

			add_a_new_one(element, label, name, button_width);
		}
	</script>
	
	<?php
		require_once '../root/notification.php';
		mysqli_close($connect);
	?>
	
</body>
</html>