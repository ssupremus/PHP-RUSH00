<!DOCTYPE html>
<html>
	<head>
		<title>Shop intro</title>
		<link rel="stylesheet" type="text/css" href="styles/intro.css">
	</head>
	<body>
		<form action="./install.php" method="POST">
			<br/>
			<br/>
			<div class="first-msg">
				<span>Hello dear! This is one time shop setup page.</span> <br/>
				<span>Please, fill the fields below.</span> <br/>
				<span>Input your MySQL login, MySQL password and name of the new database.</span> <br/>
				<span>After this a new database will be created and page will be relocate.</span> <br/>
			</div>
			<br/>
			<br/>
			<span class="input-header">MYSQL login:</span> 
			<br/>
			<br/>
			<input class="input-field" type="text" name="msqlogin" value="<?php echo $_GET['msqlogin']; ?>" placeholder="MySql Login" />
			<br/>
			<br/>
			<span class="input-header">MYSQL password:</span>
			<br/>
			<br/>
			<input class="input-field" type="password" name="msqpasswd" value="<?php echo $_GET['msqpasswd']; ?>" placeholder="MySql Password" />
			<br/>
			<br/>
			<span class="input-header">Choose the name for MYSQL database:</span> 
			<br/>
			<br/>
			<input class="input-field dbname" type="text" name="dbname" value="" placeholder="Name of the new Mysql database" />
			<br/>
			<br/>
			<input class="input-field-ok" id="butt" type="submit" name="submit" value="OK" />
		</form>
	</body>
</html>
