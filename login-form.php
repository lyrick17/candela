<?php 
	require('utilities/server.php');
	require('utilities/process_userconn.php');
	Restrict::user("logged");
	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>
<!DOCTYPE html>
<html>
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

		<div class="text-center" style="height: 100vh;">
			<div id="signUpForm" class="d-inline-flex flex-column justify-content-center">
				<p id="create-account-header" class="font-25">Log In to Candela</p>

				<form method="post" action="login-form.php" id="formstyle" class="text-start pb-4 px-2">
					<p class="text-danger"> <?php echo $inputErr; ?> </p>
					<input type="hidden" name="type" value="login" />

					<!-- EMAIL -->
					<label>Email:</label><br>
					<input type="text" name="loginName" placeholder="Enter Email" class="login-text-width" value="<?php echo $username; ?>" />
					<br>
					
					<br>

					<!-- PASSWORD -->
					<label>Password:</label><br>
					<input type="password" name="loginPass" placeholder="Enter Password" class="login-text-width" />
					<br>
					
					<br>
					
					<!-- SUBMIT BUTTON -->
					<input type="submit" name="login_submit" value="Log In" class="login-text-width" id="registerButton" />
				</form>

				<div id="formfooter">
						First time in Candela? <a href="signup-form.php"><u>Register</u></a> now.
				</div>
			</div>
			<!-- END OF signUpForm -->
		</div>  
</div>
<!-- END OF CONTENT -->

<!-- FOOTER AND BOTTOM HEADER -->
<?php require("templates/footer.php"); ?>
<?php require("templates/nav_bottom.php"); ?>

<!-- SCRIPTING -->		
<script src="resources/js/javas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>