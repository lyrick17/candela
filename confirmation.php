<?php
	require("utilities/server.php");
	require("utilities/process_checkout_confirm.php");
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
	
	<div class="padding-x-1 padding-y-1">
		<form method="post">

		<div class="text-center">
			<div class="font-40"> Please Confirm </div>
			<!--<p class="text-danger font-16">We cannot be responsible for incorrect orders and details sent to us.</p>
			<p class="text-danger font-16">Please be reminded that you cannot cancel your orders once checked out.</p> -->
		</div>

		<hr>

		<!-- NOTIFY -->
		<?php if (!isset($_SESSION['username'])): ?>
		<div class="text-center">
			<p style="font-size: 130%;">You are using <b>Guest Checkout Option</b>.</p>
			<p style="font-size: 140%;">We deliver your orders on the <b><i>upcoming Friday</i></b> of the week <br>(this means you will receive your order on the following week if you order on Friday).</p>
		</div>
		<?php else: ?>
		<div class="text-center">
			<p style="font-size: 140%;">We deliver your orders every <b><i>Friday</i></b> of the week.</p>
		</div>
		<?php endif; ?>

		<!-- ROW -->
		<div class="row gx-0">
			<!-- LEFT SIDE - DETAILS -->
			<div class="p-4 my-2 text-center col-lg-8">
				<div class="checkout-info p-3">
					<h4><b>Your Details</b></h4>
					<!--<p class="text-danger font-16">Please make sure you have entered your <b>correct address</b>. We're not responsible for incorrect addresses.</p>-->
					<div class="text-center font-20">
						<table>
						<tr>
							<td class="td-login text-end fw-bold" style="width: 40%;">First Name:</td>
							<td class="td-login text-start" style="width: 60%;">&nbsp;<?= $_SESSION['checkout']['username']; ?></td>
						</tr>
						<tr>
							<td class="td-login text-end fw-bold" style="width: 40%;">Last Name:</td>
							<td class="td-login text-start" style="width: 60%;">&nbsp;<?= $_SESSION['checkout']['lastname']; ?></td>
						</tr>
						<tr>
							<td class="td-login text-end fw-bold" style="width: 40%;">E-mail:</td>
							<td class="td-login text-start" style="width: 60%;">&nbsp;<?= $_SESSION['checkout']['email']; ?></td>
						</tr>
						<tr>
							<td class="td-login text-end fw-bold" style="width: 40%;">Contact Number:</td>
							<td class="td-login text-start" style="width: 60%;">&nbsp;<?= $_SESSION['checkout']['contactnumber']; ?></td>
						</tr>
						<tr>
							<td class="td-login text-end fw-bold" style="width: 40%;">Address:</td>
							<td class="td-login text-start" style="width: 60%;">&nbsp;<?= $_SESSION['checkout']['address']; ?></td>
						</tr>
						<tr>
							<td class="td-login text-end fw-bold" style="width: 40%;">Barangay:</td>
							<td class="td-login text-start" style="width: 60%;">&nbsp;<?= $_SESSION['checkout']['barangay']; ?></td>
						</tr>
						<tr>
							<td class="td-login text-end fw-bold" style="width: 40%;">City: </td>
							<td class="td-login text-start" style="width: 60%;">&nbsp;Imus, Cavite</td>
						</tr>
						<tr>
							<td class="td-login text-end fw-bold" style="width: 40%;">Postal Code: </td>
							<td class="td-login text-start" style="width: 60%;">&nbsp;4103</td>
						</tr>
						</table>
					</div>
				<br>
				<span class="text-center">
					<a href="checkout.php" class="basket_buttons"><< I have to change the details</a>
				</span>
				</div>
			</div>
			<!-- END OF LEFT SIDE - DETAILS -->

			<!-- RIGHT SIDE - ORDERS -->
			<div class="py-4 my-2 text-center col-lg-4">
				<div class="sidebar-box-2 py-3">
				<h4><b>Your Orders</b></h4>


					<?php 
					if (empty($_SESSION['basket'])) {
						require("templates/basket/empty_basket.php");
					} else {
						// Display the side basket
						require("templates/basket/side_basket.php");
						// Display the necessary buttons
					?>

						<div class="text-center">
							<span style="text-align: center;">
								<a href="basket.php" class="basket_buttons">I have to update my basket</a>
							</span>
						</div>

					<?php 
						// display the shipping fee and the total cost
						require("templates/basket/shipping_fee.php");
					} // endelse
					?>

				</div>
			</div>
			<!-- END OF RIGHT SIDE - ORDERS -->
		</div>
		<!-- TERMS AND CONDITIONS && CAPTCHA -->
		<div class="text-center mt-5">
			<div class="text-center p-3 m-3 reminders">
				<span>Please make sure you have entered your <b>correct address</b>. We're not responsible for incorrect addresses.</span><br />
				<span>Please be reminded that you cannot cancel your orders once checked out.</span>
			</div>
			<div id="captchadiv" class="p-3 m-3">
				<br>
				<div class="text-center">
					<input type="checkbox" name="termsConditions" id="checkme" required />
						I have agreed to the <a id="myBtn"><u>Terms and Conditions</u></a>.<br>
				</div>

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
					<?php if (isset($_SESSION['subtotal'])):
							if ($_SESSION['subtotal'] < 500): ?>
								<div class="less500">
									<div>
										Oops! You should have at least P500.00 of order to proceed. Please read our Terms and Conditions if not aware of.
									</div>
								</div>
								<?php else: ?>
								<input type="submit" name="confirm_checkout" class="basket_buttons" style="font-size:140%;" value="Confirm and Checkout" />
					<?php 	endif; 
						endif; ?>
				<hr>
			</div>
		</div>
		<!-- END OF TERMS AND CONDITIONS && CAPTCHA -->

		</form>
	</div>
</div>

<!-- FOOTER AND BOTTOM HEADER -->
<?php require("templates/footer.php"); ?>
<?php require("templates/nav_bottom.php"); ?>

<!-- SCRIPTING -->		
<script src="resources/js/javas.js"></script>
<script src="resources/js/captcha_validation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>