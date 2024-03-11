<?php
	require("utilities/server.php");
	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Candela - Indulge the New Faces of Candles</title>
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


	<!-- FIRST CONTENT - Front Page Design -->
	<div id="welcome-page" class="row g-0 padding-y-1 padding-x-3">
		
		<!-- 1. The Usual Front-Page Design -->
		<!-- 2. New User, no order Design -->
		<!-- 3. Basket filled, not ordered yet -->
		<!-- 4. Order processing design -->
		<!-- 5. User has History of Orders online -->

		<?php if (!isset($_SESSION['id'])): ?>
			<div id="tagline-description" class="col-md-6 order-2 text-center">
				<div id="tagline" class="font-30">Indulge in the New Faces of Candles<br /></div>
				<div id="description" class="font-20">Candela provides you new and unique styles of candles with endearming aroma, providing relaxation through its scent.</div>
				<a href="product.php" class="Onow">ORDER NOW</a>
			</div>
		<?php else: ?>
			<div id="tagline-description" class="col-md-6 order-2 text-center">
				<div id="tagline" class="font-30">Do Not Miss out Candela's Aroma<br /></div>
				<div id="description" class="font-20">Fill your home with a beautiful scent of Candela's Aroma. We offer the best candles with eye-catching food designs.</div>
				<a href="product.php" class="Onow">GRAB YOURS NOW</a>
			</div>
		<?php endif; ?>

		<div id="product-picture" class="col-md-6 order-1 text-center">
			<img src="images/home-ad.png" id="home-candela" alt="5 New Food Candles! Free Shipping for Every P2,000 Orders!" />
			<br />
		</div>



	</div>
	

	<!-- SECOND CONTENT - Feature the Items -->
	<div id="featured-items" class="row gx-0">

		<h1>Try Out Our Candles!</h1>

			<?php 
			// Display up to 3 Products only
			$product_list = Products::select_three();
			if ($product_list):
				while ($product = mysqli_fetch_assoc($product_list)):
			?>
					<div class="col-lg-4">
						<div class="display-product">
							<span class="product-pic">
								<a href="product.php?id=<?= $product['product_id']; ?>">
									<img src="<?= $product['image']; ?>">
								</a>
							</span>
							<div class="text-center">
								<p class="font-20 pt-3 fw-bold">
									<?= $product['name']; ?>
								</p>
							</div>
						</div>
					</div>
			<?php endwhile; ?>
			<?php else: // if we do not have products saved in database  yet, display this message ?>

				<div class="col-12 display-product" style="background-color:#fff;">
					We are sorry for the inconvenience. We do not have available products as of this moment.
				</div>

			<?php endif; ?> 
			
			<div class="candela-btn-2">
				<a href="product.php">
					I Am Ready To Order >>>
				</a>
			</div>
	</div>


	<!-- THIRD CONTENT - Logging In Part -->
	<?php if (!isset($_SESSION['id'])): ?>
		<div id="login-now" class="padding-x-2 padding-y-2"> 
			<div class="row gx-0">
				<div class="col-lg-6 order-2 order-lg-1 login-promotion font-30">
					<hr>
					<h1>Want to be a Member and Save Your Orders Online?</h1>
					<a href="signup-form.php" class="Onow">Sign Up Now</a><br>
					<span>Already a member? <a href="login-form.php">Log In</a> instead.</span><br>
					We'll be happy to see you join us.
					<hr>
				</div>
				<div class="col-lg-6 order-1 order-lg-2 login-picture">
					<img src="images/login.png">
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>

<!-- FOOTER AND BOTTOM HEADER -->
<?php require("templates/footer.php"); ?>
<?php require("templates/nav_bottom.php"); ?>

<!-- SCRIPTING -->
<script src="resources/js/javas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>