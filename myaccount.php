<?php include("server.php"); ?>
<?php if (isset($_SESSION['username'])) :
	if (isset($_SESSION['address'])) {
	}
	if (isset($_SESSION['contactnumber'])) {
	}
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
<div id="myModal" class="modal">
<!-- Modal content -->
 	<div class="modal-content">
		<span class="close">&times;</span>
			 <?php echo $termsConditions; ?>
	</div>
</div>
	<div class="margin-t-90">
		<div id="product-page">
			<div id="accountnav">
				<a href="myaccount.php#accountnav">Your Account Details</a> /
				<a href="myaccount.php#checkoutHistory">Checkout History</a> /
				<a href="myaccount.php#deleteAccount">Delete Account</a>
			</div>
			<div class="acc-content">
				<div class="subacc-content">
					<h1><?php echo $_SESSION['username']; ?>'s Account</h1>
					<hr>
					<form method="post">
						<table>
						<tr>
							<td class="tdacc-details">First Name:</td>
							<td class="tdacc-details"><input type="text" name="myfirstname" value="<?php echo $_SESSION['username'];?>" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?php echo $myfirstnameNotice; ?></span>
								<span class="field-success-myaccount"><?php echo $myfirstnameSuccess; ?></span>
							</td>
						</tr>
						<tr>
							<td class="tdacc-details">Last Name:</td>
							<td class="tdacc-details"><input type="text" name="mylastname" value="<?php echo $_SESSION['lastname'];?>" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?php echo $mylastnameNotice; ?></span>
								<span class="field-success-myaccount"><?php echo $mylastnameSuccess; ?></span>
							</td>
						</tr>
						<tr>
							<td class="tdacc-details">E-mail:</td>
							<td class="tdacc-details"><input type="text" name="myemail" value="<?php echo $_SESSION['email'];?>" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?php echo $myemailNotice; ?></span>
								<span class="field-success-myaccount"><?php echo $myemailSuccess; ?></span>
							</td>
						</tr>
						<tr>
							<td class="tdacc-details">Contact Number:</td>
							<td class="tdacc-details"><input type="text" name="mynumber" value="<?php echo $_SESSION['contactnumber'];?>" maxlength="11" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?php echo $mynumberNotice; ?></span>
								<span class="field-success-myaccount"><?php echo $mynumberSuccess; ?></span>
							</td>
						</tr>
						<tr>
							<td class="tdacc-details">Address:</td>
							<td class="tdacc-details"><input type="text" name="myaddress" value="<?php if (isset($_SESSION['address'])) { echo $_SESSION['address']; } ?>" style="width: 250%;" /></td>
						</tr>
						<tr>
							<td class="tdacc-details" colspan="2" style="direction: rtl;">
								<span class="field-validity-myaccount"><?php echo $myaddressNotice; ?></span>
								<span class="field-success-myaccount"><?php echo $myaddressSuccess; ?></span>
							</td>
						</tr>
						</table>
						<input type="submit" name="newchanges" value="Save Changes" class="savechanges" />
					</form><br>
					<hr>
					<p>Do You want to change your password?</p>
					<form method="post" id="changePass" action="myaccount.php#changePass">
						<table>
						<tr>
							<td class="tdacc-details" style="font-size: 90%;">Old Password:</td>
							<td class="tdacc-details"><input type="password" name="oldpassword" value="" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?php echo $oldpasswordErr; ?></span>
							</td>
						</tr>
						<tr class="newpass-tr-style">
							<td class="tdacc-details">New Password:</td>
							<td class="tdacc-details"><input type="password" name="newpassword" value="" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?php echo $newpasswordErr; ?></span>
								<span class="field-success-myaccount"><?php echo $newpasswordSuccess; ?></span>
							</td>
						</tr>
						<tr class="confirm-tr-style">
							<td class="tdacc-details">Confirm Password:</td>
							<td class="tdacc-details"><input type="password" name="confirmpassword" value="" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?php echo $confirmpasswordErr; ?></span>
							</td>
						</tr>
						</table>
						<input type="submit" name="changepassword" value="Change Password" class="savechanges" />
					</form><br>
				</div>
				<hr>
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
								$del_process = "";
							if (isset($_POST['deleteAcc'])) {
								if (!empty($_POST['mypassword'])) {
									$mypass = sha1($_POST['mypassword']);
									$del_pass_match_sql = mysqli_query($mysqli,"SELECT Password FROM `users` WHERE Username = '". $_SESSION['username'] ."' AND id = '". $_SESSION['id'] ."'") or die("Failed to Get User's Information");
									$verify_order_sql = mysqli_query($mysqli,"SELECT * FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."' AND delivered = '' ") or die("Failed to Get User's Information");
									$chk_count = mysqli_num_rows($verify_order_sql);
									while ($pass_match = mysqli_fetch_array($del_pass_match_sql)) {
										$savedpass = $pass_match['Password'];
									}
									if ($chk_count > 0) {
										$del_process = "
											<style>
												#cant_delete {
													padding: 10px;
													font-size: 15px;
													color: red;
												}
											</style>
											<section id='cant_delete'>You cannot delete your account with order on process</section>";
									} else {
										if ($mypass == $savedpass) {
								
								$del_process = "
									<style>
										section#delete_warning {
											padding: 10px;
											font-size: 15px;
											color: black;
										}
										#input_yes {
											padding: 5px 20px;
											border-style:solid;
											border-width: 1px;
											border-color: #0078d4;
											border-radius: 6px;
											background-color: #0078d4;
											color: white;
											font-size: 15px;
										}
										#input_yes:hover {
											border-color: #0791fb;
											background-color: #0791fb;
									}
										#input_cancel {
											font-size: 15px;
											padding: 5px 20px;
										}
									</style>
									<section style='padding: 10px; font-size: 15px; color:black;'>
										<p>Are you sure to <b>delete your account?</b> This would delete all your data.</p>
										<input type='submit' id='input_yes' name='Sure' value='Yes' /> | 
										<input type='submit' name='Nope' value='Cancel' />
									</section>";
											if (isset($_POST['Sure'])) {
												$delete_user_acc = mysqli_query($mysqli, "DELETE FROM users WHERE id = '". $_SESSION['id'] ."'") or die("Unable to delete information");
												$delete_user_bas = mysqli_query($mysqli, "DELETE FROM basket_items WHERE user_id = '". $_SESSION['id'] ."'") or die("Unable to delete basket");
												$delete_user_chk = mysqli_query($mysqli, "DELETE FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."' AND delivered = 'Delivered' ") or die("Unable to delete orders");
												echo "<script> alert('We're Sorry To See You Go.'); </script>";
												unset($_SESSION['username']);
												unset($_SESSION['id']);
												session_destroy();
												header("location: index.php");
											} elseif (isset($_POST['Nope'])) {
												unset($_POST['deleteAcc']);
												header("location: myaccount.php");
											}
										} else {
											$del_oldpasswordErr = "That is not your password";
										}
									}
								} else {
									$del_oldpasswordErr = "Please Enter Your Password";
								}
							}
						?>
				<div align="right" id="deleteAccount">
					<hr>
					<form method="post" action="myaccount.php#deleteAccount"><!-- SOON CHANGE TO A HREF -->
						<section style="padding: 15px;">
							
							<span class="field-validity-myaccount"><?php echo $del_oldpasswordErr; ?></span>
							<span style="font-size: 90%;">Password:</span> &nbsp;
							<input type="password" name="mypassword" value="" id="myoldpass" /><br>

						</section>
					<input type="submit" name="deleteAcc" value="Delete Account" id="deleteacc" /><br>
					<?php echo $del_process; ?>
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
</body></html>





<?php else : ?> <!-- if the customer entered the page without an account -->





<!DOCTYPE html><html>
<head><title>Your Account - Candela</title>
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
				<li><a href="#"><?php echo $_SESSION['username'];?>'s Account</a></li>
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
	<div id="basket-box">
		<div id="basket-header">
			Ooops! Looks like you're not logged in yet visiting one's account page.
		</div>
			<hr>
		<div style="font-size: 130%;">
			<p>Do you want to log in your account?</p>
			<p><a href="login-form.php" class="blue_button">Log In Now</a></p>
			<p style="font-size: 60%;">First Time in Candela?<a href="signup-form.php">Sign Up</a> instead.</p>

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
<?php endif; ?>