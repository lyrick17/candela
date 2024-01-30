<?php include("utilities/server.php"); ?>
<?php include("utilities/process_checkout.php"); ?>
<?php Restrict::remove_checkout_sess(); ?>
<?php Restrict::remove_order_id_sess(); ?>
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


	<div id="checkout-box">

		<!-- LEFT SIDE - USER INFORMATION -->	
		<div id="basket-header">
			Checkout Form
		</div>
		<div style="display: inline-block; width: 60%;" id="checkout_form" >
			<hr><br>
			<?php if (!isset($_SESSION['id'])) { ?>
				<p id="checkout_note">
					<b>Please Note That</b>: 
					<i>You will be using a <u>guest checkout</u> option for you're ordering without an account.</i>
				</p>
			
			<?php } ?>
			<span id="checkoutForms"></span>
			<p>Please Fill Up (<span style="font-size:75%; font-style: italic;">if blank</span>) and Validate your Details for the Delivery. This will be <i>Cash on Delivery</i>.</p><br>


		<form method="POST" action="checkout.php">
			<table>
				<tr>
					<td class="td-login">First Name:<span style="color:red;">*</span></td>
					<td class="td-login">
						<input type="text" name="fName" value="<?= Formats::display_checkout_info('username', $checkout_info['username']); ?>" required />
					</td>
					<td><span class="field-validity"><?= $info_error['username'];  ?></span></td>
				</tr>
				<tr>
					<td class="td-login">Last Name:<span style="color:red;">*</span></td>
					<td class="td-login">
						<input type="text" name="LName" value="<?= Formats::display_checkout_info('lastname', $checkout_info['lastname']); ?>" required />
					</td>
					<td><span class="field-validity"><?= $info_error['lastname'];  ?></span></td>
				</tr>
				<tr>
					<td class="td-login">E-mail:<span style="color:red;">*</span></td>
					<td class="td-login">
						<input type="text" name="email" value="<?= Formats::display_checkout_info('email', $checkout_info['email']); ?>" required />
					</td>
					<td><span class="field-validity"><?= $info_error['email'];  ?></span></td>
				</tr>
				<tr>
					<td class="td-login">Contact Number:<span style="color:red;">*</span></td>
					<td class="td-login"><input type="text" name="contactnum" value="<?= Formats::display_checkout_info('contactnumber', $checkout_info['contact']); ?>" maxlength="11" required /></td>
					<td><span class="field-validity"><?= $info_error['contact']; ?></span></td>
				</tr>
				<tr>
					<td class="td-login">Address:<span style="color:red;">*</span></td>
					<td class="td-login"><input type="text" name="addr" value="<?= Formats::display_checkout_info('address', $checkout_info['address']); ?>" style="width: 250%;" required /> </td>
				</tr>
				<tr>
					<td class="td-login"></td>
					<td class="td-login">
						<input type="hidden" id="barangayvalue" value="<?= Formats::display_checkout_info('barangay', $checkout_info['barangay']); ?>" />
						<?php require("templates/barangay_list.php"); ?>
					</td>
					<td><span class="field-validity"><?= $info_error['address'];  ?></span></td>
				</tr>
				<tr>
					<td class="td-login">City: </td>
					<td class="td-login">Imus, Cavite</td>
				</tr>
				<tr>
					<td class="td-login">Postal Code: </td>
					<td class="td-login">4103</td>
				</tr>
			</table>
			<div id="address_warning">
			<p><b>NOTE</b>: <i>The delivery will only be available around the <b>City of Imus</b>. Entering addresses outside the city will notify the customers that the items ordered will not be delivered, and the orders will be cancelled.</i></p><br>
			</div>
			<table width="80%">
				<tr>
					<td style="text-align: center;">
						<?php 
							if (isset($_SESSION['subtotal'])) {
								if ($_SESSION['subtotal'] < 500) {
						?>

									<div class="less500">
										<div>
										Oops! You should have at least P500.00 of order to proceed (excluding the Shipping Fee). Please read our Terms and Conditions if not aware of.
										</div>
									</div>
									<a href="product.php" class="basket_buttons"><< Keep Shopping</a>
						<?php
								} else {
						?>
									<input type="submit" name="checkout_submit" value="Submit" width="50%" style="font-weight: lighter;" class="blue_button"/><br><br>
									<a href="product.php" class="basket_buttons"><< Keep Shopping</a>
						<?php 
								}
							} 
						?>
					</td>
				</tr>
			</table>
		</form>
		</div>

		<!-- RIGHT SIDE - ORDERS -->
		<div style=" display: inline-block; vertical-align: top;">
			
			<hr>
			
			<p>Please make sure that you've ordered your choice of items.</p>
			<p class="red-reminders">Once checked out, the orders cannot be changed.</i></p>

			<hr>

				<?php 
					if (empty($_SESSION['basket'])) {
				?>
						<!-- If there is no order. -->
						<div style="text-align: center;margin-top: 15px;">
							<p>Your Basket Is Empty.</p>
						</div>

				<?php
					} else {
				?>
					<table style="width: 100%; margin: 10px 0;">
				<?php 
				
					// includes the updating of basket_information
					require("utilities/process_basket_sync.php");

					foreach ($_SESSION['basket'] as $product_id => $quantity) {
						$get_products = Products::get_product_info($product_id);
						if ($get_products) {
							$product = mysqli_fetch_array($get_products, MYSQLI_ASSOC);
				?>
						<tr>
							<td class="pbasket-td pb_item"><?php echo $product['name']; ?></td>
							<td class="pbasket-td pb_num"><?php echo $quantity; ?></td>
							<td class="pbasket-td pb_num">P<?php echo number_format($quantity * $product['price'], 2); ?></td>
						</tr>
				<?php 
						} // end if
					} // end foreach
				?>
						
						<tr>
							<td colspan="2" align="right" class="pbasket-td pb_total">Total</td>
							<td class="pbasket-td pb_num">P<?php echo number_format($total, 2); ?></td>
						</tr>
					</table>

				<div class="text-center">
					<span style="text-align: center;">
						<a href="basket.php" class="basket_buttons">I have to update my basket</a>
					</span>
				</div>

				<div class="shipping-fee">
					<?php if ($total < 2000) {
					?>
					Shipping Fee : P50.00<br>
					<span style="float: right;">
						<?php 
						$shippingfee = 50;
						$subtotal = $total + $shippingfee; 
						?>
						Total : <b>P<?php echo number_format($subtotal, 2); ?></b>
						<?php 
						$_SESSION['total'] = $subtotal;
						?>
					</span>
					
					<?php 
						} else {
					?>
					<span style="text-decoration: line-through;">Shipping Fee: P50.00</span><br>
					<span style="float: right;">
						Total: <b><?php echo number_format($total, 2); ?></b>
						<?php $_SESSION['total'] = $total; ?>
					</span>
					<?php
						}
					?>
				</div>
				<?php 
					} // end else, if there are orders in basket
				?>
		</div>
		
	</div>
</div>
<!-- FOOTER -->
<?php require("templates/footer.php"); ?>

<!-- SCRIPTING -->
<script src="javas.js"></script>
<script src="utilities/barangay_select.js"></script>
</body>
</html>