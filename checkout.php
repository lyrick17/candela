<?php include("server.php"); ?>
<!DOCTYPE html><html>
<head><title>Checkout - Candela</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" type="image/png" href="images/candelalogo.png">
</head>
<body>
<!-- HEADER/NAVIGATION BAR -->
	<nav class="navbar navbar-default">
	<div class="container-fluid">
		<ul class="nav navbar-nav left">
			<li>0971-697-0022</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<?php if (isset($_SESSION['username'])): ?>
				<li><a href="myaccount.php"><?php echo $_SESSION['username'];?>'s Account</a></li>
				<li><a href="logout.php">Log Out</a></li>
			<?php else: ?>
				<li><a href="login-form.php">Log In</a></li>
				<li><a href="signup-form.php">Create An Account</a></li>
			<?php endif ?>
		</ul>
	</div>
</nav>
<div id="header">
	<div id="business-name">
		<a href="index.php"><img src="images/candela.png" alt="Candela" /></a>
	</div>

	<div class="navig-prov">
		<div class="navi">
			<a href="product.php">Product</a>
		</div>
		<div class="navi">
			<a href="faqs.php">FAQs</a>
		</div>
		<div class="navi">
			<a href="about.php">About</a>
		</div>
		<div class="navi">				
			<a href="contact-us.php">Contact Us</a>
		</div>
	</div>

	<div id="nav-basket">
		<a href="basket.php" onmouseover="document.images.basketimg.src = 'images/basket-hover.png'" onmouseout="document.images.basketimg.src='images/basket.png'"><img src="images/basket.png" name="basketimg" height="17px"> Basket</a>
	</div>
</div>
<!-- CONTENT -->
<div class="body-content">
<div id="myModal" class="modal">
<!-- Modal content -->
 	<div class="modal-content">
		<span class="close">&times;</span>
			 <?php echo $termsConditions; ?>
	</div>
</div>
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
<div class="footer">
	&copy; 2018 Candela, All Rights Reserved 
	<span>
		<a href="about.php" class="fnav">About Candela</a> | 
		<a href="contact-us.php" class="fnav">Contact Us</a> |
		<a id="myBtn">Terms and Conditions</a>
	</span><br />
		
	Bricklane Fake Subdivision Medicion II-E Block 90 Lot 1 Imus City, Cavite
		&nbsp;&nbsp;:&nbsp;&nbsp; <i>0971-697-0022</i>
	<span>
		<i>Exclusively available at Imus City Only</i>&nbsp;&nbsp;&nbsp;
		<a href="https://www.instagram.com/"><img src="images/instagramlogo.png" class="fsocial-acc"></a>&nbsp;&nbsp;&nbsp;
		<a href="https://twitter.com/"><img src="images/twitter-logo.png" class="fsocial-acc"></a>&nbsp;&nbsp;&nbsp;
		<a href="https://www.facebook.com/"><img src="images/facebooklogo.png" class="fsocial-acc"></a>&nbsp;&nbsp;&nbsp;
	</span>
</div>
<!-- SCRIPTING -->
<script src="javas.js"></script>
</body></html>