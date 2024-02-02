<?php
	require("utilities/server.php");
	require("utilities/process_feedback.php");
	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contact Us - Candela</title>
	<?php require("templates/head.php"); ?>
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
				<!-- NAME -->
				<span class="font-25">Name:</span>
				<span class="contact-required">(required)</span>
					<span style="color: red;">*<?= $contact_err['name']; ?></span>
				<br>
					<input type="text" name="uName" class="contact-input" value="<?= Formats::display_info('username', $contact['name']); ?>" maxlength="255">
				<br><br>
				<!-- EMAIL -->
				<span class="font-25">E-mail:</span>
				<span class="contact-required">(required)</span>
					<span style="color: red;">*<?= $contact_err['email']; ?></span>
				<br>	
					<input type="text" name="email" class="contact-input" value="<?= Formats::display_info('email', $contact['email']); ?>" maxlength="100">
				<br><br>
				<!-- CONTACT NUMBER -->
				<span class="font-25">Contact Number:</span>
				<span class="contact-required">(optional)</span>
					<span style="color: red;"><?= $contact_err['contact']; ?></span>
				<br>
					<input type="text" name="contactnum" class="contact-input" value="<?= Formats::display_info('contactnumber', $contact['contact']); ?>" maxlength="11" />
				<br><br>
				<!-- SUBJECT -->
				<span class="font-25">Subject:</span>
				<span class="contact-required">(required)</span>
					<span style="color: red;">*<?= $contact_err['subject']; ?></span>
				<br>
					<input type="text" name="subject" class="contact-input" value="<?= $contact['subject']; ?>" maxlength="255" />
				<br><br>
				<!-- COMMENT -->
				<span class="font-25">Comment:</span>
				<span class="contact-required">(required)</span>
					<span style="color: red;">*<?= $contact_err['comment']; ?></span>
				<br>	
					<textarea maxlength="2000" name="comment"><?= $contact['comment']; ?></textarea>
				<br><br>
				<!-- SUBMIT BUTTON-->
				<input type="submit" name="submit" value="Submit Now" class="Snow" />

			</form>
			<!-- END OF FORMS-->

		</div>

		<!-- SIDEBAR -->
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
		<!-- END OF SIDEBAR -->
	</div>
</div>
<!-- FOOTER -->
<?php require("templates/footer.php"); ?>

<!-- SCRIPTING -->
<script src="resources/js/javas.js"></script>
</body>
</html>