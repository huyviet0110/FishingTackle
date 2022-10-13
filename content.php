<?php

	$sql = "SELECT
				id,
				image,
				name,
				(SELECT image FROM sub_images
			 	 WHERE product_id = p.id
			 	 LIMIT 1) AS sub_image
			FROM products AS p
			LIMIT 16";
	$products = mysqli_query($connect, $sql);

?>

<div id="content">
	<div class="content-header">
		<h2>FEATURED PRODUCTS</h2>
		<a href="collections.php">
			SHOP ALL PRODUCTS
		</a>
	</div>
	<div class="main-content">

		<?php foreach ($products as $each): ?>

			<div class="product">
				<a href="product_detail.php?id=<?php echo $each['id'] ?>">
					<img src="admin/products/images/<?php echo $each['image'] ?>">
				</a>
				<a href="product_detail.php?id=<?php echo $each['id'] ?>" class="sub-image">
					<img src="admin/products/sub_images/<?php echo $each['sub_image'] ?>">
				</a>
				<a href="product_detail.php?id=<?php echo $each['id'] ?>" style="padding: 10px 0px;">
					<p><?php echo $each['name'] ?></p>
				</a>
			</div>

		<?php endforeach ?>
		
	</div>
</div>