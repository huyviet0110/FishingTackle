<?php 
	require_once 'connect.php';
	$table_name = 'contacts';
	require_once 'root/pagination.php';
?>

<div class="content">
	<div class="above">
		<ul>
			<li>
				<a href="new_orders.php">
					<p class="statistics">25</p>
					<i class="fa-solid fa-bag-shopping"></i>
					<p>
						New Orders
					</p>
				</a>
			</li>
			<li>
				<a href="cancellationrate.php">
					<p  class="statistics">25%</p>
					<i class="fa-solid fa-signal"></i>
					<p>
						Cancellation Rate
					</p>
				</a>
			</li>
			<li>
				<a href="user_registrastrions.php">
					<p  class="statistics">1000</p>
					<i class="fa-solid fa-user-plus"></i>
					<p> 
						User Registrations
					</p>
				</a>
			</li>
			<li>
				<a href="unique_visitors.php">
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
				<h3 class="h3-format">Contacts from customer</h3>
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
				<tr>
					<th>ID</th>
					<th>Created at</th>
					<th>Message (Short description)</th>
					<th>Details</th>
					<th>Status</th>
					<th>Action</th>
				</tr>

				<tr>
					<td>1</td>
					<td>01-01-2022</td>
					<td>fdsafa</td>
					<td>view</td>
					<td>Not answered</td>
					<td>delete</td>
				</tr>
				<tr>
					<td>abc</td>
					<td>abc</td>
					<td>abc</td>
					<td>abc</td>
					<td>abc</td>
					<td>abc</td>
				</tr>
			</table>
		</div>
	</div>
</div>