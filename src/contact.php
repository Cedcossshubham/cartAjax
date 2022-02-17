<?php include "header.php";
	  include "footer.php";
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Contact
	</title>
	<link href="style2.css" type="text/css" rel="stylesheet">
</head>
<body>
	<?php echo $header; ?>
	<div id="main">
		<div id="contact-form">
			<form action="" method="">
				<label for="name">Name:</label>
				<input type="text" name="name" class="form-control">
				<label for="email">Email:</label>
				<input type="text" name="email" class="form-control">
				<label for="message">Message:</label>
				<textarea name="message" cols="45" rows="6" class="form-control"></textarea>
				<p class="submit">
					<input type="submit" name="submit" value="Submit">
				</p>
			</form>
		</div>
		
	</div>
	<?php echo $footer; ?>
</body>
</html>