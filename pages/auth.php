<?php
	function auth($login, $passwd)
	{
		$content = file_get_contents('../access_db_info.csv');
		if (!$content) {
			header('Location: ../intro.html');
		}
		$content = explode(';', $content);

		$connection = mysqli_init();
		if (!$connection) {
			die('mysqli_init failed');
		}
		if (!mysqli_options($connection, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT = 0")) {
			die('MYSQLI_INIT_COMMAND failed');
		}
		if (!mysqli_real_connect($connection,"localhost", $content[0], $content[1], $content[2])) {
			die("mysqli_real_connectionect failed: " . mysqli_connect_error());
		}

		$users = array();
		if ($res = mysqli_query($connection, 'SELECT * FROM users')) {
			while ($tmp = mysqli_fetch_assoc($res)) {
				$users[] = $tmp;
			}
			mysqli_free_result($res);
		}

		foreach ($users as $val) {
			if ($val['username'] == $login && $val['password'] == $passwd) {
				mysqli_close($connection);
				return TRUE;
			}
		}
		mysqli_close($connection);
		return FALSE;
	}
?>