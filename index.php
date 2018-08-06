<?php 

	include('main.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="description" content="Medieval shop">
	<title>Medieval shop</title>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="styles/goods.css">
</head>
<body>

<?php

	include('header.php');

?>

<div class="goods-grid">
	<?php 
	
		foreach($products as $product) {
	
	?>
			<div class="item">
				<div class="item-stats"><h4><?php echo $product['stats'];?></h4></div>
				<img clas="item-img" src="<?php echo $product['img'];?>" alt="item-img">
				<div class="caption">
					<div class="item-price"><h2>&dollar;<?php echo $product['price'];?></h2></div>
					<div class="item-title"><h1><?php echo $product['title'];?></h1></div>
					<div class="item-intro"><h4><?php echo $product['intro'];?></h4></div>
					<div class="item-buttons">
						<a href="basket.php?item=<?php echo $product['id']; ?>"><button class="button-buy-item">BUY</button></a>
						<a href="basket.php?additem=<?php echo $product['id']; ?>"><button class="button-add-to-cart">Add to cart</button></a>
					</div>
				</div>
			</div>

	<?php 

		}

	?>

</div>

<div class="footer">
	<span class="made-by"><span style="color: black">Made by</span> ft_minishop rush duo: </span>
	<span>
		<a target="_blank" href="https://github.com/DmitryZabrotsky">dzabots
			<img class="gh" src="https://image.flaticon.com/icons/svg/25/25231.svg">
		</a>
	</span>
	<span style="color: black">and</span>
	<span>
		<a target="_blank" href="https://github.com/ssupremus">ysushkov
			<img class="gh" src="https://image.flaticon.com/icons/svg/25/25231.svg">
		</a>
	</span>
</div>
</body>
</html>
