<?php
	$is_basket = TRUE;

	$cont = file_get_contents('access_db_info.csv');
	if (!$cont) {
		header('Location: intro.php?msqlogin=root&msqpasswd=rotten');
	}

	$cont = explode(';', $cont);
	

	if (!($conn = mysqli_connect("localhost", $cont[0], $cont[1], $cont[2]))) {
		echo "ERROR\n";
		die("Connection failed: " . mysqli_connect_error());
	}


	$categories = array();
	if ($result = mysqli_query($conn, 'SELECT * FROM categories')) {
		while ($tmp = mysqli_fetch_assoc($result)) {
			$categories[] = $tmp;
		}
		mysqli_free_result($result);
	}


	$products = array();

	if ($cat = isset($_REQUEST['cat'])) {
		$cat = (int) $_REQUEST['cat'];
	}
	else {
		$cat = 0;
	}

	$sql = 'SELECT p.* FROM products AS p ';
	if ($cat) {
		$sql .= ' INNER JOIN categories_products AS cp ON cp.id_product=p.id AND cp.id_category=' . $cat;
	}
	if ($result = mysqli_query($conn, $sql)) {
		while ($tmp = mysqli_fetch_assoc($result)) {
			$products[] = $tmp;
		}
		mysqli_free_result($result);
	}

	$users = array();
	if ($result = mysqli_query($conn, 'SELECT * FROM users')) {
		while ($tmp = mysqli_fetch_assoc($result)) {
			$users[] = $tmp;
		}
		mysqli_free_result($result);
	}
	session_start();
	if (!$_SESSION['basket']) {
		$_SESSION['basket'] = array();
	}
?>