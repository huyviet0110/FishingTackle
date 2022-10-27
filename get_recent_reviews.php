<?php 

	$id = $_POST['id'];

	require_once 'admin/connect.php';

	$sql = "select 
				products_reviews.rating,
				products_reviews.review,
				products_reviews.created_at,
				customers.avatar,
				customers.name
			from products_reviews
			join customers on customers.id = products_reviews.customer_id
			where products_reviews.product_id = '$id'
			order by products_reviews.created_at asc
			limit 3";
	$result = mysqli_query($connect, $sql);

	$arr_recent_reviews = [];

	foreach ($result as $each) {
		$created_at = $each['created_at'];
		$created_at = date_create($created_at);
		$created_at = date_format($created_at, "H:i:s d/m/Y");

		$rating = $each['rating'];
		$rating_stars = '';
		if(($rating / 0.5) % 2 !== 0){
			$rating_stars .= "<label class = 'full' style='color: #ddd'></label><label class = 'half' style='color: #FFD700'></label>";

			for ($i = 1; $i < $rating; $i++) { 
				$rating_stars .= "<label class = 'full' style='color: #FFD700'></label>";
			}
		} else {
			for ($i = 1; $i <= $rating; $i++) { 
				$rating_stars .= "<label class = 'full' style='color: #FFD700'></label>";
			}
		}

		$rating_stars = htmlspecialchars($rating_stars, ENT_QUOTES, 'UTF-8');

		$arr_recent_reviews[] = [
			'avatar' => $each['avatar'],
			'name' => $each['name'],
			'rating' => $rating_stars,
			'review' => $each['review'],
			'created_at' => $created_at
		];
	}

	echo json_encode($arr_recent_reviews);
	
	mysqli_close($connect);