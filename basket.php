<?php include("utilities/server.php"); ?>
<?php require("utilities/process_basket_updates.php"); ?>
<?php Restrict::remove_checkout_sess(); ?>
<?php Restrict::remove_order_id_sess(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Your Basket - Candela</title>
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
	
	<div id="basket-box">
		
		<div id="basket-header">
			Your Basket
		</div>
			<hr>
			<!-- PHP NEEDED --><!-- changing its quantity on the basket itself -->
		<!-- When An Order Has Been Added to Basket -->
				<?php 
					if (empty($_SESSION['basket'])) {
				?>
						<!-- If there is no order. -->
						<div style="text-align: center;margin-top: 15px;">
							<p>Your Basket Is Empty.</p>
							<a href="product.php" class="basket_buttons"><< Keep Shopping</a>
						</div>

				<?php
					} else {
						// includes the updating of basket_information
						require("utilities/process_basket_sync.php");
				?>
						<div class="table-responsive">
							<table>
								<tr>
									<td class="basket-td bktd1">Item</td>
									<td class="basket-td bktd2"></td>
									<td class="basket-td bktd3">Price</td>
									<td class="basket-td bktd4">Quantity</td>
									<td class="basket-td bktd3">Total</td>
									<td class="basket-td bktd4"></td>
								</tr>
								<?php 
									foreach ($_SESSION['basket'] as $product_id => $quantity) {
										$get_products = Products::get_product_info($product_id);
										if ($get_products) {
											$product = mysqli_fetch_array($get_products, MYSQLI_ASSOC);
											?>
									<tr>
										<form method="POST" action="basket.php">
											<td class="basket-td bktd1">
												<img src="<?php echo $product['image']; ?>" height="200px">
											</td>
											<td class="basket-td bktd2"><i><?php echo $product['name']; ?></i><br></td>
											<td class="basket-td bktd3">P<?php echo $product['price']; ?></td>
											<td class="basket-td bktd4"><?php echo $quantity; ?></td>
											<td class="basket-td bktd3">P<?php echo number_format($quantity * $product['price'], 2); ?></td>
											<td class="basket-td bktd4">
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
									<td colspan="4" align="right" class="basket-td bktd4">Total</td>
									<td class="basket-td bktd3">P<?php echo number_format($total, 2); ?></td>
									<td class="basket-td bktd4"></td>
								</tr>
							</table>
						</div>
						<div style="text-align: center; margin-top: 15px;">
							<form method="post" action="basket.php">
							<a href="product.php" class="basket_buttons"><< Keep Shopping</a>
							<!--<a href="basket.php?action=update&id=<?php echo $product['id'] ?>" name="update" value="Update Basket" class="basket_buttons">Update Basket</a>-->
								<input type="submit" name="clear_basket" value="Clear Basket" class="basket_buttons" />
								<a href="checkout.php" class="basket_buttons" name="checkout">Checkout >></a>
							</form>
						</div>

				<?php 
					}
				?>

	</div>
</div>
<!-- FOOTER -->
<?php require("templates/footer.php"); ?>
<!-- SCRIPTING -->
<script src="javas.js"></script>
</body>
</html>