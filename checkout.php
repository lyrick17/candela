<?php
	require("utilities/server.php");
	require("utilities/process_checkout.php");
	Restrict::remove_order_id_sess();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Checkout - Candela</title>

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


	<div id="checkout-box" class="padding-x-1 padding-y-2">

		<div class="font-35">
			Checkout Form
		</div>
		<div class="row gx-0">
			<div class="col-md-7 mb-3">
				<!-- LEFT SIDE - USER INFORMATION -->	
				<div id="checkout_form" >
					<hr>
					<?php if (!isset($_SESSION['id'])): ?>
						<p id="checkout_note">
							<b>Please Note That</b>: 
							<i>You will be using a <u>guest checkout</u> option for you're ordering without an account.</i>
						</p>
					<?php endif; ?>
					<p>Please Fill Up (<span class="fst-italic">if blank</span>) and Validate your Details for the Delivery. This will be <i>Cash on Delivery</i>.</p>
					<!-- FORM INFORMATION -->
					<form method="POST" action="checkout.php">
						<table style="width: 100%;">
							<tr>
								<!-- FIRSTNAME -->
								<td class="py-1 w-25">First Name:<span class="text-danger">*</span></td>
								<td class="py-1">
									<input type="text" name="fName" value="<?= Formats::display_info('username', $checkout_info['username']); ?>" required />
								</td>
								<td><span class="field-validity"><?= $info_error['username'];  ?></span></td>
							</tr>
							<tr>
								<!-- LASTNAME -->
								<td class="py-1">Last Name:<span class="text-danger">*</span></td>
								<td class="py-1">
									<input type="text" name="LName" value="<?= Formats::display_info('lastname', $checkout_info['lastname']); ?>" required />
								</td>
								<td><span class="field-validity"><?= $info_error['lastname'];  ?></span></td>
							</tr>
							<tr>
								<!-- EMAIL -->
								<td class="py-1" >E-mail:<span class="text-danger">*</span></td>
								<td class="py-1">
									<input type="text" name="email" value="<?= Formats::display_info('email', $checkout_info['email']); ?>" required />
								</td>
								<td><span class="field-validity"><?= $info_error['email'];  ?></span></td>
							</tr>
							<tr>
								<!-- CONTACT NUMBER -->
								<td class="py-1">Contact Number:<span class="text-danger">*</span></td>
								<td class="py-1"><input type="text" name="contactnum" value="<?= Formats::display_info('contactnumber', $checkout_info['contact']); ?>" maxlength="11" required /></td>
								<td><span class="field-validity"><?= $info_error['contact']; ?></span></td>
							</tr>
							<tr>
								<!-- ADDRESS -->
								<td class="py-1">Address:<span class="text-danger">*</span></td>
								<td class="py-1">
									<textarea name="addr" style="width: 100%;"required><?= Formats::display_info('address', $checkout_info['address']); ?></textarea>
								</td>
							</tr>
							<tr>
								<!-- BARANGAY -->
								<td class="py-1"></td>
								<td class="py-1">
									<input type="hidden" id="barangayvalue" value="<?= Formats::display_info('barangay', $checkout_info['barangay']); ?>" />
									<?php require("templates/barangay_list.php"); ?>
								</td>
								<td><span class="field-validity"><?= $info_error['address'];  ?></span></td>
							</tr>
							<tr>
								<td class="py-1">City: </td>
								<td class="py-1">Imus, Cavite</td>
							</tr>
							<tr>
								<td class="py-1">Postal Code: </td>
								<td class="py-1">4103</td>
							</tr>
						</table>
						<div id="address_warning">
						<p><b>NOTE</b>: <i>The delivery will only be available around the <b>City of Imus</b>. Entering addresses outside the city will notify the customers that the items ordered will not be delivered, and the orders will be cancelled.</i></p><br>
						</div>
						<table class="w-100 text-center">
							<tr>
								<td class="text-center">
									<?php 
										if (isset($_SESSION['subtotal'])):
											if ($_SESSION['subtotal'] < 500):
									?>
												<div class="less500">
													<div>
													Oops! You should have at least P500.00 of order to proceed (excluding the Shipping Fee). Please read our Terms and Conditions if not aware of.
													</div>
												</div>
									<?php 	else: ?>
										<input type="submit" name="checkout_submit" value="Submit" class="blue_button"/><br><br>
									<?php 
											endif;
										endif; 
									?>
									<a href="product.php" class="basket_buttons"><< Keep Shopping</a>
								</td>
							</tr>
						</table>
					</form>
				</div>
				<!-- END OF LEFT SIDE - USER INFORMATION -->
			</div> 
			<div class="col-md-5">
				<!-- RIGHT SIDE - ORDERS -->
				<div>
					
					<hr>
					
					<p class="text-center">Please make sure that you've ordered your choice of items.</p>
					<p class="red-reminders">Once checked out, the orders cannot be changed.</i></p>

					<hr>

						<?php 
							if (empty($_SESSION['basket'])) {
							// Display the empty basket
							require("templates/basket/empty_basket.php");
							} else {
							// Display the side basket
							require("templates/basket/side_basket.php");
							// Display the necessary buttons
						?>

							<div class="text-center">
								<a href="basket.php" class="basket_buttons">I have to update my basket</a>
							</div>
						<?php
							// display the shipping fee and the total cost
							require("templates/basket/shipping_fee.php");
							} // end else, if there are orders in basket
						?>
				</div>
				<!-- END OF RIGHT SIDE - ORDERS -->
			</div> 
		</div>
		


		
		
	</div>
</div>
<!-- FOOTER -->
<?php require("templates/footer.php"); ?>

<!-- SCRIPTING -->
<script src="resources/js/javas.js"></script>
<script src="resources/js/barangay_select.js"></script>
</body>
</html>