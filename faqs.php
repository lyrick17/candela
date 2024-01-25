<?php include("server.php"); ?>
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
				<div class="faq-subquestions">
					What does Candela offer<b>?</b>
				</div>
					<div class="faq-answers">
						- Candela offers unique style of candles with endearing scent and food designs.
					</div>
				<div class="faq-subquestions">
					How long does it take to deliver the product<b>?</b>
				</div>
					<div class="faq-answers">
						- Your orders are scheduled to deliver every Friday of the week, disregarding the day when you order your items.
					</div>
				<div class="faq-subquestions">
					Could I order here outside Imus City<b>?</b>
				</div>
					<div class="faq-answers">
						- As a starting business, Candela only delivers products around Imus City, Philippines only.
					</div>
				<div class="faq-subquestions">
					Can I order only one product<b>?</b>
				</div>
					<div class="faq-answers">
						- Unfortunately, minimum of P500.00 should be ordered before the check out.
					</div>
				<div class="faq-subquestions">
					Why do my previous orders are gone when I signed-up to have an account<b>?</b>
				</div>
					<div class="faq-answers">
						- It is included in our Terms and Conditions that all orders before registering an account will be lost. We're sorry for your inconvenience.<br>
						Also, orders before logging in will be deleted, provided that you already have an account.
					</div>
				<div class="faq-subquestions">
					What if I don't want to have an account when I want to order<b>?</b>
				</div>
					<div class="faq-answers">
						- You can order and choose Guest Check Out option, providing the Name, Email and Address after reading the Terms and Conditions.
					</div>
				<div class="faq-subquestions">
					Can I cancel the product I've checked out<b>?</b>
				</div>
					<div class="faq-answers">
						- Unfortunately, you have to make sure what details you're entering, for you cannot cancel the order that's been checked out.
					</div>

			</div>
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
	</div><!-- Questions-->
	</div><!-- Body -->
</div>
<!-- FOOTER -->
<?php require("templates/footer.php"); ?>

<!-- SCRIPTING -->		
<script src="javas.js"></script>
</body>
</html>