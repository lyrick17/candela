<?php require('utilities/server.php'); ?>
<?php require('utilities/process_userconn.php'); ?>
<?php 

	Restrict::user("logged");


?>
<!DOCTYPE html><html>
<head>
	<title>Sign Up at Candela</title>
	<?php require("templates/head.php"); ?>
</head>
<body>
<!-- HEADER/NAVIGATION BAR -->
<?php require("templates/nav.php"); ?>

<!-- CONTENT -->
<div id="formbg">
	<!-- MODAL CONTENT for Terms and Conditions -->
	<?php include("templates/modals/modal_terms_conditions.php"); ?>
	
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
							<input type="text" name="uName" placeholder="Enter First Name / Username" class="width-600" value="<?php echo $signup['username']; ?>" maxlength="255" />
						<br>
							<span class="field-validity"><?php echo $signup_err['username']; ?></span>
						<br>

						<label>Last Name:</label><br>
							<input type="text" name="LName" placeholder="Enter Last Name" class="width-600" value="<?php echo $signup['lastname']; ?>" maxlength="255" />
						<br>
							<span class="field-validity"><?php echo $signup_err['lastname']; ?></span>
						<br>

						<label>Email:</label><br>
							<input type="text" name="email" placeholder="Enter Email" class="width-600" value="<?php echo $signup['email']; ?>" maxlength="100" />
						<br>
							<span class="field-validity"><?php echo $signup_err['email']; ?></span>
						<br>

						<label>Contact Number:</label><em>(optional)</em><br>
							<input type="text" name="contactnum" placeholder="Must start with '09'" class="width-600" value="<?php echo $signup['contact']; ?>" maxlength="11" />
						<br>
							<span class="field-validity"><?php echo $signup_err['contact']; ?></span>
						<br>


						<label>Password:</label><br>
							<input type="password" name="psw" placeholder="Enter Password" class="width-600" />
						<br>
							<span class="field-validity"><?php echo $signup_err['psw']; ?></span>
						<br>

						<label>Confirm Password:</label><br>
							<input type="password" name="rePass" placeholder="Retype Password" class="width-600" />
						<br>
							<span class="field-validity"><?php echo $signup_err['repsw']; ?></span>
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
					
					<div class="g-recaptcha" 
						data-callback="captchafilled"
   						data-expired-callback="captchaexpired"
						data-sitekey="6Lcsa1cpAAAAAJFa7UYI6_xqJYW6PCpKYGcAp90I" required name="captcha"></div>
					<input type="hidden" name="formcaptcha" id="formcaptcha" value="">
					<span class="field-validity" id="captcha_error"><?php echo $signup_err['captcha']; ?></span>
					<br />
					<br />
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

<!-- FOOTER -->
<?php require("templates/footer.php"); ?>

<script src="javas.js"></script>
<script src="utilities/captcha_validation.js"></script>

</body>
</html>