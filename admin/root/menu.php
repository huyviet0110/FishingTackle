<div id="sidebar">
	<div class="dashboard-logo">
		<a href="../">
			<i class="fa-solid fa-gauge-high"></i>
			<span>Dashboard</span>
		</a>
		<hr>
	</div>

	<div class="profile">
		<a href="#">
			<img src="../staffs/avatars/<?php echo $_SESSION['admin_avatar'] ?>" height="40px" width="40px" style="border: 1px solid white; border-radius: 50%;">
			
			<span style="margin-left: 72px;">Profile</span>
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
				<a href="../manufacturers">
					<i class="fa-solid fa-city"></i>
					<p>
						Manufacturers
					</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../products">
					<i class="fa-solid fa-dumpster-fire"></i>
					<p>
						Products
					</p>
				</a>

				<ul class="sub-nav">
					<li class="nav-item">
						<a href="../types">
							<i class="fa-regular fa-circle"></i>
							<p>
								Types
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="../sizes">
							<i class="fa-regular fa-circle"></i>
							<p>
								Sizes
							</p>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item">
				<a href="../orders">
					<i class="fa-solid fa-rectangle-list"></i>
					<p>
						Orders
					</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="#">
					<i class="fa-solid fa-message"></i>
					<p>
						Contacts
					</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../customers">
					<i class="fa-solid fa-users"></i>
					<p>
						Customers
					</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="#">
					<i class="fa-solid fa-newspaper"></i>
					<p>
						News
					</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../staffs">
					<i class="fa-solid fa-people-group"></i>
					<p>
						Staffs
					</p>
				</a>

				<ul class="sub-nav">
					<li class="nav-item">
						<a href="../positions">
							<i class="fa-regular fa-circle"></i>
							<p>
								Positions
							</p>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>