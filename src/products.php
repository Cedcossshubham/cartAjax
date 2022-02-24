<?php 
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
			<!-- cart table -->
			<span id="subtotal">
			<!-- subtotal -->
			</span>
		</div>
	</div>	
	<?php echo $footer ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src='ajax.js'></script>
</body>
</html>

