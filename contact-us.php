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


	<div>
		<img src="images/contact-us-pic.png" class="img-fluid w-100" alt="Contact Us">
	</div>

	<div id="contact-form" class="padding-x-3 padding-y-1">
		<div class="row gx-0">
			<div class="col-lg-6 py-2">
				<div class="pe-lg-5">
				<!-- FORM CONTACT-US -->
				<form method="post" action="contact-us.php#contact-form">
					<!-- NAME -->
					<span class="font-25 fw-bold">Name:</span>
					<span class="fst-italic">(required)</span>
						<span class="text-danger">*<?= $contact_err['name']; ?></span>
					<br>
						<input type="text" name="uName" class="contact-input" value="<?= Formats::display_info('username', $contact['name']); ?>" maxlength="255">
					<br><br>
					<!-- EMAIL -->
					<span class="font-25 fw-bold">E-mail:</span>
					<span class="fst-italic">(required)</span>
						<span class="text-danger">*<?= $contact_err['email']; ?></span>
					<br>	
						<input type="text" name="email" class="contact-input" value="<?= Formats::display_info('email', $contact['email']); ?>" maxlength="100">
					<br><br>
					<!-- CONTACT NUMBER -->
					<span class="font-25 fw-bold">Contact Number:</span>
					<span class="fst-italic">(optional)</span>
						<span class="text-danger"><?= $contact_err['contact']; ?></span>
					<br>
						<input type="text" name="contactnum" class="contact-input" value="<?= Formats::display_info('contactnumber', $contact['contact']); ?>" maxlength="11" />
					<br><br>
					<!-- SUBJECT -->
					<span class="font-25 fw-bold">Subject:</span>
					<span class="fst-italic">(required)</span>
						<span class="text-danger">*<?= $contact_err['subject']; ?></span>
					<br>
						<input type="text" name="subject" class="contact-input" value="<?= $contact['subject']; ?>" maxlength="255" />
					<br><br>
					<!-- COMMENT -->
					<span class="font-25 fw-bold">Comment:</span>
					<span class="fst-italic">(required)</span>
						<span class="text-danger">*<?= $contact_err['comment']; ?></span>
					<br>	
						<textarea maxlength="2000" name="comment"><?= $contact['comment']; ?></textarea>
					<br><br>
					<!-- SUBMIT BUTTON-->
					<div class="text-center">
						<input type="submit" name="submit" value="Submit Now" class="Snow" />
					</div>

				</form>
				<!-- END OF FORMS-->
				</div>

			</div>

			<div class="col-lg-6 px-4 py-2">
				<!-- SIDEBAR -->
				<div id="contact-sidebar" class="w-100 text-center">
					<div id="csidebar-1">

						<hr>

						<h2>- Ask Us -</h2>
						<p>If you still have questions unanswered, we would like to hear it from you. We want you to keep in touch in us.</p>
						
						<hr>

						<h2>- Give A Feedback -</h2>
						<p>Any feedback we receive is highly appreciated. We would love to hear it from you!</p>
						
						<hr>
					
					</div>
					<div id="csidebar-2" class="sidebar-box-2">
						
						<span class="font-25 fw-bold">Call or Text us at:</span><br>
						<i>0971-697-0022</i><br><br>
						<span class="font-25 fw-bold">E-mail us at:</span><br>
						candela.foodcandle@gmail.com
					</div>
				</div>
				<!-- END OF SIDEBAR -->
			</div>
		</div>

		
	</div>
</div>
<!-- FOOTER AND BOTTOM HEADER -->
<?php require("templates/footer.php"); ?>
<?php require("templates/nav_bottom.php"); ?>

<!-- SCRIPTING -->		
<script src="resources/js/javas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>