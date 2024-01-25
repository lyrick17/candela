<?php include("server.php"); ?>
<!DOCTYPE html><html>
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
						<td class="td-login" style="width: 45%;"><?php 
							if (isset($_SESSION['fName'])) {
								echo $_SESSION['fName'];
							} 
							?></td>
					</tr>
					<tr>
						<td class="td-login" style="width: 55%;">Last Name:</td>
						<td class="td-login" style="width: 45%;"><?php 
							if (isset($_SESSION['lName'])) {
								echo $_SESSION['lName'];
							} 
							?></td>
					</tr>
					<tr>
						<td class="td-login" style="width: 55%;">E-mail:</td>
						<td class="td-login" style="width: 45%;"><?php 
							if (isset($_SESSION['chkemail'])) {
								echo $_SESSION['chkemail'];
							} 
							?></td>
					</tr>
					<tr>
						<td class="td-login" style="width: 55%;">Contact Number:</td>
						<td class="td-login" style="width: 45%;"><?php 
							if (isset($_SESSION['chkcontact'])) {
								echo $_SESSION['chkcontact'];
							} 
							?></td>
					</tr>
					<tr>
						<td class="td-login" style="width: 55%;">Address:</td>
						<td class="td-login" style="width: 45%;"><?php 
							if (isset($_SESSION['chkaddr'])) {
								echo $_SESSION['chkaddr'];
							} 
							?></td>
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
					if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
						$basket_id = intval($_SESSION['id']);

						$basketsql = "SELECT basket_content FROM basket_items WHERE user_id = '". $basket_id ."'";
						$basketsql_result = mysqli_query($mysqli, $basketsql) or die("Query to retrieve basket failed");
						if (mysqli_num_rows($basketsql_result) < 1) {
					?>
						<!-- If there is no order. -->
						<div style="text-align: center;margin-top: 15px;">
							<p>Your Basket Is Empty.</p>
						</div>
					<?php } else {
						$total = 0;
					?>
					<table style="width: 100%; margin: 10px 0;">
					<?php
						while ($basketrow = mysqli_fetch_array($basketsql_result)) {
							$basket = unserialize( $basketrow['basket_content'] );
							$_SESSION['basket'] = $basket;
								foreach ($_SESSION['basket'] as $key => $product) {
					?>
					<tr>
						<td class="pbasket-td pb_item"><?php echo $product['pname']; ?></td>
						<td class="pbasket-td pb_num"><?php echo $product['quantity']; ?></td>
						<td class="pbasket-td pb_num">P<?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
					</tr>
					<?php
						$total = $total + ($product['quantity'] * $product['price']);
							} // end foreach
						} // end while
						$_SESSION['total'] = $total;
					?>
					<tr>
					 	<td colspan="2" align="right" class="pbasket-td pb_total">Total</td>
					 	<td class="pbasket-td pb_num">P<?php echo number_format($total, 2); ?></td>
					 </tr>
					</table>
					<div class="text-center">
						<span style="text-align: center;">
							<a href="basket.php" class="basket_buttons"><< I have to update my basket</a>
						</span>
					</div>
					<div class="shipping-fee" style="font-size: 25px;">
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
							$_SESSION['subtotal'] = $subtotal;
							?>
						</span>
						
						<?php 
							} else {
						?>
						<span style="text-decoration: line-through;">Shipping Fee: P50.00</span><br>
						<span style="float: right;">

							Total: <b><?php echo number_format($total, 2); ?></b>
							<?php $_SESSION['subtotal'] = $total; ?>
						</span>
						<?php
							}
						?>
					</div>
					<?php
						} //end else
					} //end if
					else { //if username isn't set
						if (!empty($_SESSION['basket'])) {
							$total = 0;
					?>
					<?php 
					?>

					<table style="width: 100%; margin: 10px 0;">
					<?php
							foreach ($_SESSION['basket'] as $key => $product) {
					?>
					<tr>
						<td class="pbasket-td pb_item"><?php echo $product['pname']; ?></td>
						<td class="pbasket-td pb_num"><?php echo $product['quantity']; ?></td>
						<td class="pbasket-td pb_num">P<?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
					</tr>
					<?php
						$total = $total + ($product['quantity'] * $product['price']);
						} // end foreach
						$_SESSION['total'] = $total;
					?>
					<tr>
					 	<td colspan="2" align="right" class="pbasket-td pb_total">Total</td>
					 	<td class="pbasket-td pb_num">P<?php echo number_format($total, 2); ?></td>
					 </tr>
					</table>
					<div class="text-center">
						<span style="text-align: center;">
							<a href="basket.php" class="basket_buttons"><< I have to update my basket</a>
						</span>
					</div>
					<div class="shipping-fee" style="font-size: 25px;">
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
							$_SESSION['subtotal'] = $subtotal;
							?>
						</span>
						
						<?php 
							} else {
						?>
						<span style="text-decoration: line-through;">Shipping Fee: P50.00</span><br>
						<span style="float: right;">

							Total: <b><?php echo number_format($total, 2); ?></b>
							<?php $_SESSION['subtotal'] = $total; ?>
						</span>
						<?php
							}
						?>
					</div>

					<?php
						} //end if
						else { ?>
						<!-- If there is no order. -->
							<div style="text-align: center;margin-top: 15px;">
								<p>Your Basket Is Empty.</p>
							</div>
					<?php
						} //end else
					} // end else
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
				<label style="font-weight: normal;"><b>Captcha:</b> Are You Human?</label><br>
					<?php echo $no1 ." + ". $no2 ." = "; ?>
				<input type="hidden" name="no1" value="<?php echo $no1; ?>">
				<input type="hidden" name="no2" value="<?php echo $no2; ?>">
				<input type="number" name="captcha" required /><br>
					<span class="field-validity">
						<?php echo $captchaErr; ?>
					</span>
			</div>
			<div>
				<hr>
					<?php 
						if (isset($_SESSION['total'])) {
							if ($_SESSION['total'] < 500) {
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
</body>
</html>