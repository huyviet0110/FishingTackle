<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>

	<style type="text/css">
		* {
			margin: 0;
			padding: 0;
			color: #FFFFFFCC;
		}

		#sidebar{
			width: 19%;
			height: 768px;
			background-color: #343A40;
		}

		.dashboard-logo {
			width: 100%;
			height: 8%;
		}
		.dashboard-logo a {
			text-decoration: none;
		}
		.dashboard-logo a span, .dashboard-logo a i {
			font-size: 24px;
			line-height: 61.44px;
		}
		.dashboard-logo a i {
			margin-left: 28px;
		}
		.dashboard-logo a span {
			margin-left: 8px;
		}

		.profile {
			width: 100%;
			height: 8%;
		}
		.profile a {
			text-decoration: none;
		}
		.profile a i, .profile a span {
			font-size: 24px;
			line-height: 61.44px;
		}
		.profile a i{
			margin-left: 28px;
		}
		.profile a span {
			margin-left: 8px;
		}

		.search-box {
			width: 100%;
			height: 8%;
			text-align: center;
		}
		.search-box [type='search'][name='search'] {
			width: 70%;
			line-height: 30px;
			margin-top: 6%;
			background-color: #3F474E;
			border: 1px solid #FFFFFFCC;
			padding-left: 10px;
			border-radius: 4px;
		}
		.search-box [type='submit'] {
			width: 20%;
			line-height: 30px;
			color: #FFFFF9;
			background-color: #3F474E;
			border: 1px solid #FFFFFFCC;
			cursor: pointer;
			border-radius: 4px;
		}
		.search-box [type='submit'] i {
			font-size: 15px;
		}

		.nav-bar .nav-item {
			font-size: 16px;
		}
		.nav-bar ul li {
			text-decoration: none;
			list-style-type: none;
			width: 100%;
			height: 40px;
			line-height: 40px;
			margin-left: 30px;
		}
		.nav-bar ul li a {
			text-decoration: none;
		}
		.nav-bar ul li i {
			width: 28px;
		}
	</style>
</head>
<body>
	<div id="sidebar">
		<div class="dashboard-logo">
			<a href="index.php">
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
				<input type="search" name="search" placeholder="Search"> 
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
						<span>Manufacturers</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="products">
						<i class="fa-solid fa-dumpster-fire"></i>
						<span>Products</span>
					</a>
				</li>
				<li class="nav-item">
					<i class="fa-solid fa-rectangle-list"></i>
					<a href="orders"><span>Orders</span></a>
				</li>
				<li class="nav-item">
					<a href="contacts">
					<i class="fa-solid fa-message"></i>
						<span>Messages</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="customers">
						<i class="fa-solid fa-users"></i>
						<span>Customers</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="news">
						<i class="fa-solid fa-newspaper"></i>
						<span>News</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="staffs">
						<i class="fa-solid fa-people-group"></i>
						<span>Staffs</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</body>
</html>