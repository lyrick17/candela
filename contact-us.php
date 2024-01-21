<?php include("utilities/process_feedback.php"); ?>
<!DOCTYPE html><html>
<head><title>Contact Us - Candela</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script src="jquery-3.3.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" type="image/png" href="images/candelalogo.png">
  	<link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
  	<script src="alertifyjs/alertify.js"></script>
<script>
$(document).ready(function() {
	$("a").on('click', function(event) {
		if (this.hash !== "") {
			event.preventDefault();
			var hash = this.hash;
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 800, function() {
			window.location.hash = hash;
			});
		}
	});
});
</script>
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
	<div id="contactPic">
		<div class="arrowDown">
			<a href="#contact-form" onmouseover="document.images.arrow.src = 'images/arrow-down-white.png'" onmouseout="document.images.arrow.src='images/arrow-down.png'"><img src="images/arrow-down.png" name="arrow" ></a>
		</div>
	</div>
	<div id="contact-form">
		<div style="display: inline-block; padding-right: 10%;">
		<!-- FORM CONTACT-US -->
			<form method="post" action="contact-us.php#contact-form">
			<span class="font-25">Name:</span>
				<span class="contact-required">(required)</span>
					<span style="color: red;">*<?php echo $contact_err['name']; ?></span>
				<br>
					<input type="text" name="uName" class="contact-input" value="<?php if(isset($_SESSION['username'])){
							echo $_SESSION['username'];} else {
							echo $contact['name'];
							} ?>" maxlength="255">
				<br><br>
			<span class="font-25">E-mail:</span>
				<span class="contact-required">(required)</span>
					<span style="color: red;">*<?php echo $contact_err['email']; ?></span>
				<br>	
					<input type="text" name="email" class="contact-input" value="<?php if(isset($_SESSION['email'])){
							echo $_SESSION['email'];} else {
							echo $contact['email'];
							} ?>" maxlength="100">
				<br><br>
			<span class="font-25">Contact Number:</span>
				<span class="contact-required">(optional)</span>
					<span style="color: red;"><?php echo $contact_err['contact']; ?></span>
				<br>
					<input type="text" name="contactnum" class="contact-input" value="<?php if(isset($_SESSION['contactnumber'])){
							echo $_SESSION['contactnumber'];} else {
							echo $contact['contact'];
							} ?>" maxlength="11" />
				<br><br>
			
			<span class="font-25">Subject:</span>
				<span class="contact-required">(required)</span>
					<span style="color: red;">*<?php echo $contact_err['subject']; ?></span>
				<br>
					<input type="text" name="subject" class="contact-input" value="<?php echo $contact['subject']; ?>" maxlength="255" />
				<br><br>

			<span class="font-25">Comment:</span>
				<span class="contact-required">(required)</span>
					<span style="color: red;">*<?php echo $contact_err['comment']; ?></span>
				<br>	
					<textarea maxlength="2000" name="comment"><?php echo $contact['comment']; ?></textarea>
				<br><br>
			
			<input type="submit" name="submit" value="Submit Now" class="Snow" />

			</form><!-- END OF FORMS-->

		</div>
		<div id="contact-sidebar">
			<div id="csidebar-1">
				<hr>
				<h2>- Ask Us -</h2>
				<p>If you still have questions unanswered, we would like to hear it from you. We want you to keep in touch in us.</p>
				<hr>
				<h2>- Give A Feedback -</h2>
				<p>Any feedback we receive is highly appreciated. We would love to hear it from you!</p>
				<hr>
			</div>
			<div id="csidebar-2">
				<span class="more-info">Call or Text us at:</span><br>
				<i>0971-697-0022</i><br><br>
				<span class="more-info">E-mail us at:</span><br>
				candela.foodcandle@gmail.com
			</div>
		</div>
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