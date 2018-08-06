<?php

	include('main.php');

	$id_ord = rand(0, 2147483647);
	session_start();
	foreach ($users as $val) {
		if ($val['username'] == $_SESSION['loggued_on_user']) {
			$to = $val['email'];
			$sql = "INSERT INTO orders (id_ord, username, email, address)
			VALUES ($id_ord, '" . $val['username'] . "', '" . $val['email'] . "', '" . $val['address'] . "')";
			if (!mysqli_query($conn, $sql)) {
				die("Error filling users: " . mysqli_error($conn));
			}
			break ;
		}
	}
	$total = 0;
	$ord_name = "orderno_$id_ord";
	$sql = "CREATE TABLE $ord_name (
		id_ord INT(11) UNSIGNED NOT NULL,
		title VARCHAR(255) NOT NULL,
		price VARCHAR(255) NOT NULL,
		quantity INT(11) NOT NULL)";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating order: " . mysqli_error($conn));
	}
	$message = '<h1>Dear, ' . $_SESSION['loggued_on_user'] . '!</h1>';
	$message .= '<h3>ID ORDER: ' . $id_ord .'</h3>';
	$message .= "<h3>You alredy bought:</h3>";
	$message .="<table><tr><td><b>NAME</b></td><td><b>PRICE</b></td><td><b>QUANTITY</b></td><td><b>TOTAL</b></td></tr>";
	foreach($_SESSION['basket'] as $key => $value) {
		$title = $products[$key]['title'];
		$price = $products[$key]['price'];
		$quantity = $_SESSION['basket'][$key]['quantity'];
		
		$sql = "INSERT INTO $ord_name (id_ord, title, price, quantity)
		VALUES ($id_ord, '$title', '$price', $quantity)";
		if (!mysqli_query($conn, $sql)) {
			die("Error creating order: " . mysqli_error($conn));
		}
		$message .= "<tr><td>" . $title . "</td><td>" . $price . "$</td><td>" . $quantity ."</td><td>" . ($price * $quantity) . "$</td></tr>";
		$total = $total + ($price * $quantity);
	}
	$headers = "From: medieval@armor.io\r\n";
	$headers .= "Reply-To: medieval@armor.io\r\n";
	$headers .= "CC: medieval@armor.io\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$message .= "</table><h2>Total price: " . $total . "$</h2>";
	$message .= "<h3>Thanks for your order! Come back soon!</h3>";
	mail($to, "Invoice/Order details", $message, $headers);
	$_SESSION['basket'] = FALSE;
	header('Location: index.php');

?>