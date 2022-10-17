<div class="header">
	<div class="left">
		<a href="../../" style="text-decoration: none;">
			<p>Home</p>
		</a>
	</div>
	<div class="right">
		<?php if(!empty($_SESSION['avatar'])){ ?>
			<img src="avatars/<?php echo $_SESSION['avatar'] ?>" height="40px" width="40px" style="border: 1px solid white; border-radius: 50%;">
		<?php } else { ?>
			<i class="fa-solid fa-user"></i>
		<?php } ?>
		<p><?php echo $_SESSION['name'] ?> / </p>
		<a href="../../sign_out.php">
			Sign out
		</a>
	</div>
</div>