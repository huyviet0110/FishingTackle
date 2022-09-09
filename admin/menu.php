<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	
	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>
	<div id="sidebar">
		<div class="dashboard-logo">
			<a href="../admin">
				<i class="fa-solid fa-gauge-high"></i>
				<span>Dashboard</span>
			</a>
			<hr>
		</div>

		<div class="profile">
			<a href="profile.php">
				<i class="fa-solid fa-address-card"></i>
				<span>Profile</span>
				<!-- name -->
			</a>
			<hr>
		</div>

		<div class="search-box">
			<form method="get" action="index.php">
				<input type="search" name="search_nav_item" placeholder="Search"> 
				<button type="submit">
					<i class="fa-solid fa-magnifying-glass"></i>
				</button>
			</form>
		</div>

		<div class="nav-bar">
			<ul>
				<li class="nav-item">
					<a href="manufacturers">
						<i class="fa-solid fa-city"></i>
						<p>
							Manufacturers
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="products">
						<i class="fa-solid fa-dumpster-fire"></i>
						<p>
							Products
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="orders">
						<i class="fa-solid fa-rectangle-list"></i>
						<p>
							Orders
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="contacts">
					<i class="fa-solid fa-message"></i>
						<p>
							Contacts
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="customers">
						<i class="fa-solid fa-users"></i>
						<p>
							Customers
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="news">
						<i class="fa-solid fa-newspaper"></i>
						<p>
							News
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="staffs">
						<i class="fa-solid fa-people-group"></i>
						<p>
							Staffs
						</p>
					</a>
				</li>
			</ul>
		</div>
	</div>
</body>
</html>