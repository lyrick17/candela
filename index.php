<?php require("utilities/server.php"); ?>
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
	

	<!-- SECOND CONTENT - Feature the Items -->
	<div id="featuredItems" class="row">
		<h1>Try Out Our Candles!</h1>
			<?php 
			// Display up to 3 Products only
			$product_list = Products::select_all();
			if ($product_list) {
				$i = 0;
				while ($product = mysqli_fetch_assoc($product_list) && $i < 3) {
			?>
					<div class="col-4 productDisplay">
						<span class="product-pic">
							<a href="product.php?id=<?= $product['product_id']; ?>">
								<img class="product-info-img" src="<?= $product['image']; ?>">
							</a>
						</span>
						<div class="text-center">
							<p class="product-name">
								<?= $product['name']; ?>
							</p>
						</div>
					</div>
			<?php
					$i++;
				} // end while
			} else { // if we do not have products saved in database
			?>
				<div class="col-4 productDisplay" style="background-color:#fff;">
					We are sorry for the inconvenience. We do not have available products as of this moment.
				</div>

			<?php
			}	// end else
			?> 
			<div class="moreProduct">
				<a href="product.php">
					I Am Ready To Order >>>
				</a>
			</div>
	</div>


	<!-- THIRD CONTENT - Logging In Part -->
	<?php if (!isset($_SESSION['id'])) { ?>
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
	<?php } ?>
</div>

<!-- FOOTER -->
<?php require("templates/footer.php"); ?>
<!-- SCRIPTING -->
<script src="javas.js"></script>
</body>
</html>