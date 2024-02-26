<?php 
	require("utilities/server.php");
	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Frequently Asked Questions - Candela</title>
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
	
	<!-- FAQ -->
	<div id="faq" class="padding-y-2 padding-x-3">
		<header id="faq-header">Frequently Asked Questions</header><!-- FAQs Title-->
		<hr>


		<div id="faq-body" class="row gx-lg-3 gx-0">

			<div class="col-lg-8 py-3">
				<div>
					<!-- loop through the faqs information and display them-->
					<?php 
						$faqs = array();
						$faqsList = file_get_contents('information/faqs.txt');
						$faqs = explode("\n", $faqsList);
						foreach ($faqs as $value) {
							if (substr($value, 0, 1) == "Q")
								echo '<div class="faq-subquestions">' . $value . '</div>';
							elseif (substr($value, 0, 1) == "A")
								echo '<div class="faq-answers">' . $value . '</div>';
						}
					?>
				</div>
			</div>

			<!-- FAQ SIDEBAR -->
			<div class="col-lg-4 py-3 mx-auto">
				<div id="faq-sidebar" class="sidebar-box-1">
				<hr>
					<section class="font-20 text-center fw-bold">
						 - - - Satisfied and Ready to Order? - - -<br><br>
					</section>
					<a href="product.php" class="Onow">ORDER NOW</a><br><br>
				<hr>
					<section class="font-20 text-center fw-bold">
						Questions Unanswered?
					</section>
				<span class="font-16">
					Don't hesitate to <a href="contact-us.php">Contact Us</a>.<br> We'll give you assistance.
				</span><br><br>
					<a href="contact-us.php" class="Snow">
						CONTACT US
					</a>
				<br><br><hr>
				</div>
			</div>
			<!-- END OF FAQ SIDEBAR -->
		</div>


	</div>
	<!-- END OF FAQS -->
</div>
<!-- FOOTER AND BOTTOM HEADER -->
<?php require("templates/footer.php"); ?>
<?php require("templates/nav_bottom.php"); ?>

<!-- SCRIPTING -->		
<script src="resources/js/javas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>