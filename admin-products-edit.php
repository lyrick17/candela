<?php 
	require('utilities/server.php');
	require("utilities/admin_update_product_2.php");

	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Product - Admin</title>
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

				<?php if ($product_info): ?>
				<div>
					<?php $product = mysqli_fetch_array($product_info, MYSQLI_ASSOC); ?>
						<form method="post" enctype="multipart/form-data" action="admin-products-edit.php?id=<?=$_GET['id']?>">
							<div class="row gx-0 py-3">
								<!-- ITEM PICTURE -->
								<div class="col-md-5 text-center px-5 px-md-3 ">
									<div class="sidebar-box-4 mx-md-5 py-2 rounded overflow-hidden shadow-lg"> 
										<img class="" id="product-pic" name="p_pic" src="<?= $product['image'] ?>" style="height: 20vh;" >
										<br />
										<input type="file" id="file-input" name="userfile" style="opacity: 0;" />
										<label for="file-input" class="btn btn-secondary my-1" role="button">Change Image</label>
										<br />
										<span><i>*make sure the image dimension is 200x200pixels</i></span>
										<!--<span>Image URL: <input type="text" name="image" value="<?= $product['image'] ?>" /></span>-->
									</div>
								</div>
								<!-- ITEM MAIN INFORMATION-->
								<div class="col-md-7 item-main-info font-25">
									<blockquote class="row">
										<div class="col-md-2">ID:</div>
										<div class="col-md-10">
											<input type="text" name="" value="<?= $product['product_id'] ?>" disabled />
											<input type="hidden" name="product_id" value="<?= $product['product_id'] ?>" />
										</div>
										
										<div class="col-md-2">Name:</div>
										<div class="col-md-10"><input type="text" name="name" value="<?= $product['name'] ?>" maxlength="255" /></div>
										
										<div class="col-md-2">Price:</div>
										<div class="col-md-10"><input type="text" name="price" value="<?= $product['price'] ?>" maxlength="10" /></div>
										
										<div class="col-md-2">Stocks:</div>
										<div class="col-md-10"><input type="number" name="stocks" value="<?= $product['stocks'] ?>" /></div>
										
										<div class="col-md-2"></div>
										<div class="col-md-10 font-16 text-danger">
											<span class="text-success fw-bold"><?= $success_msg; ?></span>
											<p style="margin: 0; padding: 0;"><?= $error['name']; ?></p>
											<p style="margin: 0; padding: 0;"><?= $error['price']; ?></p>
											<p style="margin: 0; padding: 0;"><?= $error['stocks']; ?></p>
											<p style="margin: 0; padding: 0;"><?= $error['description']; ?></p>
											<p style="margin: 0; padding: 0;"><?= $error['file']; ?></p>
											
										</div>
								
									</blockquote>
								</div>
							</div>
							
							<!-- ITEM DISCRIPTION -->
							<div class="item-description sidebar-box-1 font-20">
								<div class="font-25 text-center">Description:</div>
								<textarea name="description" class="textarea-edit"><?= $product['description']; ?></textarea>
								<hr />
								<div class="font-16">
									Last Modified: <b><?= date("l, j F Y, g:i A", strtotime($product['product_added_date'])); ?></b>
									
								</div>
							</div>
							
							<div class="text-center font-25 py-2">
								<input type="submit" name="save" class="btn btn-success font-25" value="Save Changes" />
							</div>
						</form>

					<div class="text-center font-25 py-2">
						<a href="admin-products.php" class="basket_buttons">Back to Products Page</a>
					</div>
				</div>
				<?php else: ?>
					<div class="text-center font-20 py-5">
						This page has been accessed incorrectly.<br />
						There is no existing product with id: <b><?=$_GET['id']?></b>.<br /></div>
					<div class="text-center font-25 py-2">
						<a href="admin-products.php" class="basket_buttons">Back to Products Page</a>
					</div>
				<?php endif; ?>
			</div><!-- END OF PRODUCT PAGE ID -->
		</div>
	<?php else: ?>
		<div class="padding-y-1 padding-x-3">
			<div id="product-nav">
				<a href="admin-products.php"><< Back To Products</a>
				<span class="text-success fw-bold"><?= $success_msg; ?></span>
			</div>
			<div class="text-center font-20 py-5">This page has been accessed incorrectly.<br /> Please go back to the products page.</div>
			<div class="text-center font-25 py-2">
				<a href="admin-products.php" class="basket_buttons">Back to Products Page</a>
			</div>
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
<script>
	const image_input = document.getElementById("file-input");
	const displayed_image = document.getElementById("product-pic");

	image_input.addEventListener("change", function(e) {
	
		const uploadedFile = e.target.files[0];
		const imageUrl = URL.createObjectURL(uploadedFile);
		displayed_image.src = imageUrl;

		// Create a new image element to check dimensions
		const img = new Image();
		img.src = imageUrl;

		img.onload = function() {
			// Check if either width or height is larger than 200
			const originalWidth = this.width;
			const originalHeight = this.height;
			let newWidth = 200;
			let newHeight = 200;

			
			console.log("height" + originalWidth);
			console.log("width" + originalHeight);
			console.log("height" + newWidth);
			console.log("width" + newHeight);
			// Set image dimensions on selectedImage
			displayed_image.width = newWidth;
			displayed_image.height = newHeight;
			displayed_image.src = imageUrl; // update the source of the image now that we have the correct dimensions
		};
	});
</script>
</body>
</html>