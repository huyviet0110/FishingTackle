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
</head>
<body>
	<?php require_once '../root/menu.php' ?>

	<div id="dashboard">

		<?php require_once '../root/header.php' ?>

		<div class="content">
			<div class="form">
				<div class="form-title">
					<h3 class="h3-format">Add a new manufacturers</h3>
				</div>
				<div class="form-content">
					<form method="post" action="process_insert.php" enctype="multipart/form-data">
						<div class="form-input">
							<p>Image</p>
							<input type="file" name="image">
						</div>
						<div class="form-input">
							<p>Name</p>
							<input type="text" name="name">
						</div>
						<div class="form-input">
							<p>Description</p>
							<input type="text" name="description"> 
						</div>
						<div class="form-input">
							<p>Phone number</p>
							<input type="number" name="phone_number"> 
						</div>
						<div class="form-input">
							<p>Address</p>
							<input type="text" name="address"> 
						</div>
						<div class="form-input">
							<p>Email</p>
							<input type="email" name="email"> 
						</div>
						<div class="create-button">
							<button>Create</button>
						</div>
					</form>
				</div>
			</div>
		</div>
			 
		<?php require_once '../root/footer.php' ?>

	</div>
</body>
</html>