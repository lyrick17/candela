<?php include("utilities/server.php"); ?>
<?php include("utilities/process_checkout_confirm.php"); ?>
<?php 

	Restrict::confirm_checkout_page_access();
	Restrict::remove_order_id_sess();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Confirmation - Candela</title>
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
	
	<div style="padding: 20px; margin: 90px 120px 50px 120px;">
		<form method="post">
		<div style="text-align: center;">
			<div id="basket-header">
				Please Confirm
			</div>
				<p style="color: red; font-size: 16px;">We cannot be responsible for incorrect orders and details sent to us.</p>
				<p style="color: red; font-size: 16px;">Please be reminded that you cannot cancel your orders once checked out.</p>
		</div>
				<hr>
				<?php if (!isset($_SESSION['username'])) { ?>
				<div style="text-align: center;">
					<p style="font-size: 130%;">You are using <b>Guest Checkout Option</b>.</p>
					<p style="font-size: 150%;">We deliver your orders on the <b><i>upcoming Friday</i></b> of the week <br>(this means you will receive your order on the following week if you order on Friday).</p>
				</div>
				<?php } else {?>
				<div style="text-align: center;">
					<p style="font-size: 150%;">We deliver your orders every <b><i>Friday</i></b> of the week.</p>
				</div>
				<?php } ?>
		<div style="display: inline-block; width: 70%; text-align: center;">
				<h4><b>Your Details</b></h4>
				<hr>
				<p style="color: red; font-size: 16px;">Please make sure you have entered your <b>correct address</b>. We're not responsible for incorrect addresses.</p>
				<div style="text-align: center; font-size: 18px;">
					<table style="margin: 0 auto;">
					<tr>
						<td class="td-login" style="width: 55%;">First Name:</td>
						<td class="td-login" style="width: 45%;"><?= $_SESSION['checkout']['username']; ?></td>
					</tr>
					<tr>
						<td class="td-login" style="width: 55%;">Last Name:</td>
						<td class="td-login" style="width: 45%;"><?= $_SESSION['checkout']['lastname']; ?></td>
					</tr>
					<tr>
						<td class="td-login" style="width: 55%;">E-mail:</td>
						<td class="td-login" style="width: 45%;"><?= $_SESSION['checkout']['email']; ?></td>
					</tr>
					<tr>
						<td class="td-login" style="width: 55%;">Contact Number:</td>
						<td class="td-login" style="width: 45%;"><?= $_SESSION['checkout']['contactnumber']; ?></td>
					</tr>
					<tr>
						<td class="td-login" style="width: 55%;">Address:</td>
						<td class="td-login" style="width: 45%;"><?= $_SESSION['checkout']['address']; ?></td>
					</tr>
					<tr>
						<td class="td-login" style="width: 55%;">Barangay:</td>
						<td class="td-login" style="width: 45%;"><?= $_SESSION['checkout']['barangay']; ?></td>
					</tr>
					<tr>
						<td class="td-login" style="width: 55%;">City: </td>
						<td class="td-login" style="width: 45%;">Imus, Cavite</td>
					</tr>
					<tr>
						<td class="td-login" style="width: 55%;">Postal Code: </td>
						<td class="td-login" style="width: 45%;">4103</td>
					</tr>
					</table>
				</div>
			<br><br>
			<span style="text-align: center;">
				<a href="checkout.php" class="basket_buttons"><< I have to change the details</a>
			</span>
		</div>




		
			<div style="display:inline-block; vertical-align: top; text-align: center; width: 25%;">
				<h4><b>Your Orders</b></h4>

				<hr>

				<div>

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
		<div style="text-align: center;margin-top: 20px;">
			<div id="chkbxs" style="text-align: center;">
				<input type="checkbox" name="termsConditions" id="checkme" required />
					I have agreed to the <a id="myBtn"><u>Terms and Conditions</u></a>.<br>
			</div>
			<br>

			<div id="captchadiv" style="display: inline-block; text-align: center; width: 40%;">
				<center><div class="g-recaptcha" 
					data-callback="captchafilled"
					data-expired-callback="captchaexpired"
					data-sitekey="6Lcsa1cpAAAAAJFa7UYI6_xqJYW6PCpKYGcAp90I" name="captcha" style="margin: auto;"></div>
					<input type="hidden" name="formcaptcha" id="formcaptcha" value="">
					</center>
				<span class="field-validity">
					<?php echo $confirm_error['captcha']; ?>
				</span>
			</div>
			<div>
				<hr>
					<?php 
						if (isset($_SESSION['subtotal'])) {
							if ($_SESSION['subtotal'] < 500) {
					?>
								<div class="less500">
									<div>
									Oops! You should have at least P500.00 of order to proceed. Please read our Terms and Conditions if not aware of.
									</div>
								</div>
					<?php
							} else {
					?>
									<input type="submit" name="confirm_checkout" class="basket_buttons" style="font-size:150%;" value="Confirm and Checkout" />
					<?php 
							}
						} 
					?>
				<hr>
			</div>
		</div>
		</form>
	</div>
</div>
<!-- FOOTER -->
<?php require("templates/footer.php"); ?>
<!-- SCRIPTING -->
<script src="javas.js"></script>
<script src="utilities/captcha_validation.js"></script>
</body>
</html>