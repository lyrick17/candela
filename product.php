<?php require("utilities/server.php"); ?>
<?php require("utilities/process_basket_updates.php"); ?>
<?php 

	if (isset($_GET['id']))
		Restrict::product_page_access($_GET['id']);

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
	<div class="padding-x-110">



		<header id="product-header">
			Food Scented Candles
		<hr><hr>
		</header>



		<!-- LIST OF PRODUCTS -->
		<div id="products">
			<div class="row" style="text-align: center;">

				<?php 
					$product_list = Products::select_all();
					if ($product_list) {
						while ($product = mysqli_fetch_array($product_list, MYSQLI_ASSOC)) {
				?>

						<div class="col-6 items">
							<form method="post" action="product.php">
								<span class="product-pic">
									<a name="productpage" href="product.php?id=<?= $product['product_id']; ?>">
										<!-- ITEM PICTURE -->
										<img name="p_pic" src="<?= $product['image']; ?>" alt="Product" class="img-responsive" />
									</a>
								</span>
								<div class="text-center">
									<!-- ITEM INFORMATION -->
									<p class="product-name"><?= $product['name']; ?></p>
										<p>
											<span>Price:</span> P<?= $product['price']; ?><br>
											<input type="number" name="quantity" class="product-quantity" id="product-quantity" max="<?= $product['stocks']; ?>" min="1" value="1" />
											<span class="font13em" id="quant_num">
												*quantity needed
											</span>
											<br>
										</p>
										<input type="hidden" name="product_id" value="<?= $product['product_id']; ?>" />
										<input type="submit" name="add_to_basket" value="Add To Basket" class="bam bamColor" <?php if ($product['stocks'] == 0) { ?> disabled <?php }?> />
								</div>				
							</form>
								<!-- Link For Item Description-->
								<div style="padding-top: 10px;">
								<a href="product.php?id=<?= $product['product_id']; ?>" class="bam bamColor">More Info</a>
									
								<span style='font-size:18px; font-style:italic;'>
									<?php Formats::display_stocks_left($product['stocks']); ?>
								</span>
								</div>
						</div>

				<?php 
						} //end while
					} //end if
				?>
			</div>
		</div>
		


		<!-- SIDEBAR -->
		<div id="prod-sidebar">
			<div id="basket-sidebar">
				<hr>
				<h4><a href="basket.php">Your Basket</a></h4><hr style="margin: 0;">
				
				<?php 
					if (empty($_SESSION['basket'])) {
				?>
						<!-- If there is no order. -->
						<div style="text-align: center;margin-top: 15px;">
							<p>Your Basket Is Empty.</p>
						</div>
				<?php
					} else {
				?>

						<!-- If there is order -->
						<table style="width: 100%; margin: 10px 0;">
						
				<?php

						// includes the updating of basket_information
						require("utilities/process_basket_sync.php");

						foreach ($_SESSION['basket'] as $product_id => $quantity) {
							$get_products = Products::get_product_info($product_id);
							if ($get_products) {
								$product = mysqli_fetch_array($get_products, MYSQLI_ASSOC);
				?>
							<tr>
								<td class="pbasket-td pb_item"><?= $product['name']; ?></td>
								<td class="pbasket-td pb_num"><?= $quantity; ?></td>
								<td class="pbasket-td pb_num">P<?= number_format($quantity * $product['price'], 2); ?></td>
								<form method="post" action="product.php">
									<td class="pbasket-td pb_ri">
										<input type="hidden" name="product_id" value="<?= $product_id ?>" />
										<button type="submit" name="remove_item" style="color:red; font-size: 70%; background-color: #fff; border: none;">
											Remove Item
										</button>
									</td>
								</form>
							</tr>
				<?php
							} // end of if
						}	// end of foreach
				?>
					
							<tr>
								<td colspan="2" align="right" class="pbasket-td pb_total">Total</td>
								<td class="pbasket-td pb_num">P<?= number_format($_SESSION['total'], 2); ?></td>
							</tr>
						</table>
						<div class="text-center">
							<span style="text-align: center;">
								<form method="post" action="product.php">
									<input type="submit" name="clear_basket" value="Clear Basket" class="basket_buttons" />
									<a href="checkout.php" class="basket_buttons" name="checkout">Checkout >></a>
								</form>
							</span>
						</div>
						
				<?php		
					} // end else
				?>

			<!-- MY ACCOUNT LINK -->
			<div class="myacc-sidebar">
				<?php 
					if (isset($_SESSION['id'])) {
				?>
						<a href="myaccount.php" class="myacc-class">My Account</a>
				<?php
					}
				?>
			</div>

			<!-- CONTACT FORM ADVERTISEMENT -->
			<div id="psidebar">
			<hr>
				<section class="prod-sidebar-sec1">
					 - - - Insquisitions? - - -<br><br>
				</section>
				<center>Don't hesitate to <a href="contact-us.php">Contact Us</a>.<br> We'll give you assistance.<br>
			<hr>
				<section class="prod-sidebar-sec1">
					<center>Don't forget to give us</center>
				</section>
				<span id="prod-sidebar-span1">Feedbacks!</span><br>
				We will lovely receive your feedbacks<br> about our service.
				<br><br>
					<a href="contact-us.php" class="Snow" >CONTACT US</a>
				<br><br><hr>
			</div>
			<!-- REMINDER BOX -->
				<div id="reminder-box">
					<h4>Reminder:</h4>
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
	 		    $product_info = Products::get_product_info($_GET['id']); 
	?>
		<div class="margin-t-40">
			<div id="product-page">

				<div id="product-nav">
					<a href="product.php"><< Back To Products</a>
				</div>

				<div class="product-info">
					<?php $product = mysqli_fetch_array($product_info, MYSQLI_ASSOC); ?>

					<form method="post" action="product.php?id=<?= $product['product_id'] ?>">
						<!-- ITEM PICTURE -->
						<img class="product-info-img img-responsive" name="p_pic" src="<?= $product['image'] ?>">
						
						<!-- ITEM INFORMATION-->
						<div class="subproduct-info">
							<blockquote>
								<span class="product-header"><p><?= $product['name'] ?></p></span><br>
									<span class="price"><p>P<?= $product['price'] ?></p></span>	
									<p>Quantity<br>
									<input type="hidden" name="product_id" value="<?= $product['product_id']; ?>" />
									<input type="number" name="quantity" class="product-quantity" id="product-quantity" max="<?= $product['stocks']; ?>" min="1" value="1" width="20px" />
										<span class="font13em" id="quant_num">
											*quantity needed
										</span>
									</p>
									<p>
										<input type="submit" name="add_to_basket" value="Add To Basket" class="bam bamColor" <?php if ($product['stocks'] == 0) { ?> disabled <?php }?> />
										<span style='font-size:18px; font-style:italic;'>
											<?php Formats::display_stocks_left($product['stocks']); ?>
										</span>
									</p>
							</blockquote>
						</div>
					</form>
						<!-- ITEM DISCRIPTION -->
						<div class="item-description">
							<?= $product['description']; ?>
						</div>

					<div style="text-align: center;">
						<a href="product.php" class="basket_buttons" style="font-size: 26px;"><< Keep Shopping</a>
					</div>
				</div>
			</div><!-- END OF PRODUCT PAGE ID -->
		</div>
	<?php } ?>
	<!-- END OF BODY 2. -->

</div>
<!-- END OF BODY-CONTENT -->

<!-- FOOTER -->
<?php require("templates/footer.php"); ?>
<!-- SCRIPTING -->
<script src="javas.js"></script>
</body>
</html>