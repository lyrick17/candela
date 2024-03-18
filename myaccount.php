<?php 
	require('utilities/server.php');
	require("utilities/account_user_edit_info.php");
	Restrict::user("guest");
	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Your Account - Candela</title>
	<?php require("templates/head.php"); ?>
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
<?php require("templates/nav_graybar.php"); ?>
<?php require("templates/nav.php"); ?>

<!-- CONTENT -->
<div class="body-content">
	<!-- Modal content for Terms and Conditions -->
	<?php include("templates/modals/modal_terms_conditions.php"); ?>
	
	<!-- Modal content for Delete Account -->
	<?php include("templates/modals/modal_del_acc_confirmation.php"); ?>

	<div class="padding-x-2 padding-y-1">
		<div id="">
			<div id="accountnav">
				<a href="myaccount.php#accountnav">Your Account Details</a> /
				<a href="myaccount.php#checkoutHistory">Checkout History</a> /
				<a href="myaccount.php#deleteAccount">Delete Account</a>
			</div>
			<div class="p-3">
				<div>

					<!-- Form for GENERAL INFORMATION -->
					<h1><?= $_SESSION['username']; ?>'s Account</h1>
					<hr>
					<form method="post" action="myaccount.php">
						<input type="hidden" name="type" value="general"/>
						<table>
						<tr>
							<td class="tdacc-details">First Name:</td>
							<td class="tdacc-details"><input type="text" name="myfirstname" value="<?= $_SESSION['username'];?>" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?= $notice['firstname']; ?></span>
								<span class="field-success-myaccount"><?= $success['firstname']; ?></span>
							</td>
						</tr>
						<tr>
							<td class="tdacc-details">Last Name:</td>
							<td class="tdacc-details"><input type="text" name="mylastname" value="<?= $_SESSION['lastname'];?>" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?= $notice['lastname']; ?></span>
								<span class="field-success-myaccount"><?= $success['lastname']; ?></span>
							</td>
						</tr>
						<tr>
							<td class="tdacc-details">E-mail:</td>
							<td class="tdacc-details"><input type="text" name="myemail" value="<?= $_SESSION['email'];?>" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?= $notice['email']; ?></span>
								<span class="field-success-myaccount"><?= $success['email']; ?></span>
							</td>
						</tr>
						<tr>
							<td class="tdacc-details">Contact Number:</td>
							<td class="tdacc-details"><input type="text" name="mynumber" value="<?= $_SESSION['contactnumber'];?>" maxlength="11" /></td>
							<td class="tdacc-details">
								<span class="field-validity-myaccount"><?= $notice['number']; ?></span>
								<span class="field-success-myaccount"><?= $success['number']; ?></span>
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
							<textarea name="myaddress"><?= $_SESSION['address'];?></textarea>
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
								<span class="field-validity-myaccount"><?= $notice['address']; ?></span>
								<span class="field-success-myaccount"><?= $success['address']; ?></span>
							</td>
						</tr>
					</table>
						<input type="submit" name="newchanges" value="Update Address" class="savechanges" />

					</form>
<br>

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
								<span class="field-validity-myaccount"><?= $notice['password']; ?></span>
								<span class="field-success-myaccount"><?= $success['password']; ?></span>
							</td>
						</tr>
						</table>
						<input type="submit" name="changepassword" value="Change Password" class="savechanges" />
					</form><br>
				</div>


				<hr>

				<!-- Display the Checkout History -->
				<div id="checkoutHistory" class="mt-5">
					<h3>My Checkout History</h3>
					<hr>
					<a href="index.php" class="basket_buttons">Go to Checkout History</a>
				</div>

				<!-- Form for DELETE ACCOUNT-->
				<div id="deleteAccount">
					<hr>
					<form method="post" action="myaccount.php#deleteAccount"><!-- SOON CHANGE TO A HREF -->
						
						<input type="hidden" name="type" value="deleteaccount"/>
						<section style="padding: 15px;">
							<input type="hidden" name="confirm" id="confirm_delete_account" value="<?= $deletevalue; ?>"/>
							<span style="font-size: 90%;">Password:</span> &nbsp;
							<input type="password" name="mypassword" value="" id="myoldpass" /><br>
							<span class="field-validity-myaccount"><?= $notice['deleteaccount']; ?></span>

						</section>
						<input type="submit" name="deleteAcc" value="Delete Account" id="deleteacc" /><br>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- FOOTER -->
<?php require("templates/footer.php"); ?>

<!-- SCRIPTING -->
<script src="resources/js/javas.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/jquery.simplePagination.min.js" integrity="sha512-J4OD+6Nca5l8HwpKlxiZZ5iF79e9sgRGSf0GxLsL1W55HHdg48AEiKCXqvQCNtA1NOMOVrw15DXnVuPpBm2mPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="resources/js/barangay_select.js"></script>
<script src="resources/js/del_acc_confirmation.js"></script>
<script src="resources/js/checkout_history.js"></script>

</body>
</html>