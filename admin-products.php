<?php 
	require('utilities/server.php');
	require("utilities/admin_update_product_1.php");
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
		<div class="text-center"><a href="admin-products-add.php" class="basket_buttons font-20" name="checkout">Add a Product</a></div>
		<hr />
		<div class="px-3 py-1">
			<form action="admin-products.php" method="get" id="search-product">
				<input type="text" class="search-text-width py-1 my-1" placeholder="Search a Product..." name="search" maxlength="255">
				<input type="submit" value="Search" class="btn btn-success my-1">
				<a href="admin-products.php" class="btn btn-danger my-1">Clear Search</a>
			</form>
		</div>
		<hr />

		<!-- LIST OF PRODUCTS -->
		<div id="" class="text-center">
			<?php if (isset($_GET['search'])): ?>
				<div class="text-center font-20">
					Search Results for: <span class="font-25"><?= $_GET['search']; ?></span>
				</div>
			<?php endif; ?>
			<div class="row gx-0">
				<?php 
					if (isset($_GET['search'])) {
						$product_list = Products::select_search($_GET['search']);
					} else {
						$product_list = Products::select_all();
					}
						
					if ($product_list):
						while ($product = mysqli_fetch_array($product_list, MYSQLI_ASSOC)):
				?>		
						<div class="col-md-6 col-lg-4">
							<div class="items">
								<form method="post" action="admin-products.php" class="form-products">
									<span class="font-16 fst-italic">
										<?php Formats::display_stocks_left($product['stocks']); ?><br />
									</span>
									<span class="product-pic">
										<a name="productpage" href="product.php?id=<?= $product['product_id']; ?>">
											<!-- ITEM PICTURE -->
											<img name="p_pic" src="<?= $product['image']; ?>" alt="Product"  />
										</a>
									</span>
									<div class="text-center py-3">
										<!-- ITEM INFORMATION -->
										<p class="font-20 pt-3 fw-bold"><?= $product['name']; ?></p>
											<span id="change-message<?= $product['product_id']; ?>"></span>
											<div class="row gx-0 py-2">
												<div class="col-4 text-end">Price:</div>
												<div class="col-8 text-start"><input type="text" name="price" class="product-quantity" value="<?= $product['price']; ?>" /></div>
												<div class="col-4 text-end">Stocks:</div>
												<div class="col-8 text-start"><input type="number" name="stocks" class="product-quantity" value="<?= $product['stocks']; ?>" /></div>
											</div>
											<!-- PRODUCT ID AND SUBMIT BUTTON -->
											<input type="hidden" name="product_id" value="<?= $product['product_id']; ?>" />
											<input type="submit" name="add_to_basket" value="Save Changes" class="btn btn-success" />
									</div>				
								</form>
								<!-- Link For Item Description-->
								<div>
									<a href="admin-products-edit.php?id=<?= $product['product_id']; ?>" class="item-links">Change Details</a>
								</div>
							</div>
						</div>
				<?php 
						endwhile;
					endif;
				?>
				<div class="d-flex justify-content-center py-2">
					<div id="page-nav-content">
						<div id="page-nav"></div>
					</div>
				</div>
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

					<form method="post" action="admin-products.php" class="form-products">
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
						<a href="admin-products-edit.php" class="basket_buttons"><< Keep Shopping</a>
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
<script src="resources/js/admin_products.js"></script>
<script src="resources/js/javas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/jquery.simplePagination.min.js" integrity="sha512-J4OD+6Nca5l8HwpKlxiZZ5iF79e9sgRGSf0GxLsL1W55HHdg48AEiKCXqvQCNtA1NOMOVrw15DXnVuPpBm2mPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="resources/js/product_pagination.js"></script>
</body>
</html>