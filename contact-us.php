<?php require("utilities/server.php"); ?>
<?php include("utilities/process_feedback.php"); ?>
<?php
	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contact Us - Candela</title>
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
	<!-- MODAL CONTENT for Terms and Conditions -->
	<?php include("templates/modals/modal_terms_conditions.php"); ?>


	<div id="contactPic">
		<div class="arrowDown">
			<a href="#contact-form" onmouseover="document.images.arrow.src = 'images/arrow-down-white.png'" onmouseout="document.images.arrow.src='images/arrow-down.png'"><img src="images/arrow-down.png" name="arrow" ></a>
		</div>
	</div>
	<div id="contact-form">
		<div style="display: inline-block; padding-right: 10%;">
		<!-- FORM CONTACT-US -->
			<form method="post" action="contact-us.php#contact-form">
			<span class="font-25">Name:</span>
				<span class="contact-required">(required)</span>
					<span style="color: red;">*<?php echo $contact_err['name']; ?></span>
				<br>
					<input type="text" name="uName" class="contact-input" value="<?php if(isset($_SESSION['username'])){
							echo $_SESSION['username'];} else {
							echo $contact['name'];
							} ?>" maxlength="255">
				<br><br>
			<span class="font-25">E-mail:</span>
				<span class="contact-required">(required)</span>
					<span style="color: red;">*<?php echo $contact_err['email']; ?></span>
				<br>	
					<input type="text" name="email" class="contact-input" value="<?php if(isset($_SESSION['email'])){
							echo $_SESSION['email'];} else {
							echo $contact['email'];
							} ?>" maxlength="100">
				<br><br>
			<span class="font-25">Contact Number:</span>
				<span class="contact-required">(optional)</span>
					<span style="color: red;"><?php echo $contact_err['contact']; ?></span>
				<br>
					<input type="text" name="contactnum" class="contact-input" value="<?php if(isset($_SESSION['contactnumber'])){
							echo $_SESSION['contactnumber'];} else {
							echo $contact['contact'];
							} ?>" maxlength="11" />
				<br><br>
			
			<span class="font-25">Subject:</span>
				<span class="contact-required">(required)</span>
					<span style="color: red;">*<?php echo $contact_err['subject']; ?></span>
				<br>
					<input type="text" name="subject" class="contact-input" value="<?php echo $contact['subject']; ?>" maxlength="255" />
				<br><br>

			<span class="font-25">Comment:</span>
				<span class="contact-required">(required)</span>
					<span style="color: red;">*<?php echo $contact_err['comment']; ?></span>
				<br>	
					<textarea maxlength="2000" name="comment"><?php echo $contact['comment']; ?></textarea>
				<br><br>
			
			<input type="submit" name="submit" value="Submit Now" class="Snow" />

			</form><!-- END OF FORMS-->

		</div>
		<div id="contact-sidebar">
			<div id="csidebar-1">
				<hr>
				<h2>- Ask Us -</h2>
				<p>If you still have questions unanswered, we would like to hear it from you. We want you to keep in touch in us.</p>
				<hr>
				<h2>- Give A Feedback -</h2>
				<p>Any feedback we receive is highly appreciated. We would love to hear it from you!</p>
				<hr>
			</div>
			<div id="csidebar-2">
				<span class="more-info">Call or Text us at:</span><br>
				<i>0971-697-0022</i><br><br>
				<span class="more-info">E-mail us at:</span><br>
				candela.foodcandle@gmail.com
			</div>
		</div>
	</div>
</div>
<!-- FOOTER -->
<?php require("templates/footer.php"); ?>

<!-- SCRIPTING -->
<script src="javas.js"></script>
</body>
</html>