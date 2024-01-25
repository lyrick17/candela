<?php require('utilities/server.php'); ?>
<?php include("utilities/account_user_edit_info.php"); ?>
<?php 

	Restrict::user("guest");


?>

<!DOCTYPE html><html>
<head><title>Your Account - Candela</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link rel="icon" type="image/png" href="images/candelalogo.png">
  	<link rel="stylesheet" type="text/css" href="style.css">

  	<link rel='stylesheet' type='text/css' href='alertifyjs/css/alertify.css'>
  	<script type="text/javascript" src='javascript/alertify.min.js'></script>
 <script>
$(document).ready(function() {
	$("a").on('click', function(event) {
		if (this.hash !== "") {
			event.preventDefault();
			var hash = this.hash;
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 800, function() {
			window.location.hash = hash;
			});
		}
	});
});
</script>
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
	<!-- Modal content for Terms and Conditions -->
	<?php include("templates/modals/modal_terms_conditions.php"); ?>
	
	<!-- Modal content for Delete Account -->
	<?php include("templates/modals/modal_del_acc_confirmation.php"); ?>

	<div class="margin-t-90">
		<div id="product-page">
			<div id="accountnav">
				<a href="myaccount.php#accountnav">Your Account Details</a> /
				<a href="myaccount.php#checkoutHistory">Checkout History</a> /
				<a href="myaccount.php#deleteAccount">Delete Account</a>
			</div>
			<div class="acc-content">
				<div class="subacc-content">

					<!-- Form for GENERAL INFORMATION -->
					<h1><?php echo $_SESSION['username']; ?>'s Account</h1>
					<hr>
					<form method="post" action="myaccount.php">
						<input type="hidden" name="type" value="general"/>
						<table>
						<tr>
							<td class="tdacc-details">First Name:</td>
							<td class="tdacc-details"><input type="text" name="myfirstname" value="<?php echo $_SESSION['username'];?>" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?php echo $notice['firstname']; ?></span>
								<span class="field-success-myaccount"><?php echo $success['firstname']; ?></span>
							</td>
						</tr>
						<tr>
							<td class="tdacc-details">Last Name:</td>
							<td class="tdacc-details"><input type="text" name="mylastname" value="<?php echo $_SESSION['lastname'];?>" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?php echo $notice['lastname']; ?></span>
								<span class="field-success-myaccount"><?php echo $success['lastname']; ?></span>
							</td>
						</tr>
						<tr>
							<td class="tdacc-details">E-mail:</td>
							<td class="tdacc-details"><input type="text" name="myemail" value="<?php echo $_SESSION['email'];?>" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?php echo $notice['email']; ?></span>
								<span class="field-success-myaccount"><?php echo $success['email']; ?></span>
							</td>
						</tr>
						<tr>
							<td class="tdacc-details">Contact Number:</td>
							<td class="tdacc-details"><input type="text" name="mynumber" value="<?php echo $_SESSION['contactnumber'];?>" maxlength="11" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?php echo $notice['number']; ?></span>
								<span class="field-success-myaccount"><?php echo $success['number']; ?></span>
							</td>
						</tr>
						</table>
						<input type="submit" name="newchanges" value="Save Changes" class="savechanges" />
					</form><br>


					<hr>

					<!-- Form for ADDRESS UPDATE -->
					<h3>My Address</h3>
					<hr>
					<form method="post" action="myaccount.php">
						<input type="hidden" name="type" value="address"/>
						<table>
							<tr>
							<td class="tdacc-details">Current Address:</td>
							<td class="tdacc-details">
							<textarea name="myaddress" style="width: 150%;"><?php echo $_SESSION['address'];?></textarea>
						</td>
						</tr>
						<tr>
							<td class="tdacc-details"></td>
							<td class="tdacc-details">
								<input type="hidden" id="barangayvalue" value="<?= $_SESSION['barangay'] ?>" />
								<?php require("templates/barangay_list.php"); ?> Imus City, Cavite
							</td>
						</tr>
						<tr>
							<td class="tdacc-details" colspan="2" style="direction: rtl;">
								<span class="field-validity-myaccount"><?php echo $notice['address']; ?></span>
								<span class="field-success-myaccount"><?php echo $success['address']; ?></span>
							</td>
						</tr>
					</table>
						<input type="submit" name="newchanges" value="Update Address" class="savechanges" />
					
					</form>


					<hr>

					<!-- Form for PASSWORD CHANGE -->
					<p>Do You want to change your password?</p>
					
					<form method="post" id="changePass" action="myaccount.php">
						
						<input type="hidden" name="type" value="password"/>
						<table>
						<tr>
							<td class="tdacc-details" style="font-size: 90%;">Old Password:</td>
							<td class="tdacc-details"><input type="password" name="oldpassword" value="" /></td>
						</tr>
						<tr class="newpass-tr-style">
							<td class="tdacc-details">New Password:</td>
							<td class="tdacc-details"><input type="password" name="newpassword" value="" /></td>
							
						</tr>
						<tr class="confirm-tr-style">
							<td class="tdacc-details">Confirm Password:</td>
							<td class="tdacc-details"><input type="password" name="confirmpassword" value="" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?php echo $notice['password']; ?></span>
								<span class="field-success-myaccount"><?php echo $success['password']; ?></span>
							</td>
						</tr>
						</table>
						<input type="submit" name="changepassword" value="Change Password" class="savechanges" />
					</form><br>
				</div>


				<hr>

				<!-- Display the Checkout History -->
				<div id="checkoutHistory">
					<h1>My Checkout History</h1>
					<hr>
					<div id="checkoutHistory_content">
						<?php 
							$users_checkout_sql = mysqli_query($mysqli, "SELECT * FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."'");
							$users_checkout_count = mysqli_num_rows($users_checkout_sql);
							$myrow = array();
							if ($users_checkout_count >= 1) {
								while ($checkout_row = mysqli_fetch_array($users_checkout_sql)) {
									$myrow[] = $checkout_row;
								}
									foreach ($myrow as $chkinfo) {
										$users_id = $chkinfo['user_id'];
										$timestamp =  strtotime($chkinfo['checked_out']);
						?>
						<hr class="chk-hrstyle">
						<p>Ordered last: <?php echo date('m/d/Y', $timestamp); ?> , <?php echo date('l', $timestamp); ?></p>
							<table class="chk-hrstyle-table">
								<tr>
									<td class="chk-hrstyle-table-td">
										<?php if ($chkinfo['p1'] > 0) {
											$p1_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 1");
												while ($p1_row = mysqli_fetch_array($p1_sql)) {
														$p1_price = $p1_row['price'];
														$p1_name = $p1_row['pname'];
												}
										?>

										<?php echo $chkinfo['p1']; ?> <b><?php echo $p1_name; ?>/s</b> : P<?php echo $p1_price; ?><br>

										<?php }
											if ($chkinfo['p2'] > 0) {
											$p2_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 2");
												while ($p2_row = mysqli_fetch_array($p2_sql)) {
														$p2_price = $p2_row['price'];
														$p2_name = $p2_row['pname'];
												}
										?>

										<?php echo $chkinfo['p2']; ?> <b><?php echo $p2_name; ?>/s</b> : P<?php echo $p2_price; ?><br>

										<?php }
											if ($chkinfo['p3'] > 0) {
											$p3_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 3");
												while ($p3_row = mysqli_fetch_array($p3_sql)) {
														$p3_price = $p3_row['price'];
														$p3_name = $p3_row['pname'];
												}
										?>

										<?php echo $chkinfo['p3']; ?> <b><?php echo $p3_name; ?>/s</b> : P<?php echo $p3_price; ?><br>

										<?php }
											if ($chkinfo['p4'] > 0) {
											$p4_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 4");
												while ($p4_row = mysqli_fetch_array($p4_sql)) {
														$p4_price = $p4_row['price'];
														$p4_name = $p4_row['pname'];
												}
										?>

										<?php echo $chkinfo['p4']; ?> <b><?php echo $p4_name; ?>/s</b> : P<?php echo $p4_price; ?><br>

										<?php }
											if ($chkinfo['p5'] > 0) {
											$p5_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 5");
												while ($p5_row = mysqli_fetch_array($p5_sql)) {
														$p5_price = $p5_row['price'];
														$p5_name = $p5_row['pname'];
												}
										?>

										<?php echo $chkinfo['p5']; ?> <b><?php echo $p5_name; ?>/s</b> : P<?php echo $p5_price; ?><br>

										<?php }
											if ($chkinfo['p6'] > 0) {
											$p6_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 6");
												while ($p6_row = mysqli_fetch_array($p6_sql)) {
														$p6_price = $p6_row['price'];
														$p6_name = $p6_row['pname'];
												}
										?>

										<?php echo $chkinfo['p6']; ?> <b><?php echo $p6_name; ?>/s</b> : P<?php echo $p6_price; ?><br>

										<?php } ?>
									</td>
									<td class="chk-hrstyle-table-td">
										A Total of: P<?php echo $chkinfo['total']; ?>
									</td>
									<td class="chk-hrstyle-table-td">
										<span class="field-success-myaccount"><?php echo $chkinfo['delivered']; ?></span>
									</td>
									<?php if ($chkinfo['delivered'] != "") : ?>
										<td class="chk-hrstyle-table-td">
											<a href="myaccount.php?action=deletechk&id=<?php echo $chkinfo['id'] ?>" style="color:red;"> Delete Recorded Orders</span>
										</td>
									<?php endif; ?>
								</tr>
							</table>
						<?php
									} // end foreach
							} // end if 
							else { // if the user doesn't have any orders
						?>
							<p> You haven't checked out.</p>
							<a href="product.php" class="basket_buttons"><< Keep Shopping</a>
							<a href="basket.php" class="basket_buttons">Go To My Basket</a>
						<?php
							} // end else
						?>
					</div>
				</div>



						<?php
							
						?>

				<!-- Form for DELETE ACCOUNT-->
				<div id="deleteAccount">
					<hr>
					<form method="post" action="myaccount.php#deleteAccount"><!-- SOON CHANGE TO A HREF -->
						
						<input type="hidden" name="type" value="deleteaccount"/>
						<section style="padding: 15px;">
							<input type="hidden" name="confirm" id="confirm_delete_account" value="<?= $deletevalue; ?>"/>
							<span style="font-size: 90%;">Password:</span> &nbsp;
							<input type="password" name="mypassword" value="" id="myoldpass" /><br>
							<span class="field-validity-myaccount"><?php echo $notice['deleteaccount']; ?></span>

						</section>
						<input type="submit" name="deleteAcc" value="Delete Account" id="deleteacc" /><br>
					</form>
				</div>
			</div>
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
<script src="utilities/barangay_select.js"></script>
<script src="utilities/del_acc_confirmation.js"></script>
</body></html>