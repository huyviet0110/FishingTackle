<?php 

	$sql = "select * from types";
	$result = mysqli_query($connect, $sql);

?>

<div id="menu">
	<div class="left">
		<a href="index.php">
			<img src="logo/logo.png">
		</a>
	</div>

	<div class="right">
		<ul	class="nav">
			<li class="nav-item">
				<a href="collections.php"> 
					SHOP 
					<i class="fa-solid fa-sort-down" style=""></i>
				</a>
				<ul class="sub-nav">
					<li class="nav-item" style="border-top: 4px solid #D0D0CF;">
						<a href=collections.php>  SHOP ALL  </a>
					</li>

					<?php foreach ($result as $each): ?>
						<li class="nav-item">
							<a href="collections.php?type_id=<?php echo $each['id'] ?>"
								style="text-transform: uppercase;">
								<?php echo $each['name'] ?>
							</a>
						</li>
					<?php endforeach ?>
				</ul>
			</li>

			<li class="nav-item"><a href="about.php">   ABOUT   </a></li>
			<li class="nav-item"><a href="contact.php"> CONTACT </a></li>
		</ul>
	</div>
</div>