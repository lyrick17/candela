<?php
	require("utilities/server.php");
	require("utilities/process_checkout_upd_info.php");
	Restrict::success_page_access();
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
<div class="body-content">
	<!-- MODAL CONTENT for Terms and Conditions -->
	<?php include("templates/modals/modal_terms_conditions.php"); ?>

	<div style="padding: 20px; margin: 90px 20px 10px 20px;">
		<div style="text-align: center;">
			<div id="basket-header">
				- Thank You for Choosing Us -
			</div>

			<!-- ORDER SUMMARY -->
			<div style="font-size: 120%;">
				<hr>

				<?php 

				$order = Orders::get_order($_SESSION['recent_order_id']);
				if ($order) {
					$items = json_decode($order['products'], true);
					$items = array_filter($items);
					$complete_address = $order['address'] . ", " . $order['barangay'];
				} else {
					// the process hasnt processed well
				}

				?>
				<p>Your Order Id is: <?= $_SESSION['recent_order_id']; ?></p>
				<p>You've successfully ordered:</p>


				<p style="font-size: 150%;">
					<?php 
						foreach ($items as $product_id => $quantity) {
							$product = Products::get_product_info($product_id);
							if (!$product) continue;
							$product = mysqli_fetch_array($product, MYSQLI_ASSOC);
							$product_total = $product['price'] * $quantity;
								echo $quantity . " <b>" . $product['name'] . "/s</b> : P" . $product_total . "<br>";
						}
					?>
				</p>
				<div class="shipping-fee">
					<span>Shipping Fee: P<?= $order['shipping_fee']; ?></span>
				</div>
				<p>For a total of:</p>


				<p style="font-size: 150%;">
					P<?= $order['total']; ?>
				</p>


				<p>To be delivered at:</p>


				<p style="font-size: 150%;">
					<?= $complete_address; ?><br>
					<span style="font-size: medium;">Imus City, Cavite</span>
				</p>

				<hr>

				<p style="font-size: 20px;">Thank You for choosing Candela! Your order will now be delivered in <b>the upcoming Friday</b> of the week.</p>
				
				
				<hr><br>
				
				
				<p>Would you rather give us a feedback? We would love to hear it from you!</p>
				<br><a href="contact-us.php" class="lend_feedback">Lend A Feedback</a>

				<!-- CHANGING INFORMATION -->
				<div style="padding: 30px 0;" >

					<hr>

					<?php if (isset($_SESSION['id'])): ?>
						<!-- Changing Address -->
						<div id="new_info_address">
							<form method="post" id="form_change_address" enctype="multipart/form-data" action="success.php">
						
							<?php if (!isset($_SESSION['address'])): ?>
								
								<p class="changed-addr-num">You have now entered your <b>address</b>, would you like to save it on your account?</p>
								<p>
									<i>Your new address is :</i> &nbsp;&nbsp;<?php echo $complete_address; ?>
								</p>
									<input type="hidden" name="insert_address" value="" />
									<input type="submit" name="" value="Yes, I would love to!" />
									<span class="dismiss-request">Dismiss if you don't want to.</span>

							<?php elseif ($_SESSION['address'] != $order['address']): ?>
								
								<p class="changed-addr-num">You have entered other <b>address</b> in this order. Would you like to change your previous one?</p>
								<p>
									<i>Your old address is :</i> &nbsp;&nbsp;<?php echo $_SESSION['address'] . ", " . $_SESSION['barangay']; ?>
								</p>
								<p>
									<i>Your new address is :</i> &nbsp;&nbsp;<?php echo $complete_address; ?>
								</p>
									<input type="hidden" name="change_address" value="" />
									<input type="submit" name="" value="Yes, I would love to!" />
									<span class="dismiss-request">Dismiss if you don't want to.</span>

							<?php endif; ?>

							</form>
						</div>
						
						<div id="change_address_success" style="display:none;">
							<p class="changed-addr-num"><b>Address</b> has been successfully changed.</p>
						</div>

						<hr>

						<!-- Changing Contact Number-->
						<div id="new_info_contactnumber">
							<form method="post" id="form_change_contactnum" enctype="multipart/form-data" action="success.php">

							<?php if (!isset($_SESSION['contactnumber'])): ?>
							
								<p class="changed-addr-num">You have now entered your <b>contact number</b>. Would you like to save it on your account?</p>
							<p>
								<i>Your new contact number is :</i> &nbsp;&nbsp;<?php echo $order['contactnumber']; ?>
							</p>
								<input type="hidden" name="change_contactnum" value="" />
								<input type="submit" name="" value="Yes, I would love to!" />
								<span class="dismiss-request">Dismiss if you don't want to.</span>

							<?php elseif ($_SESSION['contactnumber'] != $order['contactnumber']): ?>
							
								<p class="changed-addr-num">You have entered other <b>contact number</b> in this order. Would you like to change your previous one?</p>
							<p>
								<i>Your old contact number is :</i> &nbsp;&nbsp;<?php echo $_SESSION['contactnumber']; ?>
							</p>
							<p>
								<i>Your new contact number is :</i> &nbsp;&nbsp;<?php echo $order['contactnumber']; ?>
							</p>
								<input type="hidden" name="change_contactnum" value="" />
								<input type="submit" name="" value="Yes, I would love to!" />
								<span class="dismiss-request">Dismiss if you don't want to.</span>

							<?php endif; ?>
							</form>
						</div>
						<div id="change_contactnumber_success" style="display:none;">
							<p class="changed-addr-num"><b>Contact Number</b> has been successfully changed.</p>
						</div>
						<hr>		
					<?php endif; ?>
					

					<div style="margin-top: 50px;">
						<a href="index.php" class="lend_feedback"><< Home</a>
						<a href="myaccount.php" class="lend_feedback">My Account</a>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>
<!-- FOOTER -->
<?php require("templates/footer.php"); ?>
<!-- SCRIPTING -->
<script src="resources/js/javas.js"></script>
<script src="resources/js/fetch_checkout_upd_info.js"></script>
</body>
</html>