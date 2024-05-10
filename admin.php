<?php
	require("utilities/server.php");
	require("utilities/admin_update_status.php");
	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Candela - Admin</title>
	<?php require("templates/head.php"); ?>
</head>

<body>
<!-- HEADER/NAVIGATION BAR -->
<?php require("templates/nav_admin.php"); ?>

<!-- CONTENT -->
<div class="body-content">
	<!-- MODAL CONTENT for Terms and Conditions -->
	<?php include("templates/modals/modal_terms_conditions.php"); ?>


	<!-- FIRST CONTENT - Time -->
	<div id="welcome-page" class="padding-y-1 padding-x-3">
		<div class="sidebar-box-3 px-3">
			<?php require("templates/admin/order_dashboard/delivery_day.php"); ?>
		</div>
	<!-- SECOND CONTENT - Admin Dashboard -->
	<div id="" class="row g-0">
		

		<?php if (isset($_SESSION['id'])):
				$orders = Orders::get_orders_admin();
				if ($orders && mysqli_num_rows($orders) > 0):
		?>
					<div id="tagline-description" class="col-lg-12 text-center">
						<div id="tagline" class="font-30 m-2">Admin Dashboard<br /></div>
						<div id="order-buttons" class="">
							<div class="row w-50 mx-auto">
							<?php require("templates/admin/order_dashboard/order_buttons.php"); ?>
							</div>
						</div>
						<?php if (isset($_GET['orders'])): ?>
							<form action="admin.php?orders=<?=$_GET['orders']?>" method="post" id="status-form">
						<?php else: ?>
							<form action="admin.php" method="post" id="status-form">
						<?php endif; ?>
							<?php if (isset($_GET['orders'])): ?>
								<input type="hidden" name="orders" value="<?= $_GET['orders']; ?>" />
							<?php else: ?>
								<input type="hidden" name="orders" value="1" />
							<?php endif; ?>
							<br />
							<div class="text-end px-3">
								<span class="<?= $color ?>"><?= $status_change ?></span>
								<input type="submit" value="Save Changes" class="btn btn-success" />
							</div>
		<?php		
					// $_GET['orders'] = 1 -> recent orders
					// $_GET['orders'] = 2 -> product prepared
					// $_GET['orders'] = 3 -> out for delivery
					// $_GET['orders'] = 4 -> delivered
					// $_GET['orders'] = any -> recent orders
					$displayed_orders = 0;
					while($order = mysqli_fetch_array($orders, MYSQLI_ASSOC)):
						$timestamp = strtotime($order['checked_out']);
						$items = json_decode($order['products'], true);
						$items = array_filter($items);
						if (isset($_GET['orders'])) {
							if ($_GET['orders'] == 1) {
								// If the order is not "Order Placed"
								if ($order['delivered'] != "Order Placed") {
									continue;
								}
							} elseif ($_GET['orders'] == 2) {
								// If the order is not "Product Prepared", skip to the next iteration
								if ($order['delivered'] != "Product Prepared") {
									continue;
								}
							} elseif ($_GET['orders'] == 3) {
								// If the order is not "Out for Delivery", skip to the next iteration
								if ($order['delivered'] != "Out for Delivery") {
									continue;
								}
							} elseif ($_GET['orders'] == 4) {
								// If the order is not "Delivered", skip to the next iteration
								if ($order['delivered'] != "Delivered") {
									continue;
								}
							} else {
								// If the order is not "Delivered", skip to the next iteration
								if ($order['delivered'] != "Cancelled") {
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
									<div class="items">
										<div class="px-2">
											<div class="text-start py-1 font-25"><b>O/N:</b> <i><?= $order['order_id']; ?></i></div>
											<div class="text-start py-1 font-25"><b>Addr:</b> <u><?= $order['address'] ?></u></div>
										</div>
										<div class="row gx-0 px-2">
											<div class="col-md-6">
												
												<div class="text-start py-1"><b>Name:</b> <?= $order['firstname'] . " " . $order['lastname'] ?></div>
												<div class="text-start py-1"><b>Email:</b> <?= $order['email'] ?></div>
												<div class="text-start py-1"><b>Contact:</b> <?= $order['contactnumber'] ?></div>
											</div>
											<div class="col-md-6">
												
												<div class="text-start py-1"><b>Order Date:</b> <i><?= date('m/d/Y H:i:s', $timestamp); ?> , <?= date('l', $timestamp); ?></i></div>
												<div class="text-start py-1">
														<?php 
															$current_order = 0;
															if ($order['order_id'] == "Order Placed") $current_order = 1;
															if ($order['delivered'] == "Product Prepared") $current_order = 2;
															if ($order['delivered'] == "Out for Delivery") $current_order = 3;
															if ($order['delivered'] == "Delivered") $current_order = 4;
															if ($order['delivered'] == "Cancelled") $current_order = 5;
															?>
														<b>Status:</b> 
														<?php if ($current_order == 5): ?>
															<span class="order-status">Cancelled</span>
														<?php else: ?>
															<select name="<?= $order['order_id']; ?>">
																<option <?php if ($current_order == 1) echo 'selected="selected"'; ?>>Order Placed</option>
																<option <?php if ($current_order == 2) echo 'selected="selected"'; ?>>Product Prepared</option>
																<option <?php if ($current_order == 3) echo 'selected="selected"'; ?>>Out for Delivery</option>
																<option <?php if ($current_order == 4) echo 'selected="selected"'; ?>>Delivered</option>
																<option>Cancelled</option>
															</select>
														<?php endif; ?>
												</div>
												<div class="text-start py-1">
													<b>Total Amount:</b> 
													<span class="order-status">P<?= $order['total']; ?></span>
													<?php if ($order['shipping_fee'] == 50): echo "with P50 shipping fee"; endif; ?>
												</div>
											</div>
										</div>
										<div class="row gx-0 px-2">
										</div>
									
										<hr />
									<?php 
										foreach ($items as $product_id => $quantity):
											$product = Products::get_product_info($product_id);
											if (!$product) continue; // suppressing the error, must be revised
											$product = mysqli_fetch_array($product, MYSQLI_ASSOC);
											$product_total = $product['price'] * $quantity;
									?>
											<div class="row gx-0">
												<div class="col-md-4" ><img src="<?= $product['image'];?>" class="recent-order-img-admin" /></div>
												<div class="col-md-8 text-start px-2">
													<b class="font-20"><?= $product['name']; ?></b><br />
													P<?= $product['price']; ?><br />
													Quantity: <?= $quantity; ?> <br />
													Total Amount: <b>P<?= $product_total ?></b>
												</div>
												<div class="col font-20">
												</div>
											</div>
											<hr>
									<?php endforeach; ?>
									</div> <!-- end of product row items -->				
							</div> <!-- end of paginate -->
		<?php 		endwhile; ?>
					</form>
		<?php 		if ($displayed_orders == 0): ?>
						<hr />
						<?php require("templates/admin/order_dashboard/no_orders.php"); ?>
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
					
		<?php 	else: ?>
			<!-- user is logged in, and has no pending orders -->
			<div id="tagline-description" class="text-center">
				<div id="tagline" class="font-30 m-2">Admin Dashboard<br /></div>
				<div id="description" class="font-20">Candela is new. No Orders have been received.</div>
				<div id="description" class="font-20">For a meantime, you can visit Candela for customers.</div>
				<a href="index.php" class="Onow">VIEW CANDELA</a>
			</div>
		<?php 	endif; ?>
		<?php endif; ?>
	</div>


</div>

<!-- FOOTER AND BOTTOM HEADER -->
<?php require("templates/footer.php"); ?>
<?php require("templates/nav_bottom_admin.php"); ?>

<!-- SCRIPTING -->
<script src="resources/js/javas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/jquery.simplePagination.min.js" integrity="sha512-J4OD+6Nca5l8HwpKlxiZZ5iF79e9sgRGSf0GxLsL1W55HHdg48AEiKCXqvQCNtA1NOMOVrw15DXnVuPpBm2mPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="resources/js/checkout_history.js"></script>
</body>
</html>