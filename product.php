<?php 
	require('utilities/server.php');
	require("utilities/process_basket_updates.php");
	if (isset($_GET['id']))
		Restrict::product_page_access($_GET['id'], 0);
	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Products - Candela</title>
	<?php require("templates/head.php"); ?>
</head>

<body>
<!-- HEADER/NAVIGATION BAR -->
<?php require("templates/nav_graybar.php"); ?>
<?php require("templates/nav.php"); ?>

<!-- BODY CONTENT -->
<div class="body-content">

	<!-- MODAL CONTENT for Terms and Conditions -->
	<?php include("templates/modals/modal_terms_conditions.php"); ?>
	
	<!-- TWO BODY SECTIONS -->
	<!-- 1. LIST OF ALL PRODUCTS -->
	<!-- 2. SPECIFIC PRODUCT PAGE WITH PRODUCT INFORMATION -->
	<?php if (!isset($_GET['id'])) { ?>

	<!-- BODY 1. LIST OF ALL PRODUCTS -->
	<div class="padding-y-1 padding-x-3">

		<header id="product-header" class="font-35 fw-bold">
			Food Scented Candles
		<hr><hr>
		</header>
		<div class="px-3 py-1">
			<form action="product.php" method="get" id="search-product">
				<input type="text" class="search-text-width py-1 my-1" placeholder="Search a Product..." name="search" maxlength="255">
				<input type="submit" value="Search" class="btn btn-success my-1">
				<a href="product.php" class="btn btn-danger my-1">Clear Search</a>
				<?php if (isset($_GET['search'])): ?>
				<div class="text-start font-20">
					Search Results for: <span class="font-25"><?= $_GET['search']; ?></span>
				</div>
			<?php endif; ?>
			</form>
		</div>
		<!-- LIST OF PRODUCTS -->
		<div id="products" class="text-center">

			<div id="goto-basket-btn" class="py-2">
				<hr />
				<a href="basket.php" class="basket_buttons">Go to My Basket</a>
				<hr />
			</div>
			<div class="row gx-0">
				<?php
					if (isset($_GET['search'])) {
						$product_list = Products::select_search($_GET['search'], 0);
					} else {
						$product_list = Products::select_all(0);
					}
					if ($product_list):
						while ($product = mysqli_fetch_array($product_list, MYSQLI_ASSOC)):
				?>
						<div class="col-md-6 paginate">
							<div class="items">
								<form method="post" action="product.php">
									<span class="product-pic">
										<a name="productpage" href="product.php?id=<?= $product['product_id']; ?>">
											<!-- ITEM PICTURE -->
											<img name="p_pic" src="<?= $product['image']; ?>" alt="Product"  />
										</a>
									</span>
									<div class="text-center">
										<!-- ITEM INFORMATION -->
										<p class="font-20 pt-3"><?= $product['name']; ?></p>
											<p>
												<span>Price:</span> P<?= $product['price']; ?><br>
												<input type="number" name="quantity" class="product-quantity" id="product-quantity" max="<?= $product['stocks']; ?>" min="1" value="1" />
												<span class="font-13 fst-italic" id="quant_num">
													*quantity needed
												</span>
												<br>
											</p>
											<input type="hidden" name="product_id" value="<?= $product['product_id']; ?>" />
											<input type="submit" name="add_to_basket" value="Add To Basket" class="item-links" <?php if ($product['stocks'] == 0) { ?> disabled <?php } ?> />
									</div>				
								</form>
								<!-- Link For Item Description-->
								<div>
									<a href="product.php?id=<?= $product['product_id']; ?>" class="item-links">More Info</a>
										
									<span class="font-16 fst-italic">
										<?php Formats::display_stocks_left($product['stocks']); ?>
									</span>
								</div>
							</div>
						</div>
				<?php endwhile; ?>
					<div class="d-flex justify-content-center py-2">
						<div id="page-nav-content">
							<div id="page-nav"></div>
						</div>
					</div>
				<?php else: ?>
						<div class="text-center">
							<p class="font-25">No products available.</p>
							<p class="font-20">Candela is working on providing the best services.</p>
						</div>
				<?php endif; ?>
			</div>
		</div>
	
		<!-- SIDEBAR -->
		<div id="prod-sidebar" class="mt-4">
			<div id="basket-sidebar">
				<hr>
				
				<h4><a href="basket.php">Your Basket</a></h4><hr>
				
				<?php 
					if (empty($_SESSION['basket'])) {
						require("templates/basket/empty_basket.php");
					} else {
						// Display the side basket
						$remove_item = true;
						require("templates/basket/side_basket.php");
						// Display the necessary buttons
				?>
						<div class="text-center">
							<span>
								<form method="post" action="product.php">
									<input type="submit" name="clear_basket" value="Clear Basket" class="basket_buttons" />
									<a href="checkout.php" class="basket_buttons" name="checkout">Checkout >></a>
								</form>
							</span>
						</div>
						
				<?php		
					} // endelse
				?>

			<!-- MY ACCOUNT LINK -->
			<div class="myacc-sidebar">
				<?php if (isset($_SESSION['id'])) : ?>
					<a href="myaccount.php" class="myaccount-button">My Account</a>
				<?php endif; ?>
			</div>

			<!-- CONTACT FORM ADVERTISEMENT -->
			<div id="psidebar" class="sidebar-box-1 p-3 text-center">
				<hr>
					<section class="font-16 fw-bold">
						- - - Insquisitions? - - -<br><br>
					</section>
					Don't hesitate to <a href="contact-us.php">Contact Us</a>.<br> We'll give you assistance.<br>
				<hr>
					<section class="font-16 fw-bold">
						Don't forget to give us
					</section>
					<span class="font-25 fw-bold">Feedbacks!</span><br>
					We will lovely receive your feedbacks<br> about our service.
				<br><br>
					<a href="contact-us.php" class="Snow">CONTACT US</a>
				<br><br><hr>
			</div>
			
			<!-- REMINDER BOX -->
			<div id="reminder-box" class="font-15 p-2">
				<h4 class="fw-bold color-2-green">Reminder:</h4>
				Please keep in mind that once you will check out your orders without an account and decided to create one instead, all previous orders will be deleted, as it will create new set of orders for a user with a registered account. <br>
				We thank you for your cooperation, and we're sorry for the inconvenience.<br>
				<i>Enjoy Candela!</i>
			</div>
		</div>
		<!-- END OF SIDEBAR -->



	</div>
	<!-- END OF BODY 1. -->


	<!-- BODY 2. SPECIFIC PRODUCT PAGE WITH PRODUCT INFORMATION -->
	<?php } else { // end of if (!isset($_GET['id'])) 
	 		    $product_info = Products::get_product_info_hide($_GET['id'], 0); 
	?>
		<div class="padding-y-1 padding-x-3">
			<div>

				<div id="product-nav">
					<a href="product.php"><< Back To Products</a>
				</div>

				<div class="">
					<?php $product = mysqli_fetch_array($product_info, MYSQLI_ASSOC); ?>

					<form method="post" action="product.php?id=<?= $product['product_id'] ?>">
						<div class="row gx-0 py-3">
							<!-- ITEM PICTURE -->
							<div class="col-sm-5 text-center">
								<img class="product-200"  name="p_pic" src="<?= $product['image'] ?>">
							</div>
							<!-- ITEM MAIN INFORMATION-->
							<div class="col-sm-7 item-main-info">
								<blockquote>
									<span class="product-header"><p><?= $product['name'] ?></p></span><br>
										<span class="f-20"><p>P<?= $product['price'] ?></p></span>	
										<p>Quantity<br>
										<input type="hidden" name="product_id" value="<?= $product['product_id']; ?>" />
										<input type="number" name="quantity" class="product-quantity" id="product-quantity" max="<?= $product['stocks']; ?>" min="1" value="1" width="20px" />
											<span class="font-13 fst-italic" id="quant_num">
												*quantity needed
											</span>
										</p>
										<p>
											<input type="submit" name="add_to_basket" value="Add To Basket" class="bam bamColor" <?php if ($product['stocks'] == 0) { ?> disabled <?php }?> />
											<span class="font-16 fst-italic">
												<?php Formats::display_stocks_left($product['stocks']); ?>
											</span>
										</p>
								</blockquote>
							</div>
						</div>
						
					</form>
						<!-- ITEM DISCRIPTION -->
						<div class="item-description sidebar-box-1 font-20">
							<?= $product['description']; ?>
						</div>

					<div class="text-center font-25">
						<a href="product.php" class="basket_buttons"><< Keep Shopping</a>
					</div>
				</div>
			</div><!-- END OF PRODUCT PAGE ID -->
		</div>
	<?php } ?>
	<!-- END OF BODY 2. -->

</div>
<!-- END OF BODY-CONTENT -->

<!-- FOOTER AND BOTTOM HEADER -->
<?php require("templates/footer.php"); ?>
<?php require("templates/nav_bottom.php"); ?>

<!-- SCRIPTING -->		
<script src="resources/js/javas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/jquery.simplePagination.min.js" integrity="sha512-J4OD+6Nca5l8HwpKlxiZZ5iF79e9sgRGSf0GxLsL1W55HHdg48AEiKCXqvQCNtA1NOMOVrw15DXnVuPpBm2mPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="resources/js/product_pagination_2.js"></script>
</body>
</html>