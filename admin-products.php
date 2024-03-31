<?php 
	require('utilities/server.php');
	require("utilities/process_basket_updates.php");
	if (isset($_GET['id']))
		Restrict::product_page_access($_GET['id']);
	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Products - Admin</title>
	<?php require("templates/head.php"); ?>
</head>

<body>
<!-- HEADER/NAVIGATION BAR -->
<?php require("templates/nav_admin.php"); ?>
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

		<header id="product-header" class="font-35 fw-bold text-center">
			Candela Products<br />
		</header>
		<div class="text-center"><a href="#" class="item-links">Add a Product</a></div>
		<hr><hr>

		<!-- LIST OF PRODUCTS -->
		<div id="" class="text-center">
			<div class="row gx-0">
				<?php 
					$product_list = Products::select_all();
					if ($product_list):
						while ($product = mysqli_fetch_array($product_list, MYSQLI_ASSOC)):
				?>
						<div class="col-md-4">
							<div class="items">
								<form method="post" action="product.php" class="form-products">
									<span class="product-pic">
										<a name="productpage" href="product.php?id=<?= $product['product_id']; ?>">
											<!-- ITEM PICTURE -->
											<img name="p_pic" src="<?= $product['image']; ?>" alt="Product"  />
										</a>
									</span>
									<div class="text-center py-3">
										<!-- ITEM INFORMATION -->
										<p class="font-20 pt-3 fw-bold"><?= $product['name']; ?></p>
											<span class="text-success"></span>
											<div class="row gx-0 py-2">
												<div class="col-4 text-end">Price:</div>
												<div class="col-8 text-start"><input type="number" name="products" class="product-quantity" min="1" value="<?= $product['price']; ?>" /></div>
												<div class="col-4 text-end">Stocks:</div>
												<div class="col-8 text-start"><input type="number" name="stocks" class="product-quantity" min="1" value="<?= $product['stocks']; ?>" /></div>
											</div>
											<!-- PRODUCT ID AND SUBMIT BUTTON -->
											<input type="hidden" name="product_id" value="<?= $product['product_id']; ?>" />
											<input type="submit" name="add_to_basket" value="Save Changes" class="btn btn-success" <?php if ($product['stocks'] == 0) { ?> disabled <?php } ?> />
									</div>				
								</form>
								<!-- Link For Item Description-->
								<div>
									<a href="admin-products.php?id=<?= $product['product_id']; ?>" class="item-links">Change Details</a>
										
									<span class="font-16 fst-italic">
										<?php Formats::display_stocks_left($product['stocks']); ?>
									</span>
								</div>
							</div>
						</div>
				<?php 
						endwhile;
					endif;
				?>
			</div>
		</div>
	
	
	</div>
	<!-- END OF BODY 1. -->


	<!-- BODY 2. SPECIFIC PRODUCT PAGE WITH PRODUCT INFORMATION -->
	<?php } else { // end of if (!isset($_GET['id'])) 
	 		    $product_info = Products::get_product_info($_GET['id']); 
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
								<img class="h-100 specific" name="p_pic" src="<?= $product['image'] ?>">
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
<?php require("templates/nav_bottom_admin.php"); ?>

<!-- SCRIPTING -->		
<script src="resources/js/javas.js"></script>
<script src="resources/js/admin-products.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>