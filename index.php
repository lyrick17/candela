<?php
	require("utilities/server.php");
	require("utilities/process_basket_updates.php");
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

		<?php if (isset($_SESSION['id'])):
				$orders = Orders::get_all_orders($_SESSION['id']);
				if ($orders && mysqli_num_rows($orders) > 0):
		?>
					<div id="tagline-description" class="col-lg-9 text-center">
						<div id="tagline" class="font-30 m-2">My Orders<br /></div>
						<div id="order-buttons">
							<?php if (isset($_GET['orders'])): ?>
							<?php 	if ($_GET['orders'] == 2): ?>
										<a href="index.php?orders=1" class="order-buttons">Recent Orders</a>
										<a href="index.php?orders=2" class="order-buttons active">To Receive</a>
										<a href="index.php?orders=3" class="order-buttons">Delivered</a>
							<?php	elseif ($_GET['orders'] == 3): ?>
										<a href="index.php?orders=1" class="order-buttons">Recent Orders</a>
										<a href="index.php?orders=2" class="order-buttons">To Receive</a>
										<a href="index.php?orders=3" class="order-buttons active">Delivered</a>
							<?php	else: ?>
										<a href="index.php?orders=1" class="order-buttons active">Recent Orders</a>
										<a href="index.php?orders=2" class="order-buttons">To Receive</a>
										<a href="index.php?orders=3" class="order-buttons">Delivered</a>
							<?php 	endif; ?>
							<?php else: ?>
									<a href="index.php?orders=1" class="order-buttons active">Recent Orders</a>
									<a href="index.php?orders=2" class="order-buttons">To Receive</a>
									<a href="index.php?orders=3" class="order-buttons">Delivered</a>
							<?php endif; ?>
						</div>
		<?php		
					// $_GET['orders'] = 1 -> recent orders
					// $_GET['orders'] = 2 -> to receive
					// $_GET['orders'] = 3 -> delivered
					// $_GET['orders'] = any -> recent orders
					$displayed_orders = 0;
					while($order = mysqli_fetch_array($orders, MYSQLI_ASSOC)):
						$timestamp = strtotime($order['checked_out']);
						$items = json_decode($order['products'], true);
						$items = array_filter($items);
						if (isset($_GET['orders'])) {
							if ($_GET['orders'] == 2) {
								// If the order is not "Product Prepared" or "Out for Delivery", skip to the next iteration
								if ($order['delivered'] != "Product Prepared" && $order['delivered'] != "Out for Delivery") {
									continue;
								}
							} elseif ($_GET['orders'] == 3) {
								// If the order is not "Delivered", skip to the next iteration
								if ($order['delivered'] != "Delivered") {
									continue;
								}
							} else {
								// If the order is not "Order Placed", skip to the next iteration
								if ($order['delivered'] != "Order Placed") {
									continue;
								}
							}
						} else {
							// If the order is not "Order Placed", skip to the next iteration
							if ($order['delivered'] != "Order Placed") {
								continue;
							}
						}
						$displayed_orders++;
		?>
			<!-- user is logged in, and has recent orders -->
							<div class="paginate">
							<hr />
								<div class="row gx-0">
									<div class="col-6 text-start py-1"><b>Order Number:</b> <i><?= $order['order_id']; ?></i></div>
									<div class="col-6 text-end py-1"><b>Status:</b> <span class="order-status"><?= $order['delivered']; ?></span></div>
								</div>
								<div class="row gx-0">
									<div class="col-6 text-start py-1"><b>Order Date:</b> <i><?= date('m/d/Y H:i:s', $timestamp); ?> , <?= date('l', $timestamp); ?></i></div>
									<div class="col-6 text-end py-1"><b>Total:</b> <span class="order-status">P<?= $order['total']; ?></span></div>
								</div>
								<div class="items">
								<?php 
									foreach ($items as $product_id => $quantity):
										$product = Products::get_product_info($product_id);
										if (!$product) continue; // suppressing the error, must be revised
										$product = mysqli_fetch_array($product, MYSQLI_ASSOC);
										$product_total = $product['price'] * $quantity;
								?>
										<div class="row gx-0">
											<div class="col"><img src="<?= $product['image'];?>" class="recent-order-img"/></div>
											<div class="col text-start">
												<b class="font-20"><?= $product['name']; ?></b><br />
												P<?= $product['price']; ?><br />
												Quantity: <?= $quantity; ?>
											</div>
											<div class="col font-20">
												Total Amount:<br />
												P<?= $product_total ?>
											</div>
										</div>
										<hr>
								<?php endforeach; ?>
								</div> <!-- end of product row items -->
							</div> <!-- end of paginate -->
		<?php 		endwhile; ?>
		<?php 		if ($displayed_orders == 0): ?>
						<hr />

						<?php  
							$no_order_message = "";
							if (isset($_GET['orders'])) {
								if ($_GET['orders'] == 2)
									$no_order_message = "No orders are being processed.";
								elseif ($_GET['orders'] == 3)
									$no_order_message = "No orders have been delivered yet.";
								else
									$no_order_message = "You have no recent orders to display";
							} else {
								$no_order_message = "You have no recent orders to display";
							}	
							echo $no_order_message;
						?>
						<br />
						<br />
						<a href="product.php" class="Onow">ORDER NOW</a>
		<?php 		else: ?>
						<div class="d-flex justify-content-center">
							<div id="page-nav-content">
								<div id="page-nav"></div>
							</div>
						</div>
		<?php 		endif; ?>
					</div> <!-- end of tagline-description -->
					
					<!-- SIDEBAR -->
					<div id="product-picture" class="col-lg-3 text-center sidebar-box-1">
						<div id="basket-sidebar">
							<hr>
							
							<h3><b><a href="basket.php">Your Basket</a></b></h3><hr>
							
							<?php 
								if (empty($_SESSION['basket'])) {
									require("templates/basket/empty_basket.php");
							?>
									<a href="product.php" class="basket_buttons">Shop Now</a>
							<?php
								} else {
									// Display the side basket
									$remove_item = true;
									require("templates/basket/side_basket.php");
									// Display the necessary buttons
							?>
									<div class="text-center">
										<span>
											<form method="post" action="index.php">
												<input type="submit" name="clear_basket" value="Clear Basket" class="basket_buttons" />
												<a href="checkout.php" class="basket_buttons" name="checkout">Checkout</a>
											</form>
										</span>
									</div>
									
							<?php		
								} // endelse
							?>
						</div>
						<hr />
						<h5>Manage your information.</h5>
						
						<!-- MY ACCOUNT LINK -->
						<div class="myacc-sidebar">
							<?php if (isset($_SESSION['id'])) : ?>
								<a href="myaccount.php" class="myaccount-button">My Account</a>
							<?php endif; ?>
						</div>
					</div>



		<?php 	else: ?>
			<!-- user is logged in, and has no pending orders -->
			<div id="tagline-description" class="col-md-6 order-2 text-center">
				<div id="tagline" class="font-30">Do Not Miss out Candela's Aroma<br /></div>
				<div id="description" class="font-20">Fill your home with a beautiful scent of Candela's Aroma. We offer the best candles with eye-catching food designs.</div>
				<a href="product.php" class="Onow">GRAB YOURS NOW</a>
			</div>
			<div id="product-picture" class="col-md-6 order-1 text-center">
				<img src="images/home-ad.png" id="home-candela" alt="5 New Food Candles! Free Shipping for Every P2,000 Orders!" />
				<br />
			</div>
		<?php 	endif; ?>
		<?php else: ?>
		<!-- user is not logged in -->
			<div id="tagline-description" class="col-md-6 order-2 text-center">
				<div id="tagline" class="font-30">Indulge in the New Faces of Candles<br /></div>
				<div id="description" class="font-20">Candela provides you new and unique styles of candles with endearming aroma, providing relaxation through its scent.</div>
				<a href="product.php" class="Onow">ORDER NOW</a>
			</div>
			<div id="product-picture" class="col-md-6 order-1 text-center">
				<img src="images/home-ad.png" id="home-candela" alt="5 New Food Candles! Free Shipping for Every P2,000 Orders!" />
				<br />
			</div>
		<?php endif; ?>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/jquery.simplePagination.min.js" integrity="sha512-J4OD+6Nca5l8HwpKlxiZZ5iF79e9sgRGSf0GxLsL1W55HHdg48AEiKCXqvQCNtA1NOMOVrw15DXnVuPpBm2mPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="resources/js/checkout_history.js"></script>
</body>
</html>