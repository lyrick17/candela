<?php require("utilities/server.php"); ?>
<?php Restrict::remove_checkout_sess(); ?>
<?php Restrict::remove_order_id_sess(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>About Candela</title>
	<?php require("templates/head.php"); ?>
</head>
<body>
<!-- HEADER/NAVIGATION BAR -->
<?php require("templates/nav_graybar.php"); ?>
<?php require("templates/nav.php"); ?>

<!-- CONTENT -->
<div class="body-content">
	<!-- MODAL CONTENT for Terms and Conditions -->
	<?php include("templates/modals/modal_terms_conditions.php"); ?>

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
<?php require("templates/footer.php"); ?>

<!-- SCRIPTING -->
<script src="javas.js"></script>
</body>
</html>