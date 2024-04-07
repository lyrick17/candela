<?php 
	require('utilities/server.php');
	require("utilities/admin_update_product_3.php");

	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Product - Admin</title>
	<?php require("templates/head.php"); ?>
</head>

<body>
<!-- HEADER/NAVIGATION BAR -->
<?php require("templates/nav_admin.php"); ?>
<!-- BODY CONTENT -->
<div class="body-content">

	<!-- MODAL CONTENT for Terms and Conditions -->
	<?php include("templates/modals/modal_terms_conditions.php"); ?>
	
	<!-- 1. ADD PRODUCT FORM -->
		<div class="padding-y-1 padding-x-3">
			<div>
				<div id="product-nav">
					<a href="admin-products.php"><< Back To Products</a>
				</div>
				<div class="text-center font-30 fw-bold py-3 ">
                        Add a New Candela Product
				</div>

				<div>
						<form method="post" enctype="multipart/form-data" action="admin-products-add.php">
							<div class="row gx-0 py-3">
								<!-- ITEM PICTURE -->
								<div class="col-md-5 text-center px-5 px-md-3 ">
									<div class="sidebar-box-4 mx-md-5 py-2 rounded overflow-hidden shadow-lg"> 
										<img class="" id="product-pic" name="p_pic" src="" style="height: 20vh;" >
										<br />
										<input type="file" id="file-input" name="userfile" style="opacity: 0;" />
										<label for="file-input" class="btn btn-secondary my-1" role="button">Add Product Image</label>
                                        <span class="text-danger">*</span>
										<br />
										<span><i>*make sure the image dimension is 200x200pixels</i></span>
									</div>
								</div>
								<!-- ITEM MAIN INFORMATION-->
								<div class="col-md-7 item-main-info font-25">
									<blockquote class="row">
										
										<div class="col-md-2">
                                            Name:
                                            <span class="text-danger">*</span>
                                        </div>
										<div class="col-md-10"><input type="text" name="name" value="" maxlength="255" /></div>
										
										<div class="col-md-2">
                                            Price:
                                            <span class="text-danger">*</span>
                                        </div>
										<div class="col-md-10"><input type="text" name="price" value="" maxlength="10" /></div>
										
										<div class="col-md-2">
                                            Stocks:
                                            <span class="text-danger">*</span>
                                        </div>
										<div class="col-md-10"><input type="number" name="stocks" value="" /></div>
										
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
								<div class="font-25 text-center">
                                    Description:
                                    <span class="text-danger">*</span>
                                </div>
								<textarea name="description" class="textarea-edit"></textarea>
								<hr />
							</div>
							
							<div class="text-center font-25 py-2">
								<input type="submit" name="save" class="btn btn-success font-25" value="Save Changes" />
							</div>
						</form>
				</div>
			</div><!-- END OF PRODUCT PAGE ID -->
		</div>
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