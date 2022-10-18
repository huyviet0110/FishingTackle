<div id="sidebar">
	<div class="dashboard-logo">
		<a href="../">
			<i class="fa-solid fa-gauge-high"></i>
			<span>Dashboard</span>
		</a>
		<hr>
	</div>

	<div class="profile">
		<a href="../personal_information">
			<?php if(empty($_SESSION['avatar'])) { ?>
				<i class="fa-solid fa-user"></i>
				<span>Profile</span>
			<?php } else { ?>
				<img src="../avatars/<?php echo $_SESSION['avatar'] ?>" height="40px" width="40px" style="border: 1px solid white; border-radius: 50%; margin-top: 0px;">
				<span style="margin-left: 72px;">Profile</span>
			<?php } ?>
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
				<a href="../personal_information">
					<i class="fa-solid fa-address-card"></i>
					<p>
						Personal information
					</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../payment_history">
					<i class="fa-solid fa-dumpster-fire"></i>
					<p>
						Payment history
					</p>
				</a>
			</li>
		</ul>
	</div>
</div>