<?php require('utilities/server.php'); ?>
<?php require('utilities/process_userconn.php'); ?>
<?php 

	Restrict::user("logged");


?>
<!DOCTYPE html><html>
<head>
	<title>Log in at Candela</title>
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
				<p id="create-account-header">Log In to Candela</p>
				<form method="post" action="login-form.php" id="formstyle">
					<p style="color: red;">
						<?php echo $inputErr; ?>
					</p>
					<input type="hidden" name="type" value="login" />

						<label>Email:</label>
						<br>
						<?php 
							if (!isset($_SESSION['id'])) {
						?>
							<input type="text" name="loginName" placeholder="Enter Email" class="width-600" value="<?php echo $username; ?>" />
						<?php
							}
						?>
						<br>
						<br>

						<label>Password:</label><br>
						<?php 
							if (!isset($_SESSION['id'])) {
						?>
							<input type="password" name="loginPass" placeholder="Enter Password" class="width-600" />
						<?php
							}
						?>
						<br>
						<br>
						<?php
							if (!isset($_SESSION['id'])) {
						?>
							<input type="submit" name="login_submit" value="Log In" class="width-600" id="registerButton" />
						<?php
							}
						?>
				</form>

				<div id="formfooter">
						First time in Candela? <a href="signup-form.php"><u>Register</u></a> now.
					</div>
			</div>
		</div><!-- signUpForm -->
</div><!--Background Image-->

<!-- FOOTER -->
<?php require("templates/footer.php"); ?>
</body>
</html>