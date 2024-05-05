<?php
	require("utilities/server.php");
	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>
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

	<!-- FIRST SECTION -->
	<div id="about-section-1" class="padding-y-1 padding-x-3">
		<div class="row gx-0">
			<div class="col-lg-6">
				<div class="about-logo py-3">
					<img src="images/what-is-candela.png" id="about-arrow" class="mx-auto d-block">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="about-descriptions font-30 py-3">
					Candela was founded to change the customers' perspective in traditional candles as we put twists of simplicity of candles to fanciness. Transforming simple ones into food scented candles, providing new faces of candles.
				</div>

			</div>
		</div>
		<br><br>
		<div class="row gx-0">
			<div class="col-lg-6">
				<div class="about-descriptions font-30 py-3">
					Our purpose is to relive the elegance of candles by styling it differently from the known. We strive hard to introduce you innovative and satisfying designs.
				</div>
			</div>
			<div class="col-lg-6">
				<div class="about-logo py-3">
					<img src="images/Candelalogo.png" class="mx-auto d-block">
				</div>
			</div>
		</div>
	</div>

	<!-- SECOND SECTION -->
	<div class="row gx-0 text-center padding-x-1 padding-y-2">
		<div class="col-md-12 col-lg-4 font-35">
			<hr>
			<p>Innovative | Creative | Classic</p>
			<img src="images/light-bulb.png" />
			<hr>
		</div>
		<div class="col-md-6 col-lg-4">
			<hr>
			<div class="py-3">
				<p class="font-40">Don't miss to have a Candela candle in your house!</p>
				<a href="product.php" class="Onow">ORDER NOW</a>
			</div>
			<hr>
		</div>
		<div class="col-md-6 col-lg-4">
			<hr>
				<span class="font-60">Always Keep In Touch</span>
					<br><br>
				<a href="contact-us.php" class="Snow" >CONTACT US</a>
					<br><br>
			<hr>
		</div>
	</div>

	<!-- THIRDSECTION -->
	<div id="about-section-3">
		<div id="about-section-3-description">
			<em>Candles</em> can be just candles, but we make a way through innovation to create more creative designs, not forgetting its attraction, luxurious and charm.</div>
	</div>

	<!-- FOURTH SECTION -->
	<div id="about-section-4">
		If you wish to know more about our Service, please read our <a id="myBtn" style="text-decoration: underline;">Terms and Conditions</a>. Thank you.
	</div>
	<div class="text-center">
		<div class="my-4 mx-2 mx-md-5 orange-box">
			<h1 class="fw-bold">Caution</h1>
			<p class="font-20 ">
				Please be aware that this website is a portfolio / personal project only. <br />
				The products displayed here are not for sale. <br />
				For more information, please visit my <a href="https://github.com/lyrick17/candela"><u>Github page</u></a>.
			</p>
		</div>
	</div>
</div>
<!-- FOOTER AND BOTTOM HEADER -->
<?php require("templates/footer.php"); ?>
<?php require("templates/nav_bottom.php"); ?>

<!-- SCRIPTING -->
<script src="resources/js/javas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>