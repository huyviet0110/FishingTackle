<?php 
	
	if(empty($_POST['id'])){
		header('location:index.php?error=Invalid ID!');
		exit();
	}

	$id = $_POST['id'];

	require_once '../connect.php';

	$sql = "select * from manufacturers
			where id = '$id'";
	$result = mysqli_query($connect, $sql);

	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows != 1){
		header('location:index.php?error=Invalid ID!');
		exit();
	}

	$each = mysqli_fetch_array($result);
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
</head>
<body>

	<?php require_once '../root/menu.php' ?>

	<div id="dashboard">

		<?php require_once '../root/header.php' ?>

		<div class="content">
			<div class="form">
				<div class="form-title">
					<h3 class="h3-format">Update this manufacturer</h3>
				</div>
				<div class="form-content">
					<form method="post" action="process_update.php" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
						<div class="form-input">
							<p>New image</p>
							<input type="file" name="image">
						</div>
						<div class="form-old-image">
							<p>Old image</p>
							<img src="images/<?php echo $each['image'] ?>" height="180px">
							<input type="hidden" name="old_image" value="<?php echo $each['image'] ?>">
						</div>
						<div class="form-input">
							<p>Name</p>
							<input type="text" name="name" value="<?php echo $each['name'] ?>">
						</div>
						<div class="form-textarea">
							<p>Description</p>
							<textarea name="description"><?php echo $each['description'] ?></textarea>
						</div>
						<div class="form-input">
							<p>Phone number</p>
							<input type="number" name="phone_number" value="<?php echo $each['phone_number'] ?>"> 
						</div>
						<div class="form-input">
							<p>Address</p>
							<input type="text" name="address" value="<?php echo $each['address'] ?>"> 
						</div>
						<div class="form-input">
							<p>Email</p>
							<input type="email" name="email" value="<?php echo $each['email'] ?>"> 
						</div>
						<div class="save-button">
							<button>Save Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<?php require_once '../root/footer.php' ?>

	</div>
	
</body>
</html>