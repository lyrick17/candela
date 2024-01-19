<?php include("server.php"); ?>
<!DOCTYPE html><html>
<head><title>Candela - Indulge the New Faces of Candles</title>
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
			<?php if (isset($_SESSION['username'])) { ?>
				<li><a href="myaccount.php"><?php echo $_SESSION['username'];?>'s Account</a></li>
				<li><a href="logout.php">Log Out</a></li>
			<?php } else { ?>
				<li><a href="login-form.php">Log In</a></li>
				<li><a href="signup-form.php">Create An Account</a></li>
			<?php } ?>
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
		<div class="row padding-x-110">
			<div id="tagline-description" class="col-sm-6">
				<div id="tagline">Indulge in the New Faces of Candles<br /></div>
				<div id="description">Candela provides you new and unique styles of candles with endearming aroma, providing relaxation through its scent.</div>
				<br><br>
				<a href="product.php" class="Onow">ORDER NOW</a>
			</div>
			<div id="product-picture" class="col-sm-6">
				<img src="images/home-ad.png" id="home-candela" alt="Food Candle" width="150%" />
				<br />
			</div>
			<div style="clear: both;"></div>
		</div>
	<div id="featuredItems" class="row">
		<h1>Try Out Our Candles!</h1>
		<?php 
			if ($productresult) {
				if (mysqli_num_rows($productresult) > 0) {
					while ($product = mysqli_fetch_assoc($productresult)) {
		?>
			<div class="col-4 productDisplay">
				<span class="product-pic">
					<a href="<?php echo $product['productpage']; ?>"><img class="product-info-img" src="<?php echo $product['image']; ?>"></a>
				</span>
				<div class="text-center">
				<p class="product-name"><?php echo $product['pname']; ?></p>
					<!--<a href="product1.php" type="submit" class="bam bamColor">Buy Now / Add To Basket</a>-->
				</div>
			</div>
		<?php
					} // end while
				} // end if
			} // end if
		?>

			<div class="moreProduct">
				<a href="product.php">
					I Am Ready To Order >>>
				</a>
			</div>
	</div>

	<?php if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
	?>
	<div style="display: inline-block; width: 100%;">
		<div class="col-sm-6 homeimglogin">
			<img src="images/login.png" height="50%">
		</div>
		<div class="col-sm-6 homelogin">
			<hr style="background-color: blue;">
			<h1>Want to be a Member and Save Your Orders Online?</h1>
			<a href="signup-form.php" class="Onow">Sign Up Now</a><br>
			<span>Already a member? <a href="login-form.php">Log In</a> instead.</span><br>
			We'll be happy to see you join us.
			<hr>
		</div>
	</div>
	<?php
		}
	?>
</div>
<!-- FOOTER -->
<div class="footer">
	&copy; 2018 Candela, All Rights Reserved 
	<span>
		<a href="about.php" class="fnav">About Candela</a> | 
		<a href="contact-us.php" class="fnav">Contact Us</a> |
		<a id="myBtn">Terms and Conditions</a>
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