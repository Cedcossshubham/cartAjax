<?php 
    
	session_start();
	
	include "header.php";
	include "footer.php";
	include "config.php";	 
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Products
	</title>
	<link href="style2.css" type="text/css" rel="stylesheet">
</head>
<body>
	<?php echo $header ?>
	<div id="main">	
		<div id="products">
			<?php echo productListing($products,$row) ?>
		</div>
		<div id="cart">
			<?php echo displayProduct($table) ?>
			<span id="subtotal">
				<?php echo "Your Cart Total: ".subTotal($subTotal)?>
			</span>
		</div>
	</div>	
	<?php echo $footer ?>
</body>
</html>

