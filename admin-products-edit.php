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
	<!-- 2. SPECIFIC PRODUCT PAGE WITH PRODUCT INFORMATION -->
	
	<!-- BODY 2. SPECIFIC PRODUCT PAGE WITH PRODUCT INFORMATION -->
	<?php if(isset($_GET['id'])): ?>
		<?php  $product_info = Products::get_product_info($_GET['id']); ?>
		<div class="padding-y-1 padding-x-3">
			<div>

				<div id="product-nav">
					<a href="admin-products.php"><< Back To Products</a>
				</div>

				<div class="">
					<?php $product = mysqli_fetch_array($product_info, MYSQLI_ASSOC); ?>

					<form method="post" action="admin-products-edit.php">
						<div class="row gx-0 py-3">
							<!-- ITEM PICTURE -->
							<div class="col-sm-5 text-center">
								<img class="h-100 specific" name="p_pic" src="<?= $product['image'] ?>"><br />
							</div>
							<!-- ITEM MAIN INFORMATION-->
							<div class="col-sm-7 item-main-info font-25">
								<blockquote class="row">
									<div class="col-2">ID:</div>
									<div class="col-10"><input type="text" name="id" value="<?= $product['product_id'] ?>" disabled/></div>
									
									<div class="col-2">Name:</div>
									<div class="col-10"><input type="text" name="name" value="<?= $product['name'] ?>" /></div>
									
									<div class="col-2">Price:</div>
									<div class="col-10"><input type="text" name="price" value="<?= $product['price'] ?>" /></div>
									
									<div class="col-2">Stocks:</div>
									<div class="col-10"><input type="number" name="stocks" value="<?= $product['stocks'] ?>" /></div>
								</blockquote>
							</div>
						</div>
						
					</form>
						<!-- ITEM DISCRIPTION -->
						<div class="item-description sidebar-box-1 font-20">
							<div class="font-25 text-center">Description:</div>
							<textarea name="description" style="width: 100%; height: 30vh; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><?= $product['description']; ?></textarea>
						</div>

					<div class="text-center font-25">
						<a href="admin-products.php" class="basket_buttons">Back to Products Page</a>
					</div>
				</div>
			</div><!-- END OF PRODUCT PAGE ID -->
		</div>
	<?php endif; ?>
	<!-- END OF BODY 2. -->

</div>
<!-- END OF BODY-CONTENT -->

<!-- FOOTER AND BOTTOM HEADER -->
<?php require("templates/footer.php"); ?>
<?php require("templates/nav_bottom_admin.php"); ?>

<!-- SCRIPTING -->		
<script src="resources/js/javas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>