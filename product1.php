<?php include("server.php"); ?>
<!DOCTYPE html><html>
<head><title>Candela</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link rel="icon" type="image/png" href="images/candelalogo.png">
  	<link rel="stylesheet" type="text/css" href="style.css">
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
	<div class="margin-t-40">
		<div id="product-page">
			<div id="product-nav">
				<a href="product.php"><< Back To Products</a>
			</div>
			<div class="product-info">
				<?php 
				 $prow = mysqli_fetch_array($p1result);	
				?>
				<form method="post" action="product1.php?action=add&id=<?php echo $prow['id'] ?>">
					<img class="product-info-img img-responsive" name="p_pic" src="<?php echo $prow['image'] ?>">
				<div class="subproduct-info">
					<blockquote>
						<span class="product-header"><p><?php echo $prow['pname'] ?></p></span><br>
							<span class="price"><p>P<?php echo $prow['price'] ?></p></span>	
								<p>Quantity<br>
								<input type="number" name="quantity" class="product-quantity" id="product-quantity" max="<?php echo $prow['stocks']; ?>" min="1" value="1" width="20px" />
									<span class="font13em" id="quant_num">
										*quantity needed
									</span>
								</p>
								<!--<p>Total: ( Price times Quantity )</p>--><br>
								<p>
									<input type="hidden" name="hidden_name" value="<?php echo $prow['pname']; ?>">
									<input type="hidden" name="hidden_price" value="<?php echo $prow['price']; ?>">
									<input type="hidden" name="hidden_image" value="<?php echo $prow['image'] ?>">
									<input type="submit" name="add_to_basket" value="Add To Basket" class="bam bamColor" <?php if ($prow['stocks'] == 0) { ?> disabled <?php }?> />
									<script>
										if (<?php echo $prow['stocks']; ?> <= 15) {
											document.write("<br><span style='font-size:18px; font-style:italic;'>");
											document.write("<?php echo $prow['stocks']; ?> stock/s left");
											document.write("</span>");
										}
									</script>
								</p>
					</blockquote>
				</div>
				<div class="item-description">
					<?php echo $prow['description']; ?>
				</div>
				<div style="text-align: center;">
					<a href="product.php" class="basket_buttons" style="font-size: 26px;"><< Keep Shopping</a>
				</div>
				</form>
			</div>
		</div><!-- END OF PRODUCT PAGE ID -->
	</div>
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