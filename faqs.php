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
	<div id="divisions-faq">
		<header id="Header-FAQs">Frequently Asked Questions</header><!-- FAQs Title-->
		<div id="faq-body">
			<hr>
			<div id="faq-questions">
				<!-- loop through the faqs information and display them-->
				<?php 
					$faqs = array();
					$faqsList = file_get_contents('information/faqs.txt');
					$faqs = explode("\n", $faqsList);
					foreach ($faqs as $value) {
						if (substr($value, 0, 1) == "Q")
							echo '<div class="faq-subquestions">' . substr($value, 3) . '</div>';
						elseif (substr($value, 0, 1) == "A")
							echo '<div class="faq-answers">' . substr($value, 3) . '</div>';
					}
				?>

			</div>

			<!-- FAQ SIDEBAR -->
			<div id="faq-sidebar">
				<hr>
					<section id="faq-sidebar-sec1">
						 - - - Satisfied and Ready to Order? - - -<br><br>
					</section>
					<a href="product.php" class="Onow">ORDER NOW</a><br><br>
				<hr>
					<section id="faq-sidebar-sec2">
						Questions Unanswered?
					</section>
				<span>
					Don't hesitate to <a href="contact-us.php">Contact Us</a>.<br> We'll give you assistance.
				</span><br><br>
					<a href="contact-us.php" class="Snow">
						CONTACT US
					</a>
				<br><br><hr>
			</div>
			<!-- END OF FAQ SIDEBAR -->
		</div>
	</div>
	<!-- END OF FAQS -->
</div>
<!-- FOOTER -->
<?php require("templates/footer.php"); ?>

<!-- SCRIPTING -->		
<script src="resources/js/javas.js"></script>
</body>
</html>