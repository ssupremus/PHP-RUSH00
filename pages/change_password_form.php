<!DOCTYPE html>
<html>
	<head>
		<title>Change password form</title>
		<link rel="stylesheet" href="../styles/chngpasswd.css">
	</head>

	<body>
		<form action="change_password_script.php" method="post">
			<div class="page-title">
				Change YOUR PASSWORD below:
			</div>
			<?php
				if ($_GET['error'] or $_GET['loginErr']) {
					echo "<div class=\"error-msg-on\">Wrong info!</div>";
				}
				else {
					echo "<div class=\"error-msg-off\">Wrong info!</div>";
				}
			?>
			<span class="input-header">Login:</span> 
			<br/>
			<input class="input-field" type="text" name="login" value="" placeholder="username" />
			<br/>
			<span class="input-header">OLD password:</span> 
			<br/>
			<input class="input-field" type="password" name="oldpasswd" value="" placeholder="old password" />
			<br/>
			<span class="input-header">NEW password:</span> 
			<br/>
			<input class="input-field" type="password" name="passwd" value="" placeholder="new password" />
			<br/>
			<span class="input-header">Repeat NEW password:</span> 
			<br/>
			<input class="input-field" type="password" name="newpasswd" value="" placeholder="repeat new password" />
			<br/>
			<input class="input-field-ok submit-button" id="butt" type="submit" name="submit" value="OK" />
			<a class="input-field-ok cancel-button" href="../index.php" class="button-close">CANCEL</a>
		</form>
	</body>
</html>