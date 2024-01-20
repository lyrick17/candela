<?php include('utilities/process_userconn.php'); ?>

<!DOCTYPE html><html>
<head><title>Sign Up at Candela</title>
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
<div id="header" class="sticky">
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
<div id="formbg">
	<div class="text-center">
		<div id="signUpForm">
			<p id="create-account-header">
				Create An Account at Candela
			</p>
			<p class="text-center">Please fill up the form to register.</p>
					<!--FORM-->
					<form method="post" action="signup-form.php#signUpForm" id="formstyle">

						<?php
							if (!isset($_SESSION['id'])) {
						?>
							<input type="hidden" name="type" value="signup" />

						<label>First Name / Username:</label><br>
							<input type="text" name="uName" placeholder="Enter First Name / Username" class="width-600" value="<?php echo $signup['username']; ?>" />
						<br>
							<span class="field-validity"><?php echo $uNameErr; ?></span>
						<br>

						<label>Last Name:</label><br>
							<input type="text" name="LName" placeholder="Enter Last Name" class="width-600" value="<?php echo $signup['lastname']; ?>" />
						<br>
							<span class="field-validity"><?php echo $LNameErr; ?></span>
						<br>

						<label>Email:</label><br>
							<input type="text" name="email" placeholder="Enter Email" class="width-600" value="<?php echo $signup['email']; ?>" />
						<br>
							<span class="field-validity"><?php echo $emailErr; ?></span>
						<br>

						<label>Contact Number:</label><em>(optional)</em><br>
							<input type="text" name="contactnum" placeholder="Must start with '09'" class="width-600" value="<?php echo $signup['contact']; ?>" maxlength="11" />
						<br>
							<span class="field-validity"><?php echo $contactnumErr; ?></span>
						<br>


						<label>Password:</label><br>
							<input type="password" name="psw" placeholder="Enter Password" class="width-600" />
						<br>
							<span class="field-validity"><?php echo $pswErr; ?></span>
						<br>

						<label>Confirm Password:</label><br>
							<input type="password" name="rePass" placeholder="Retype Password" class="width-600" />
						<br>
							<span class="field-validity"><?php echo $repswErr; ?></span>
						<br>
						<?php
							}
						?>
						<hr>
					<div id="chkbxs">
						<input type="checkbox" name="termsConditions" id="checkme" required />
							I have agreed to the <a id="myBtn"><u>Terms and Conditions</u></a>.<br>
							<div id="myModal" class="modal">
							  <!-- Modal content -->
 								<div class="modal-content">
							    	<span class="close">&times;</span>
									   	<?php include("templates/terms_conditions.php"); ?>
								</div>
							</div>
					</div>
					<div id="captchadiv">
						<!--<label style="font-weight: normal;"><b>Captcha:</b> Are You Human?</label><br>
					
						<input type="hidden" name="no1" value="">
						<input type="hidden" name="no2" value="">
							<input type="number" name="captcha" required /><br>
							<span class="field-validity">
							</span>
						-->
					</div>
						<?php if (!isset($_SESSION['id'])) {
						?>
							<input type="submit" name="submitfrm" value="Register" class="width-600" id="registerButton" /><br>
						<?php
							}
						?>
					</form><!-- END OF FORM-->

				<div id="formfooter">
					Already a member? <a href="login-form.php"><u>Log in</u></a> instead.
				</div>
		</div>
	</div><!-- signUpForm -->
</div><!--Background Image-->
<!--JS SCRIPTING-->
<script>
/*var checkBoxes = $('#checkme');
checkBoxes.change(function () {
		$('#registerButton').prop('disabled', checkBoxes.filter(':checked').length < 1);
        });
checkBoxes.change();*/
/*function registerCondition() {
	var terms = document.getElementById('checkme');
	var submitfrm = document.getElementById('registerButton');
	if (!terms.checked()) {
		submitfrm.style.backgroundColor = "#aeaeae";
		submitfrm.style.color = "#fff";
		}
	}*/
</script>
<!-- FOOTER -->
<div class="footer">
	&copy; 2018 Candela, All Rights Reserved 
	<span>
		<a href="about.php" class="fnav">About Candela</a> | 
		<a href="contact-us.php" class="fnav">Contact Us</a>
		<!--<a id="myBtn">Terms and Conditions</a>-->
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
<script src="javas.js">
</script>
</body></html>