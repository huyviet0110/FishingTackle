<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div id="dashboard">
		<div class="header">
			<div class="left">
				<p>Dashboard</p>
			</div>
			<div class="right">
				<p>huyviet / </p>
				<a href="sign_out.php">
					Sign out
				</a>
			</div>
		</div>

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

			<div class="below">
				<div class="table-title">
					<h3>Message from customer</h3>
					<form>
						<input type="search" name="search">
						<button type="submit">
							<i class="fa-solid fa-magnifying-glass"></i>
						</button>
					</form>
				</div>

				<div class="table-content">
					<table width="94%">
						<tr>
							<th>ID</th>
							<th>Created at</th>
							<th>Message</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
						</tr>

						<tr>
							<td>abc</td>
							<td>abc</td>
							<td>abc</td>
							<td>abc</td>
							<td>abc</td>
							<td>abc</td>
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

		<div class="footer">
			<p>
				<strong>
					Copyright
					<i class="fa-regular fa-copyright"></i>
					2021-2022 
					<a href="index.php">FishingTackle.</a>
				</strong>
				All rights reserved
			</p>
		</div>
	</div>
</body>
</html>