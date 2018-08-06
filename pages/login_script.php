<?php
	if ($_GET['get']) {
		$login = $_GET['login'];
		$password = $_GET['passwd'];
		$loginsession = $_GET['login'];
	}
	else {
		if ($_POST["login"] == FALSE or $_POST["passwd"] == FALSE or $_POST["submit"] != 'OK') {
			header("Location: login.php?loginErr=1&login=" . $_POST["login"]);
			exit("ERROR\n");
		}
		$login = $_POST['login'];
		$password = hash('whirlpool', $_POST['passwd']);
		$loginsession = $_POST['login'];
	}

	include('auth.php');

	if (auth($login, $password) === TRUE) {
		session_start();
		$_SESSION['loggued_on_user'] = $loginsession;
		header('Location: ../index.php');
		exit("OK\n");
	}
	header("Location: login.php?loginErr=1&login=" . $_POST["login"]);
	exit("ERROR\n");
?>