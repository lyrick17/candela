<?php include("server.php"); ?>
<!DOCTYPE html><html>
<head><title>Frequently Asked Questions - Candela</title>
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
	<div id="divisions-faq">
		<header id="Header-FAQs">Frequently Asked Questions</header><!-- FAQs Title-->
	<div id="faq-body">
		<hr>
			<div id="faq-questions">
				<div class="faq-subquestions">
					What does Candela offer<b>?</b>
				</div>
					<div class="faq-answers">
						- Candela offers unique style of candles with endearing scent and food designs.
					</div>
				<div class="faq-subquestions">
					How long does it take to deliver the product<b>?</b>
				</div>
					<div class="faq-answers">
						- Your orders are scheduled to deliver every Friday of the week, disregarding the day when you order your items.
					</div>
				<div class="faq-subquestions">
					Could I order here outside Imus City<b>?</b>
				</div>
					<div class="faq-answers">
						- As a starting business, Candela only delivers products around Imus City, Philippines only.
					</div>
				<div class="faq-subquestions">
					Can I order only one product<b>?</b>
				</div>
					<div class="faq-answers">
						- Unfortunately, minimum of P500.00 should be ordered before the check out.
					</div>
				<div class="faq-subquestions">
					Why do my previous orders are gone when I signed-up to have an account<b>?</b>
				</div>
					<div class="faq-answers">
						- It is included in our Terms and Conditions that all orders before registering an account will be lost. We're sorry for your inconvenience.<br>
						Also, orders before logging in will be deleted, provided that you already have an account.
					</div>
				<div class="faq-subquestions">
					What if I don't want to have an account when I want to order<b>?</b>
				</div>
					<div class="faq-answers">
						- You can order and choose Guest Check Out option, providing the Name, Email and Address after reading the Terms and Conditions.
					</div>
				<div class="faq-subquestions">
					Can I cancel the product I've checked out<b>?</b>
				</div>
					<div class="faq-answers">
						- Unfortunately, you have to make sure what details you're entering, for you cannot cancel the order that's been checked out.
					</div>

			</div>
			<div id="faq-sidebar">
				<hr>
					<section id="faq-sidebar-sec1">
						 - - - Satisfied and Ready to Order? - - -<br><br>
					</section>
					<a href="product.php" class="Onow">ORDER NOW</a><br><br>
				<hr>
					<section id="faq-sidebar-sec2">
						Questions Unanswered?
					</section>
				<span>
					Don't hesitate to <a href="contact-us.php">Contact Us</a>.<br> We'll give you assistance.
				</span><br><br>
					<a href="contact-us.php" class="Snow">
						CONTACT US
					</a>
				<br><br><hr>
			</div>
	</div><!-- Questions-->
	</div><!-- Body -->
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