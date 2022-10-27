<?php 

	require_once '../connect.php';

	$days_needed = $_GET['days_needed'] + 1;
	$arr_total_products = [];
	$arr_total_products_by_day = [];

	$sql = "select 
						products.id,
						products.name,
						DATE_FORMAT(orders.created_at, '%e-%m') as 'date',
						sum(orders_products.quantity) AS 'quantity'
					from orders 
					join orders_products on orders_products.order_id = orders.id 
					join products on products.id = orders_products.product_id 
					where date(orders.created_at) >= curdate() - interval $days_needed day
					group by products.id, date";
	$result = mysqli_query($connect, $sql);

	$today = date('d');
	$current_date = date_create(date('Y-m-d'));
	$this_month = date_format($current_date, 'm');
	$max_date_last_month = (new DateTime())->format('t');
	$last_month = date('m', strtotime("-1 month"));

	foreach ($result as $each) {
		if(empty($arr_total_products[$each['id']])){
			$arr_total_products[$each['id']] = [
				'name' => $each['name'],
				'y' => (int)$each['quantity'],
				'drilldown' => $each['id']
			];
		} else {
			$arr_total_products[$each['id']]['y'] += $each['quantity'];
		}
	}

	foreach ($arr_total_products as $key => $each) {
		$arr_total_products_by_day[$key] = [
			'name' => $each['name'],
			'id' => (string)$key,
		];

		if($today >= $days_needed){
			$start_date_this_month = $today - $days_needed + 1;
			for ($i = $start_date_this_month; $i <= $today; $i++) { 
				$date = $i . '-' . $this_month;
				$arr_total_products_by_day[$key]['data'][$date] = [
					$date,
					0
				];
			}
		} else {
			$get_days_last_month = $days_needed - $today;
			$start_date_last_month = $max_date_last_month - $get_days_last_month + 1;
			for ($i = $start_date_last_month; $i <= $max_date_last_month; $i++) { 
				$date = $i . '-' . $last_month;
				$arr_total_products_by_day[$key]['data'][$date] = [
					$date,
					0
				];
			}

			for ($i = 1; $i <= $today; $i++) { 
				$date = $i . '-' . $this_month;
				$arr_total_products_by_day[$key]['data'][$date] = [
					$date,
					0
				];
			}
		}
	}

	foreach ($result as $each) {
		$key = $each['id'];
		$date = $each['date'];
		$arr_total_products_by_day[$key]['data'][$each['date']] = [
			$date,
			(int)$each['quantity']
		];
	}

	$arr = [$arr_total_products, $arr_total_products_by_day];
	echo json_encode($arr);

	mysqli_close($connect);