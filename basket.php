<?php
	require("utilities/server.php");
	require("utilities/process_basket_updates.php");
	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>
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
<div class="body-content" style="">
	<!-- MODAL CONTENT for Terms and Conditions -->
	<?php include("templates/modals/modal_terms_conditions.php"); ?>
	
	<div id="basket-box" class="padding-x-1 padding-y-2">
		
		<div id="basket-header" class="font-35">
			Your Basket
		</div>
			<hr>

			<!-- BASKET CONTENT -->
				<?php 
					if (empty($_SESSION['basket'])) {
						$keep_shopping = true;
						require("templates/basket/empty_basket.php");
					} else {
						// includes the updating of basket_information
						require("utilities/process_basket_sync.php");
				?>
						<div class="desktop-basket">
							<table class="w-100" style="z-index: 1;">
								<tr>
									<td class="basket-td bg-color-1 fw-bold">Item</td>
									<td class="basket-td bg-color-1 fw-bold"></td>
									<td class="basket-td bg-color-1 fw-bold">Price</td>
									<td class="basket-td bg-color-1 fw-bold">Quantity</td>
									<td class="basket-td bg-color-1 fw-bold">Total</td>
									<td class="basket-td bg-color-1 fw-bold"></td>
								</tr>
								<?php 
									foreach ($_SESSION['basket'] as $product_id => $quantity):
										$get_products = Products::get_product_info($product_id);
										if ($get_products):
											$product = mysqli_fetch_array($get_products, MYSQLI_ASSOC);
								?>
									<tr>
										<form method="POST" action="basket.php">
											<td class="basket-td">
												<img src="<?= $product['image']; ?>">
											</td>
											<td class="basket-td"><i><?= $product['name']; ?></i><br></td>
											<td class="basket-td">P<?= $product['price']; ?></td>
											<td class="basket-td"><?= $quantity; ?></td>
											<td class="basket-td">P<?= number_format($quantity * $product['price'], 2); ?></td>
											<td class="basket-td">
												<input type="hidden" name="product_id" value="<?= $product_id ?>" />
												<button type="submit" name="remove_item" class="remove-item">
													Remove Item
												</button>
											</td>
										</form>
									</tr>
								<?php
										endif;
									endforeach;
								?>
								<tr>
									<td colspan="4" align="right" class="basket-td fw-bold">Total</td>
									<td class="basket-td fw-bold">P<?= number_format($total, 2); ?></td>
									<td class="basket-td "></td>
								</tr>
							</table>
							
						</div>
						<div class="mobile-basket padding-x-1">
							<?php 
								foreach ($_SESSION['basket'] as $product_id => $quantity):
									$get_products = Products::get_product_info($product_id);
									if ($get_products):
										$product = mysqli_fetch_array($get_products, MYSQLI_ASSOC);
							?>
								<div class="items text-center">
									<form method="POST" action="basket.php">
										<span class="product-pic">
										<img src="<?php echo $product['image']; ?>">
										</span>
										<div class="">
											<p class="font-20 pt-3"><?= $product['name']; ?></p>
											<p class="font-20">P<?= $product['price']; ?></p>
											<p class="font-20">Quantity: <?= $quantity; ?></p>
											<p class="font-20">Total: P<?= number_format($quantity * $product['price'], 2); ?></p>
											<input type="hidden" name="product_id" value="<?= $product_id ?>" />
											<button type="submit" name="remove_item" class="remove-item">
												Remove Item
											</button>
										</div>
									</form>
								</div>
							<?php
									endif;
								endforeach;
							?>
							<div class="fw-bold text-center">
								<span class="font-30">Total:</span><br>
								<span class="font-35">P<?= number_format($total, 2); ?></span>
							</div>
						</div>
						<div class="text-center m-2">
							<form method="post" action="basket.php">
								<a href="product.php" class="basket_buttons"><< Keep Shopping</a>
								<input type="submit" name="clear_basket" value="Clear Basket" class="basket_buttons" />
								<a href="checkout.php" class="basket_buttons" name="checkout">Checkout >></a>
							</form>
						</div>

				<?php 
					} // endelse
				?>
			<!-- END OF BASKET CONTENT -->
			
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