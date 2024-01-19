<?php include("server.php"); ?>
<!DOCTYPE html><html>
<head><title>About Candela</title>
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
	<nav class="navbar navbar-default">
	<div class="container-fluid">
		<ul class="nav navbar-nav left">
			<li>0971-697-0022</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<?php if (isset($_SESSION['username'])): ?>
				<li><a href="myaccount.php"><?php echo $_SESSION['username'];?>'s Account</a></li>
				<li><a href="logout.php">Log Out</a></li>
			<?php else: ?>
				<li><a href="login-form.php">Log In</a></li>
				<li><a href="signup-form.php">Create An Account</a></li>
			<?php endif ?>
		</ul>
	</div>
</nav>
<div id="header">
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
<div class="body-content">
	<div id="myModal" class="modal">
	<!-- Modal content -->
	 	<div class="modal-content">
			<span class="close">&times;</span>
				<?php echo $termsConditions; ?>
		</div>
	</div>
	<div id="background-about">
		<div>
			<img src="images/what-is-candela.png" id="about-arrow">
				<div id="about-description">
					Candela was founded to change the customers' perspective in traditional candles as we put twists of simplicity of candles to fanciness. Transforming simple ones into food scented candles, providing new faces of candles.
				</div>
		</div><br><br>
		<div id="about-2nd-description">
			Our purpose is to relive the elegance of candles by styling it differently from the known. We strive hard to introduce you innovative and satisfying designs.
		</div>
		<div class="about-logo">
			<img src="images/Candelalogo.png">
		</div>
		<div style="clear: both;"></div>
	</div>
	<div id="about-row" class="row">
		<div class="col-xs-4" style="font-size: 35px;">
			<hr>
			<p>Innovative | Creative | Classic</p>
			<img src="images/light-bulb.png" />
		</div>
		<div class="col-xs-4">
			<p style="padding: 15px 0; font-size: 40px;">Don't miss to have a Candela candle in your house!</p>
			<a href="product.php" class="Onow">ORDER NOW</a>
		</div>
		<div class="col-xs-4"><hr>
			<span style="padding: 15px 0; font-size: 60px;">Always Keep In Touch</span>
				<br><br>
			<a href="contact-us.php" class="Snow" >CONTACT US</a>
				<br><br><hr>
		</div>
	</div>
	<div id="about-group">
		<div id="a-group-description">
			<em>Candles</em> can be just candles, but we make a way through innovation to create more creative designs, not forgetting its attraction, luxurious and charm.</div>
	</div>
	<div id="about-group2">
		If you wish to know more about our Service, please read our <a id="myBtn" style="text-decoration: underline;">Terms and Conditions</a>. Thank you.
	</div>
</div>
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
<!-- SCRIPTING -->
<script src="javas.js"></script>
</body></html>