<?php include('utilities/process_userconn.php'); ?>
<!DOCTYPE html><html>
<head><title>Log in at Candela</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" type="image/png" href="images/candelalogo.png">
</head>
<body>
<!-- HEADER/NAVIGATION BAR -->
<div id="header" class="sticky">
	<div id="business-name">
		<a href="index.php"><img src="images/candela.png" alt="Candela" /></a>
	</div>

	<div class="navig-prov">
		<div class="navi">
			<a href="product.php">Product</a>
		</div>
		<div class="navi">
			<a href="faqs.php">FAQs</a>
		</div>
		<div class="navi">
			<a href="about.php">About</a>
		</div>
		<div class="navi">				
			<a href="contact-us.php">Contact Us</a>
		</div>
	</div>

	<div id="nav-basket">
		<a href="basket.php" onmouseover="document.images.basketimg.src = 'images/basket-hover.png'" onmouseout="document.images.basketimg.src='images/basket.png'"><img src="images/basket.png" name="basketimg" height="17px"> Basket</a>
	</div>
</div>
<!-- CONTENT -->
<div id="formbg">
		<div class="text-center">
			<div id="signUpForm">
				<p id="create-account-header">Log In to Candela</p>
				<form method="post" action="login-form.php" id="formstyle">
					<p style="color: red;">
						<?php echo $inputErr; ?>
					</p>
					<input type="hidden" name="type" value="login" />

						<label>Email:</label>
						<br>
						<?php 
							if (!isset($_SESSION['id'])) {
						?>
							<input type="text" name="loginName" placeholder="Enter Email" class="width-600" value="<?php echo $username; ?>" />
						<?php
							}
						?>
						<br>
						<br>

						<label>Password:</label><br>
						<?php 
							if (!isset($_SESSION['id'])) {
						?>
							<input type="password" name="loginPass" placeholder="Enter Password" class="width-600" />
						<?php
							}
						?>
						<br>
						<br>
						<?php
							if (!isset($_SESSION['id'])) {
						?>
							<input type="submit" name="login_submit" value="Log In" class="width-600" id="registerButton" />
						<?php
							}
						?>
				</form>

				<div id="formfooter">
						First time in Candela? <a href="signup-form.php"><u>Register</u></a> now.
					</div>
			</div>
		</div><!-- signUpForm -->
</div><!--Background Image-->

<!-- FOOTER -->
<div class="footer">
	&copy; 2018 Candela, All Rights Reserved 
	<span>
		<a href="about.php" class="fnav">About Candela</a> | 
		<a href="contact-us.php" class="fnav">Contact Us</a>
	</span><br />
		
	Bricklane Fake Subdivision Medicion II-E Block 90 Lot 1 Imus City, Cavite
		&nbsp;&nbsp;:&nbsp;&nbsp; <i>0971-697-0022</i>
	<span>
		<i>Exclusively available at Imus City Only</i>&nbsp;&nbsp;&nbsp;
		<a href="https://www.instagram.com/"><img src="images/instagramlogo.png" class="fsocial-acc"></a>&nbsp;&nbsp;&nbsp;
		<a href="https://twitter.com/"><img src="images/twitter-logo.png" class="fsocial-acc"></a>&nbsp;&nbsp;&nbsp;
		<a href="https://www.facebook.com/"><img src="images/facebooklogo.png" class="fsocial-acc"></a>&nbsp;&nbsp;&nbsp;
	</span>
</div>
</body></html>