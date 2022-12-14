<?php 

session_start();
require_once 'admin/connect.php';

if(empty($_SESSION['id'])){
	echo "You must signin to order!";
	exit();
}

if(empty($_SESSION['cart'])){
	echo "Cart is empty!";
	exit();
}

if(empty($_POST['receiver_name']) || empty($_POST['receiver_address']) || empty($_POST['receiver_phone']) || empty($_SESSION['cart'])){
	echo "You must fill in all the information!";
	exit();
}

$cart = $_SESSION['cart'];
$receiver_name = $_POST['receiver_name'];
$receiver_address = $_POST['receiver_address'];
$receiver_phone = $_POST['receiver_phone'];
$total_payment = 0;
$customer_id = $_SESSION['id'];

$sql = "select max(id) from orders";
$result = mysqli_query($connect, $sql);
$order_id = mysqli_fetch_array($result)['max(id)'] + 1;

foreach ($cart as $product => $each) {
	$total_payment += $each['price'] * $each['quantity'];
}

$sql = "insert into orders (id, receiver_name, receiver_address, receiver_phone, total_payment, status, customer_id)
		values ('$order_id', '$receiver_name', '$receiver_address', '$receiver_phone', '$total_payment', '0', '$customer_id')";
mysqli_query($connect, $sql);
$error = mysqli_error($connect);
if(!empty($error)){
	echo "Please, try again!';";
	exit();
}

foreach ($cart as $product => $each) {
	$quantity = $each['quantity'];
	$sql = "insert into orders_products (order_id, product_id, quantity)
			values ('$order_id', '$product', '$quantity')";
	mysqli_query($connect, $sql);
}

unset($_SESSION['cart']);

mysqli_close($connect);

echo 1;