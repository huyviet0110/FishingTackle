<?php 
	session_start();
	require_once 'admin/connect.php';

	if(empty($_SESSION['id'])){
		if(!empty($_COOKIE['remember'])){
			$token = $_COOKIE['remember'];
			$sql = "select id, avatar, name from customers
					where token = '$token'";
			$result = mysqli_query($connect, $sql);
			$result_num_rows = mysqli_num_rows($result);
			if($result_num_rows === 1){
				$each = mysqli_fetch_array($result);
				$_SESSION['id'] = $each['id'];
				$_SESSION['avatar'] = $each['avatar'];
				$_SESSION['name'] = $each['name'];
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
	<link rel="stylesheet" type="text/css" href="css/view_cart.css">
	<link rel="stylesheet" type="text/css" href="admin/css/card.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>
	<div id="page">

		<?php 
			require_once 'header.php';
			require_once 'menu.php';
		?>

		<div id="container">
			<div class="cart">
				<div class="above">
					<h1>SHOPING CART</h1>
					<?php require_once 'notification.php' ?>
				</div>
				<div class="center">
					<table width="80%">
						<tr>
							<th>NO</th>
							<th>PRODUCT</th>
							<th></th>
							<th>PRICE</th>
							<th>QUANTITY</th>
							<th>TOTAL</th>
							<th>ACTION</th>
						</tr>

						<?php 
							$i = 1;
							$subtotal = 0;
						?>

						<?php if(!empty($_SESSION['cart'])){ ?>

							<?php foreach (($_SESSION['cart']) as $product => $each): ?>
								<tr class="cart-tr">
									<td><?php echo $i ?></td>
									<td width="180px">
										<img src="admin/products/images/<?php echo $each['image'] ?>" height="160px" width="160px">
									</td>
									<td style="text-align: left;  text-transform: uppercase; font-size: 18px;">
										<?php echo $each['name'] ?>
									</td>
									<td style="font-family: sans-serif;">
										<span style="margin-right: -3px;">$</span>
										<span class="span-price">
											<?php echo $each['price'] ?>
										</span>
									</td>
									<td>
										<button class="btn-update-quantity" data-id="<?php echo $product ?>" data-type="0">
											-
										</button>
										<span class="span-quantity">
											<?php echo $each['quantity'] ?>
										</span>
										<button class="btn-update-quantity" data-id="<?php echo $product ?>"  data-type="1">
											+
										</button>
									</td>
									<td style="color: #007580; font-size: 18px; font-weight: 600; font-family: sans-serif;">
										<?php 
											$total = $each['price'] * $each['quantity'];
											$subtotal += $total;
										?>
										<span style="margin-right: -4px;">$</span>
										<span class="span-total">
											<?php echo $total ?>
										</span>
									</td>

									<td>
										<div class="card-delete">
											<button class="btn-delete-product-in-cart" data-id="<?php echo $product ?>">
												<i class="fa-solid fa-trash"></i>
												<p style="font-family: sans-serif;">Delete</p>
											</button>
										</div>
									</td>
								</tr>

								<?php $i++ ?>

							<?php endforeach ?>

						<?php } ?>
					</table>
				</div>

				<div class="below">

					<p>
						Subtotal 
						<span style="margin-right: -6px;">$</span>
						<span id="span-subtotal">
							<?php echo $subtotal ?>
						</span>
					</p>

					<?php 
						$id = 0;
						if(!empty($_SESSION['id'])){
							$id = $_SESSION['id'];
							$sql = "select address, phone_number from customers
									where id = '$id'";
							$result = mysqli_query($connect, $sql);
							$each = mysqli_fetch_array($result);
						}
					?>

					<button type="button" data-toggle="modal" data-target="#modal-checkout">
						CHECK OUT
					</button>

					<div class="modal fade" id="modal-checkout" role="dialog">
    					<div class="modal-dialog">

    						<div class="modal-content">
    							<div class="modal-header">
    								<button type="button" class="close" data-dismiss="modal">&times;</button>
    								<h4 class="modal-title" style="font-family: sans-serif; text-align: center;">CHECK OUT</h4>
    							</div>
    							<div class="modal-body">
    								<div class="alert alert-danger" style="display: none; font-family: sans-serif; text-align: center;">
    								</div>

    								<form name="form_checkout" id="form-checkout">
    									Receiver name:
    									<input type="text" name="receiver_name" value="<?php if(!empty($_SESSION['name'])){ echo $_SESSION['name'];} ?>" spellcheck="false">
    									<br>
    									Receiver address:
    									<input type="text" name="receiver_address" value="<?php if(!empty($each['address'])){ echo $each['address'];} ?>" spellcheck="false">
    									<br>
    									Receiver phone:
    									<input type="number" name="receiver_phone" value="<?php if(!empty($each['phone_number'])){ echo $each['phone_number'];} ?>" spellcheck="false">
    									<br>
    									<button>SUBMIT</button>
    								</form>
    							</div>
    						</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php require_once 'footer.php'; ?>

	</div>

	<script src="admin/form_validation/frontend_check/confirm_delete.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$(".btn-update-quantity").click(function() {
				let btn = $(this);
				let id = btn.data('id');
				let type = btn.data('type');
				$.ajax({
					url: 'update_quantity_in_cart.php',
					type: 'POST',
					// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
					data: {id, type},
				})
				.done(function(response) {
					if(response == 1){
						let parent_tr = btn.parents('tr');
						let price = parent_tr.find('.span-price').text();
						let quantity = parent_tr.find('.span-quantity').text();
						if(type == 0){
							quantity--;
						} else if(type == 1){
							quantity++;
						}
						if(quantity == 0){
							parent_tr.remove();
						} else {
							parent_tr.find('.span-quantity').text(quantity);
							let total = Math.round((price * quantity) * 100) / 100;
							parent_tr.find('.span-total').text(total);
						}
						let subtotal = 0;
						$(".span-total").each(function() {
							subtotal += parseFloat($(this).text());
						});
						$('#span-subtotal').text(subtotal);
					} else {
						alert(response);
					}
				});
				
			});
		});

		$(document).ready(function() {
			$(".btn-delete-product-in-cart").click(function() {
				let confirm_delete = confirm('Are you sure you want to delete?');
				if(confirm_delete){
					let btn = $(this);
					let id = btn.data('id');
					$.ajax({
						url: 'delete_product_in_cart.php',
						type: 'POST',
						// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
						data: {id},
					})
					.done(function(response) {
						if(response == 1){
								parent_tr = btn.parents('tr');
								parent_tr.remove();
								let subtotal = 0;
								$(".span-total").each(function() {
									subtotal += parseFloat($(this).text());
								});
								$("#span-subtotal").text(subtotal);
						} else {
							alert(response);
						}
					});
				}
			});
		});

		$(document).ready(function() {
			$("#form-checkout").validate({
				rules: {
					"receiver_name": {
						required: true,
						maxlength: 100
					},
					"receiver_address": {
						required: true,
						maxlength: 200
					},
					"receiver_phone": {
						required: true,
						maxlength: 20,
						digits: true
					}
				},
				messages: {
					"receiver_name": {
						required: "Receiver name cannot be empty",
						maxlength: "Receiver name cannot be exceed 100 characters"
					},
					"receiver_address": {
						required: "Receiver address cannot be empty",
						maxlength: "Receiver address cannot be exceed 200 characters"
					},
					"receiver_phone": {
						required: "Receiver phone cannot be empty",
						maxlength: "Receiver phone cannot be exceed 20 characters",
						digits: "Wrong format of receiver phone number"
					}
				},
				submitHandler: function() {
					$.ajax({
						url: 'checkout.php',
						type: 'POST',
						dataType: 'html',
						data: $("#form-checkout").serializeArray(),
					})
					.done(function(response) {
						if(response !== '1'){
							$(".alert-danger").text(response);
							$(".alert-danger").show();
						} else {
							$("#modal-checkout").modal("hide");
							$(".cart-tr").remove();
							$("#span-subtotal").text('0');
						}
					});
				}
			});
		});
	</script>

	<?php mysqli_close($connect) ?>

</body>
</html>