<?php include("server.php"); ?>
<!DOCTYPE html><html>
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
		<div id="basket-header">
			Checkout Form
		</div>
		<div style="display: inline-block; width: 60%;" id="checkout_form" >
			<hr><br>
			<p id="checkout_note"><b>Please Note That</b>: <i>You will be using a <u>guest checkout</u> option for you're ordering without an account.</i></p>
			<span id="checkoutForms"></span>
			<p>Please Fill Up (<span style="font-size:75%; font-style: italic;">if blank</span>) and Validate your Details for the Delivery. This will be <i>Cash on Delivery</i>.</p><br>


		<form method="POST" action="checkout.php">
			<table>
				<tr>
					<td class="td-login">First Name:<span style="color:red;">*</span></td>
					<td class="td-login">
						<input type="text" name="fName" value="<?php if(isset($_SESSION['username'])){
							echo $_SESSION['username'];} else {
							echo $uName;
							} ?>" required />
					</td>
					<td><span class="field-validity"><?php echo $fNameErr;  ?></span></td>
				</tr>
				<tr>
					<td class="td-login">Last Name:<span style="color:red;">*</span></td>
					<td class="td-login">
						<input type="text" name="LName" value="<?php if(isset($_SESSION['lastname'])){
							echo $_SESSION['lastname'];} else {
							echo $LName;
							} ?>" required />
					</td>
					<td><span class="field-validity"><?php echo $lNameErr;  ?></span></td>
				</tr>
				<tr>
					<td class="td-login">E-mail:<span style="color:red;">*</span></td>
					<td class="td-login"><input type="text" name="email" value="<?php echo email(); ?>" required />
					</td>
					<td><span class="field-validity"><?php echo $chkemailErr;  ?></span></td>
				</tr>
				<tr>
					<td class="td-login">Contact Number:<span style="color:red;">*</span></td>
					<td class="td-login"><input type="text" name="contactnum" value="<?php echo chkcontact(); ?>" maxlength="11" required /></td>
					<td><span class="field-validity"><?php echo $chkcontactnumErr; ?></span></td>
				</tr>
				<tr>
					<td class="td-login">Address:<span style="color:red;">*</span></td>
					<td class="td-login"><input type="text" name="addr" value="<?php echo chkaddr(); ?>" style="width: 250%;" required /> </td>
					<td><span class="field-validity"><?php echo $addrErr;  ?></span></td>
				</tr>
				<tr>
					<td class="td-login"></td>
					<td class="td-login">
						<?php require("templates/barangay_list.php"); ?>
					</td>
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
							if (isset($_SESSION['total'])) {
								if ($_SESSION['total'] < 500) {
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
		<div style=" display: inline-block; vertical-align: top;">
			<hr>
			<p>Please make sure that you've ordered your choice of items.</p>
			<p class="red-reminders">Once checked out, the orders cannot be changed.</i></p>
			<hr>
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
				 	<td class="pbasket-td pb_num"><b>P<?php echo number_format($total, 2); ?></b></td>
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
</div>
<!-- FOOTER -->
<?php require("templates/footer.php"); ?>

<!-- SCRIPTING -->
<script src="javas.js"></script>
</body>
</html>