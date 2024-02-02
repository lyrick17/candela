=<?php 
	require('utilities/server.php');
	require('utilities/process_userconn.php');
	Restrict::user("logged");
	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>
<!DOCTYPE html>
<html>
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
						<input type="hidden" name="type" value="signup" />

						<!-- FIRSTNAME -->
						<label>First Name / Username:</label><br>
						<input type="text" name="uName" placeholder="Enter First Name / Username" class="width-600" value="<?= $signup['username']; ?>" maxlength="255" />
						<br>
							<span class="field-validity"><?= $signup_err['username']; ?></span>
						<br>
						
						<!-- LASTNAME -->
						<label>Last Name:</label><br>
						<input type="text" name="LName" placeholder="Enter Last Name" class="width-600" value="<?= $signup['lastname']; ?>" maxlength="255" />
						<br>
							<span class="field-validity"><?= $signup_err['lastname']; ?></span>
						<br>
						
						<!-- EMAIL -->
						<label>Email:</label><br>
						<input type="text" name="email" placeholder="Enter Email" class="width-600" value="<?= $signup['email']; ?>" maxlength="100" />
						<br>
							<span class="field-validity"><?= $signup_err['email']; ?></span>
						<br>
						
						<!-- CONTACT NUMBER -->
						<label>Contact Number:</label><em>(optional)</em><br>
						<input type="text" name="contactnum" placeholder="Must start with '09'" class="width-600" value="<?= $signup['contact']; ?>" maxlength="11" />
						<br>
							<span class="field-validity"><?= $signup_err['contact']; ?></span>
						<br>
						
						
						<!-- PASSWORD -->
						<label>Password:</label><br>
						<input type="password" name="psw" placeholder="Enter Password" class="width-600" />
						<br>
							<span class="field-validity"><?= $signup_err['psw']; ?></span>
						<br>
						
						<!-- CONFIRM PASSWORD -->
						<label>Confirm Password:</label><br>
							<input type="password" name="rePass" placeholder="Retype Password" class="width-600" />
						<br>
							<span class="field-validity"><?= $signup_err['repsw']; ?></span>
						<br>
						<hr>

						<!-- TERMS AND CONDITIONS-->
						<div id="chkbxs">
							<input type="checkbox" name="termsConditions" id="checkme" required />
							I have agreed to the <a id="myBtn"><u>Terms and Conditions</u></a>.<br>
						</div>
						
						<div class="g-recaptcha" 
							data-callback="captchafilled"
							data-expired-callback="captchaexpired"
							data-sitekey="6Lcsa1cpAAAAAJFa7UYI6_xqJYW6PCpKYGcAp90I" name="captcha"></div>
						<input type="hidden" name="formcaptcha" id="formcaptcha" value="">
						<span class="field-validity" id="captcha_error"><?= $signup_err['captcha']; ?></span>
						<br>
						<br>

						<!-- SUBMIT BUTTON -->
						<input type="submit" name="submitfrm" value="Register" class="width-600" id="registerButton" /><br>
						
					</form>
					<!-- END OF FORM-->

				<div id="formfooter">
					Already a member? <a href="login-form.php"><u>Log in</u></a> instead.
				</div>
		</div>
		<!-- END OF signUpForm -->
	</div>
</div>
<!-- END OF CONTENT -->

<!-- FOOTER -->
<?php require("templates/footer.php"); ?>

<!--JS SCRIPTING-->
<script src="resources/js/javas.js"></script>
<script src="resources/js/captcha_validation.js"></script>

</body>
</html>