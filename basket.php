<?php
	
	include('main.php');

	$categories = FALSE;
	$is_basket = FALSE;
	session_start();
	if ($_GET['additem']) {
		$_GET['item'] = $_GET['additem'];
	}
	if ($_GET['item']) {
		foreach ($products as $key => $value) {
			if ($value['id'] == $_GET['item']) {
				$_SESSION['basket'][$key] = array();
				$_SESSION['basket'][$key]['id'] = $_GET['item'];
				if (!($_SESSION['basket'][$key]['quantity']))
					$_SESSION['basket'][$key]['quantity'] = 1;
					unset($_GET['item']);
				break ;
			}
		}
	}
	if ($_GET['additem']) {
		header('Location: index.php?hey');
	}
?>

<html>
	<head>
		<title>basket</title>
		<link rel="stylesheet" type="text/css" href="styles/main.css">
		<link rel="stylesheet" type="text/css" href="styles/basket.css">
	</head>
	<body>

		<?php 

		include('header.php'); 

		?>

		<div class="basket-block">

			<?php

				foreach($_SESSION['basket'] as $key => $value) {
					if ($_GET[$key . "discard"])
						unset($_SESSION['basket'][$key]);
				}
				if (count($_SESSION['basket']) == 0) {
					echo '<h2 class="buy-something">To our regret, you did not like anything from our goods made with a soul and placed for purchase. 
You can return to the main page of the store and make purchases by clicking this <a class="back-to-main"href="index.php">button</a></h2>';
					exit();
				}

			?>

				<div class="basket-row-title">All goods what u whant to buy:</div>
				<table>
					<tr class="title">
						<td>Name</td>
						<td>Price</td>
						<td>Quantity</td>
						<td>Total</td>
						<td></td>
					</tr>

			<?php

				$final_price = 0;
				foreach($_SESSION['basket'] as $key => $value) {
					$quantity = $_SESSION['basket'][$key]['quantity'];
					$title = $products[$key]['title'];
					$price = $products[$key]['price'];
					$total_price = $quantity * $price;

			?>
					<tr>
						<td><?php echo $title; ?></td>
						<td><?php printf("%d", $price); ?></td>
						<td>
							<form id='myform' method='get' action='basket.php'>

			<?php
									if ($_GET[$key . 'quantity'] && ($_GET[$key . 'quantity'] != $_SESSION['basket'][$key]['quantity'])) {
										$_SESSION['basket'][$key]['quantity'] = $_GET[$key . 'quantity'];
										unset($_GET[$key . 'quantity']);
										header('Location: basket.php');
									}
									else if ($_GET[$key . 'up']) {
										$_SESSION['basket'][$key]['quantity']++;
										header('Location: basket.php');
									}
									else if ($_GET[$key . 'down']) {
										$_SESSION['basket'][$key]['quantity']--;
										header('Location: basket.php');
									}
									if ($_SESSION['basket'][$key]['quantity'] < 1)
										$_SESSION['basket'][$key]['quantity'] = 1;
			?>

								<input class="bascet-button" type='submit' name="<?php echo $key; ?>down" value='-' field='quantity' />
								<input class="bascet-button" type='text' name='<?php echo $key; ?>quantity' value="<?php echo $_SESSION['basket'][$key]['quantity']; ?>" />
								<input class="bascet-button" type='submit' name="<?php echo $key; ?>up" value='+' field='quantity' />
							</form>
						</td>
						<td><?php echo $total_price."$"; ?></td>
						<td>
							<form method='get' action='basket.php'>
								<input class="bascet-button" type='submit' name="<?php echo $key; ?>discard" value='discard' />
							</form>
						</td>
					</tr>
			<?php

					$final_price += $total_price;
				}
			
			?>
					<tr>
						<td></td>
						<td></td>
						<td class="total-price">TOTAL:</td>
						<td class="total-price"><?php echo $final_price."$"; ?></td>
						<td></td>
					</tr>
				</table>

			<?php

				if ($_SESSION['loggued_on_user'] != "") {
					echo '<div class="validate-block"><a href="invoice.php"><button class="validate-button">VALIDATE GOODS</button></a></div>';
					echo '<br/>';
					echo '<br/>';
					echo '<center>After press button "Validate goods", we will send you an email with your invoice.</center>';
					echo '<div class="validate-block"><a class="back-to-main"href="index.php">Back to main</a></div>';
				}
				else {
					echo '<p class="validate-block">Dear customer, please<a class="sign-in-for-validate" href="pages/login.php"> SIGN IN </a> to validate your basket.</p>';
				}

			?>
		</div>
	</body>
</html>