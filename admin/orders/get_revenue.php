<?php 

	require_once '../connect.php';

	$days_needed = $_GET['days_needed'];
	$arr_statistics = [];

	$sql = "select 
						DATE_FORMAT(created_at, '%e-%m') as 'date',
						sum(total_payment) as 'sale'
					from orders 
					group by date";
	$result = mysqli_query($connect, $sql);

	$today = date('d');
	$current_date = date_create(date('Y-m-d'));
	$this_month = date_format($current_date, 'm');
	$max_date_last_month = (new DateTime())->format('t');
	$last_month = date('m', strtotime("-1 month"));

	if($today >= $days_needed){
		$start_date_this_month = $today - $days_needed + 1;
		for ($i = $start_date_this_month; $i <= $today; $i++) { 
			$date = $i . '-' . $this_month;
			$arr_statistics[$date] = 0;
		}
	} else {
		$get_days_last_month = $days_needed - $today;
		$start_date_last_month = $max_date_last_month - $get_days_last_month + 1;
		for ($i = $start_date_last_month; $i <= $max_date_last_month; $i++) { 
			$date = $i . '-' . $last_month;
			$arr_statistics[$date] = 0;
		}

		for ($i = 1; $i <= $today; $i++) { 
			$date = $i . '-' . $this_month;
			$arr_statistics[$date] = 0;
		}
	}

	foreach ($result as $each) {
		if(in_array($each['date'], array_keys($arr_statistics))){
			$arr_statistics[$each['date']] = (int)$each['sale'];
		}
	}

	mysqli_close($connect);

	echo json_encode($arr_statistics);