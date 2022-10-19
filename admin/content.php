<?php 
	$sql = "select 
				products.* from products
			order by id desc
			limit 4";
	$this_product = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($this_product);
?>

<div class="content">
	<div class="above">
		<ul>
			<li>
				<a href="#" style="background-color: #17A2B8;">
					<p class="statistics">25</p>
					<i class="fa-solid fa-bag-shopping"></i>
					<p>
						New Orders
					</p>
				</a>
			</li>
			<li>
				<a href="#" style="background-color: #28A745;">
					<p  class="statistics">25%</p>
					<i class="fa-solid fa-signal"></i>
					<p>
						Cancellation Rate
					</p>
				</a>
			</li>
			<li>
				<a href="#" style="background-color: #FFC107;">
					<p  class="statistics">1000</p>
					<i class="fa-solid fa-user-plus"></i>
					<p> 
						User Registrations
					</p>
				</a>
			</li>
			<li>
				<a href="#" style="background-color: #DC3545;">
					<p  class="statistics">500</p>
					<i class="fa-solid fa-eye"></i>
					<p>
						Unique Visitors
					</p>
				</a>
			</li>
		</ul>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="card-title">
				<h3 class="h3-format">Newest products</h3>
			</div>
			<div class="card-search">
				<form method="get" action="index.php">
					<div class="card-search-box">
						<input type="search" name="search" placeholder="Search">
					</div>
					<div class="card-search-button">
						<button type="submit">
							<i class="fa-solid fa-magnifying-glass"></i>
						</button>
					</div>
				</form>
			</div>
		</div>

		<div class="card-content">
			<table width="94%">
				<tr style="text-align: center;">
					<th>No</th>
					<th>Image</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>created_at</th>
				</tr>

				<?php if($result_num_rows > 0) { ?>

					<?php $i = 1 ?>

					<?php foreach ($this_product as $each): ?>
						
						<tr style="text-align: center;">
							<td><?php echo $i ?></td>
							<td>
								<img src="products/images/<?php echo $each['image'] ?>" height="100px" width="100px">
							</td>
							<td><?php echo $each['name'] ?></td>

							<?php 
								$product_id = $each['id'];
								$sql = "select 
											price, 
											sum(quantity) as quantity
										from products_detail
										join products on products.id = products_detail.product_id
										where product_id = '$product_id'
										group by price";
								$price_quantity = mysqli_query($connect, $sql);
								$each_price_quantity = mysqli_fetch_array($price_quantity);
							?>

							<td><?php echo $each_price_quantity['price'] ?></td>
							<td><?php echo $each_price_quantity['quantity'] ?></td>

							<?php 
								$date = date_create($each['created_at']);
								$created_at = date_format($date, "H:i:s d/m/Y");
							?>
							<td><?php echo $created_at ?></td>
						</tr>

						<?php $i++ ?>

					<?php endforeach ?>

				<?php } ?>
			</table>
		</div>
	</div>
</div>

<?php mysqli_close($connect) ?>