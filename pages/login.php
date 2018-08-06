<!DOCTYPE html>
<html>
	<head>
		<title>Sign in form</title>
		<link rel="stylesheet" href="../styles/login.css">
	</head>

	<body>

	<div class="page-title">
		<div class="user-login-text">
			USER login form
		</div>
	</div>

		<form action="login_script.php" method="POST">
		
			<?php
		
				if ($_GET['loginErr'] == 1) {
					echo "<div class=\"error-msg-on\">Incorrect login informatin! Check the login field or password.</div>";
				}
				else {
					echo "<div class=\"error-msg-off\">Incorrect login informatin! Check the login field or password.</div>";
				}
		
			?>
			
			<span class="input-header">Login:</span> 
			<br/>
			<input class="input-field" type="text" name="login" value="<?php echo $_GET['login']; ?>" placeholder="Username" />
			<br/>
			<span class="input-header">Password:</span> 
			<br/>
			<input class="input-field" type="password" name="passwd" value="" placeholder="Password" />
			<br/>
			<input class="input-field-ok submit-button" class="input-field" id="butt" type="submit" name="submit" value="OK" />
			<a class="input-field-ok cancel-button" href="../index.php" class="close">cancel</a>
		</form>

		<div class="create-new-user-button">
			<a href="create_user_page.php">create NEW account</a><br/>
		</div>

	</body>
</html>