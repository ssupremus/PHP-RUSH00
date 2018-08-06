<!DOCTYPE html>
<html>
	<head>
		<title>Creation user form</title>
		<link rel="stylesheet" href="../styles/createuser.css">
	</head>

	<body>
		<form action="accounts_maker.php" method="post">
			<div class="page-title">
				Fill account informtion
			</div>
			<?php
				if ($_GET['loginErr'] == 1) {
					echo "<div class=\"error-msg-on\">Wrong info! Please check entry fields</div>";
				}
				else if ($_GET['loginErr'] == 2) {
					echo "<div class=\"error-msg-on\">User already exists.</div>";
				}
				else {
					echo "<div class=\"error-msg-off\">Check the input fields!</div>";
				}
			?>
			<span class="input-header">Username:</span> 
			<br/>
			<input class="input-field" type="text" name="login" value="<?php echo $_GET['login']; ?>" placeholder="Username" />
			<br/>
			<span class="input-header">Password:</span> 
			<br/>
			<input class="input-field" type="password" name="passwd" value="" placeholder="Password" />
			<br/>
			<span class="input-header">Shipping address:</span> 
			<br/>
			<input class="input-field" type="text" name="address" value="<?php echo $_GET['address']; ?>" placeholder="address" />
			<br/>
			<span class="input-header">Your @ email:</span> 
			<br/>
			<input class="input-field" type="email" name="email" value="<?php echo $_GET['email']; ?>" placeholder="example@email.com" />
			<br/>
			<input class="input-field-ok submit-button" id="butt" type="submit" name="submit" value="OK" />
			<a class="input-field-ok cancel-button" href="../index.php" class="close">cancel</a>
		</form>
	</body>
</html>