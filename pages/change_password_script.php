<?php
	if ($_POST["login"] == FALSE or $_POST["oldpasswd"] == FALSE or $_POST["passwd"] == FALSE or $_POST["newpasswd"] == FALSE or $_POST["newpasswd"] != $_POST["passwd"] or $_POST["submit"] != 'OK') {
		header('Location: change_password_form.php?error=1');
		exit("ERROR\n");
	}

	$login = $_POST['login'];
	$password = hash('whirlpool', $_POST["oldpasswd"]);

	include('auth.php');

	if (auth($login, $password) === TRUE) {
		$content = file_get_contents('../access_db_info.csv');
		if (!$content) {
			header('Location: ../intro.php');
		}
		$content = explode(';', $content);
		$connection = mysqli_connect("localhost", $content[0], $content[1], $content[2]);
		$passwd = hash('whirlpool', $_POST["passwd"]);
		$sql = "UPDATE users SET `password` = '" . $passwd . "' WHERE `username` = '" . $login . "'";
		if (!mysqli_query($connection, $sql)) {
			die("Error: " . mysqli_error($connection));
		}
		else {

			$users = array();
			if ($result = mysqli_query($connection, 'SELECT * FROM users')) {
				while ($tmp = mysqli_fetch_assoc($result)) {
					$users[] = $tmp;
				}
				mysqli_free_result($result);
			}
			foreach ($users as $val) {
				if ($val['username'] == $login) {
					$to = $val['email'];
				}
			}
			$headers = "From: medieval@armor.io\r\n";
			$headers .= "Reply-To: medieval@armor.io\r\n";
			$headers .= "CC: medieval@armor.io\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$message = "<h1>Dear ". $login ."!</h1>";
			$message .= "<h3>Your password has been changed!</h1>";
			$message .= "<h3>Thanks for choosing us!</h3>";
			mail($to, "Password modification", $message, $headers);
			mysqli_close($connection);
			header('Location: ../index.php');
			exit("OK\n");
		}
	}
	header('Location: change_password_form.php?loginErr=2');
	exit("ERROR\n");
?>