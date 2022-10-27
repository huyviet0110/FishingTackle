<div id="header">
	<div class="above">
		<div class="left">
			<!-- <form>
				<div>
					<a href="#">
						<i class="fa-solid fa-magnifying-glass"></i>
						Search
					</a>
				</div>
			</form> -->
		</div>
		<div class="right">
			<ul>
				<?php if(isset($_SESSION['id'])) { ?>
					<?php if(!is_null($_SESSION['avatar'])){ ?>
						<li style="padding-right: 8px;">
							<a href="users">
								<img src="users/avatars/<?php echo $_SESSION['avatar'] ?>" height="40px" width="40px" style="border: 1px solid white; border-radius: 50%;">
							</a>
						</li>
					<?php } ?>
					<li>
						<a href="users"><?php echo $_SESSION['name'] ?></a>
					</li>
				<?php } else { ?>
					<li>
						<a href="sign_in.php">Sign in</a>
					</li>
					<li>
						<a href="sign_up.php">Sign up</a>
					</li>
				<?php } ?>
				<li>
					<a href="view_cart.php">
						<i class="fa-solid fa-cart-shopping"></i>
						Cart
					</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="below">
		<div class="center" style="font-family: sans-serif; text-transform: uppercase;">
			<p>Only $46.55 away from free shipping</p>
		</div>
	</div>
</div>