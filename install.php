<?php
	if ($_POST["msqlogin"] == FALSE or $_POST["msqpasswd"] == FALSE or$_POST["dbname"] == FALSE  or $_POST["submit"] != "OK") {
		exit("BAD INPUT\n");
	}

	$servername = "localhost";
	$username = $_POST['msqlogin'];
	$password = $_POST['msqpasswd'];
	$dbname = $_POST['dbname'];

	$conn = mysqli_connect($servername, $username, $password);

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	unlink('access_db_info.csv');
	$sql = "DROP DATABASE IF EXISTS $dbname";
	mysqli_query($conn, $sql);

	$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating database: " . mysqli_error($conn));
	}
	mysqli_close($conn);
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$sql = "CREATE TABLE IF NOT EXISTS categories (
			id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
			title VARCHAR(255) NOT NULL
			)";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating categories: " . mysqli_error($conn));
	}

	$sql = "INSERT INTO categories (id, title)
			VALUES (1, 'Armor'), (2, 'Scrolls'), (3, 'Weapons')";
	if (!mysqli_query($conn, $sql)) {
		die("Error filling categories: " . mysqli_error($conn));
	}

	$sql = "CREATE TABLE IF NOT EXISTS products (
			id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
			title VARCHAR(255) NOT NULL,
			img VARCHAR(255) DEFAULT NULL,
			category VARCHAR(255) DEFAULT NULL,
			intro text NOT NULL,
			price DECIMAL(10,0) NOT NULL,
			stats VARCHAR(255) DEFAULT NULL
			)";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating products: " . mysqli_error($conn));
	}

	$sql = "INSERT INTO products (id, title, img, intro, price, category, stats)
			VALUES (1, 'Body armor', 'https://i.pinimg.com/originals/ff/a8/1f/ffa81f6503b8249ec570d4d5fc3518ea.png', 'Will defence you through evaluations', '1024', 'Armor', 'Defence + 64'),
			(2, 'Resurection scroll', 'http://static.ncsoft.com/lineage2/store/lucky/2012_Nov/blessedscrollofresurrection.png', 'Сan resurrect any project', '4096', 'Scrolls', 'Sustain + 999'),
			(3, 'Long sword', 'http://www.buyingasword.com/images/Product/large/AH-6972.png', 'Can destroy any error', '2048', 'Weapons', 'Damage + 128'),
			(4, 'Teleportation scroll', 'http://static.ncsoft.com/lineage2/store/lucky/2012_Nov/blessedscrollofescape.png', 'Can teleports anywhere, even at that time \"when everything worked\"', '528', 'Scrolls', 'Just need everyone!'),
			(5, 'Crossbow', 'https://www.medievalarchery.com/images/Category/medium/897.png', 'Can shoot any memory leak', '2048', 'Weapons', 'Range 1900'),
			(6, 'Helmet', 'https://s3-eu-west-1.amazonaws.com/mordhau-media/spirit/images/1394/8d53423564e10992410d988929106832.png', 'Gives expert knowledge of any programming language', '20', 'Armor', 'Weight 32'),
			(7, 'Gloves', 'http://www.blades4you.com/store/images/Gauntlets.png', 'keyboard input speed + 24', '200', 'Armor', 'Agility -32'),
			(8, 'Mage stuff', 'https://i.pinimg.com/736x/30/b4/5b/30b45bf5feebbf44d05faddd4c295cbf--wizard-staff-magic-wands.jpg', 'Knows how to do magic! Be care!', '42', 'Weapons', 'For WIZZARD`S only!'),
			(9, 'Giant armor scroll', 'http://static.ncsoft.com/lineage2/store/lucky/2014_Sep/giantarmorscroll.png', 'Can pump any armor item', '100', 'Scrolls', 'ALL item stats +20')";
	if (!mysqli_query($conn, $sql)) {
		die("Error filling products: " . mysqli_error($conn));
	}

	$sql = "CREATE TABLE IF NOT EXISTS categories_products (
			id_category INT(11) NOT NULL, 
			id_product INT(11) NOT NULL,
			PRIMARY KEY (id_category, id_product)
			)";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating categories_products: " . mysqli_error($conn));
	}
	$sql = "INSERT INTO categories_products (id_category, id_product)
			VALUES (1, 1), (2, 2), (3, 3), (1, 6), (2, 4), (3, 5), (1, 7), (2, 9), (3, 8)";
	if (!mysqli_query($conn, $sql)) {
		die("Error filling categories: " . mysqli_error($conn));
	}

	$sql = "CREATE TABLE IF NOT EXISTS orders (
		id_ord INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
		username VARCHAR(255) NOT NULL,
		email VARCHAR(255),
		address VARCHAR(255)
	)";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating order: " . mysqli_error($conn));
	}

	$sql = "CREATE TABLE IF NOT EXISTS users (
			id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
			username VARCHAR(255) NOT NULL,
			password TEXT NOT NULL,
			isadmin BOOLEAN NOT NULL,
			email VARCHAR(255),
			address VARCHAR(255)
			)";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating users: " . mysqli_error($conn));
	}
	$adminPass = hash('whirlpool', 'admin');
	$sql = "INSERT INTO users (id, username, password, isadmin)
		VALUES (1, 'admin', '" . $adminPass . "', true)";
	if (!mysqli_query($conn, $sql)) {
		die("Error filling users: " . mysqli_error($conn));
	}

	file_put_contents('access_db_info.csv', "$username;$password;$dbname");
	mysqli_close($conn);
	session_start();
	foreach ($_SESSION as $key => $value) {
		$_SESSION[$key] = FALSE;
	}
	header('Location: index.php');
?>