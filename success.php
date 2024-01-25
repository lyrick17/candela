<?php include("server.php"); ?>
<?php
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['total']) :
	$check_order = "SELECT * FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."' AND total = '". $_SESSION['total'] ."'";
	if (mysqli_query($mysqli, $check_order)) :

?>

<!DOCTYPE html>
<html>
<head>
	<title>Your Basket - Candela</title>
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

	<div style="padding: 20px; margin: 90px 20px 10px 20px;">
		<div style="text-align: center;">
			<div id="basket-header">
				- Thank You for Choosing Us -
			</div>
			<div style="font-size: 120%;">
				<hr>
				<?php 
				if (isset($_SESSION['username'])) {
					$user_order_sql = mysqli_query($mysqli, "SELECT * FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."'");
				} else {
					$user_order_sql = mysqli_query($mysqli, "SELECT * FROM checkout_orders WHERE firstname = '". $_SESSION['fName'] ."' AND address = '". $_SESSION['chkaddr'] ."'");
				}
					while ($checkout_row = mysqli_fetch_array($user_order_sql)) {
						$p1 = $checkout_row['p1'];
						$p2 = $checkout_row['p2'];
						$p3 = $checkout_row['p3'];
						$p4 = $checkout_row['p4'];
						$p5 = $checkout_row['p5'];
						$p6 = $checkout_row['p6'];
						$total_cost = $checkout_row['total'];
						$users_addr = $checkout_row['address'];
						$users_contact = $checkout_row['contact_number'];
					}
					if ($users_addr == "") {
						$youraddress = mysqli_query($mysqli, "SELECT Address FROM users WHERE id = '". $_SESSION['id'] ."' AND Username = '". $_SESSION['username'] ."'");
						while ($myaddr = mysqli_fetch_array($youraddress)) {
							$users_addr = $myaddr['Address'];
						}
					}
					if ($users_contact == "") {
						$yournumber = mysqli_query($mysqli, "SELECT ContactNumber FROM users WHERE id = '". $_SESSION['id'] ."' AND Username = '". $_SESSION['username'] ."'");
						while ($mynum = mysqli_fetch_array($yournumber)) {
							$users_contact = $mynum['ContactNumber'];
						}
					}
				?>
				<p>You've successfully ordered:</p>
				<p style="font-size: 150%;">
					<?php 
					$p1_name = $p2_name = $p3_name = $p4_name = $p5_name = $p6_name = "";
					$p1_price = $p2_price = $p3_price = $p4_price = $p5_price = $p6_price = "";

					if ($p1 > 0) :
						$p1_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 1");
						while ($p1_row = mysqli_fetch_array($p1_sql)) {
							$p1_price = $p1_row['price'];
							$p1_name = $p1_row['pname'];
						}
						$p1total = $p1 * $p1_price;
					?>
						<?php echo $p1; ?> <b><?php echo $p1_name; ?>/s</b> : P<?php echo $p1total; ?><br>
					<?php
					endif; // p1
					if ($p2 > 0) :
						$p2_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 2");
						while ($p2_row = mysqli_fetch_array($p2_sql)) {
							$p2_price = $p2_row['price'];
							$p2_name = $p2_row['pname'];
						}
						$p2total = $p2 * $p2_price;
					?>
						<?php echo $p2; ?> <b><?php echo $p2_name; ?>/s</b> : P<?php echo $p2total; ?><br>
					<?php
					endif; // p2
					if ($p3 > 0) :
						$p3_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 3");
						while ($p3_row = mysqli_fetch_array($p3_sql)) {
							$p3_price = $p3_row['price'];
							$p3_name = $p3_row['pname'];
						}
						$p3total = $p3 * $p3_price;
					?>
						<?php echo $p3; ?> <b><?php echo $p3_name; ?>/s</b> : P<?php echo $p3total; ?><br>
					<?php
					endif; // p3
					if ($p4 > 0) :
						$p4_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 4");
						while ($p4_row = mysqli_fetch_array($p4_sql)) {
							$p4_price = $p4_row['price'];
							$p4_name = $p4_row['pname'];
						}
						$p4total = $p4 * $p4_price;
					?>
						<?php echo $p4; ?> <b><?php echo $p4_name; ?>/s</b> : P<?php echo $p4total; ?><br>
					<?php
					endif; // p4
					if ($p5 > 0) :
						$p5_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 5");
						while ($p5_row = mysqli_fetch_array($p5_sql)) {
							$p5_price = $p5_row['price'];
							$p5_name = $p5_row['pname'];
						}
						$p5total = $p5 * $p5_price;
					?>
						<?php echo $p5; ?> <b><?php echo $p5_name; ?>/s</b> : P<?php echo $p5total; ?><br>
					<?php
					endif; // p5
					if ($p6 > 0) :
						$p6_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 6");
						while ($p6_row = mysqli_fetch_array($p6_sql)) {
							$p6_price = $p6_row['price'];
							$p6_name = $p6_row['pname'];
						}
						$p6total = $p6 * $p6_price;
					?>
						<?php echo $p6; ?> <b><?php echo $p6_name; ?>/s</b> : P<?php echo $p6total; ?><br>	
					<?php
					endif; // p6
					?>
				</p>
				<p>For a total of:</p>
				<p style="font-size: 150%;">
					P<?php echo $total_cost; ?>
				</p>
				<p>To be delivered at:</p>
				<p style="font-size: 150%;">
					<?php echo $users_addr; ?><br>
					<span style="font-size: medium;">Imus City, Cavite</span>
				</p>

				<hr>

				<p style="font-size: 20px;">Thank You for choosing Candela! Your order will now be delivered in <b>the upcoming Friday</b> of the week.</p>
				<hr><br>
				<p>Would you rather give us a feedback? We would love to hear it from you!</p>
				<br><a href="contact-us.php" class="lend_feedback">Lend A Feedback</a>
				<div style="padding: 30px 0;">

					<hr>
				<?php if (isset($_SESSION['username'])) {
						if (!isset($_SESSION['address'])) { ?>
					<p class="changed-addr-num">You have now entered your <b>address</b>, would you like to save it on your account?</p>
					<p><i>Your new address is :</i> &nbsp;&nbsp;<?php echo $users_addr; ?></p>
					<form method="post" id="addr_save" action="success.php">
						<input type="submit" name="addr_yes" value="Yes, I would love to!" />
						<span class="dismiss-request">Dismiss if you don't want to.</span>
					</form>
					<?php } else {
								if ($_SESSION['address'] != $users_addr) {
					?>
					<p class="changed-addr-num">It seems like you've changed your <b>address</b>. Would you like to change your previous one?</p>
					<p><i>Your old address is :</i> &nbsp;&nbsp;<?php echo $_SESSION['address']; ?></p>
					<p><i>Your new address is :</i> &nbsp;&nbsp;<?php echo $users_addr; ?></p>
					<form method="post" id="addr_save" action="success.php">
						<input type="submit" name="addr_change_yes" value="Yes, I would love to!" />
						<span class="dismiss-request">Dismiss if you don't want to.</span>
					</form>
					<?php		}
						}
					 ?>

					<hr>

					<?php 
						if (!isset($_SESSION['contactnumber'])) { ?>
					<p class="changed-addr-num">You have now entered your <b>contact number</b>, would you like to save it on your account?</p>
					<p><i>Your new address is :</i> &nbsp;&nbsp;<?php echo $users_contact; ?></p>
					<form method="post" id="addr_save" action="success.php">
						<input type="submit" name="contactnum_yes" value="Yes, I would love to!" />
						<span class="dismiss-request">Dismiss if you don't want to.</span>
					</form>
					<?php } elseif ($_SESSION['contactnumber'] == "") {
					?>
					<p class="changed-addr-num">You have now entered your <b>contact number</b>, would you like to save it on your account?</p>
					<p><i>Your new address is :</i> &nbsp;&nbsp;<?php echo $users_contact; ?></p>
					<form method="post" id="addr_save" action="success.php">
						<input type="submit" name="contactnum_yes" value="Yes, I would love to!" />
						<span class="dismiss-request">Dismiss if you don't want to.</span>
					</form>
					<?php
							} else {

								if ($_SESSION['contactnumber'] != $users_contact) {
					?>
					<p class="changed-addr-num">It seems like you've changed your <b>contact number</b>. Would you like to change your previous one?</p>
					<p><i>Your old address is :</i> &nbsp;&nbsp;<?php echo $_SESSION['contactnumber']; ?></p>
					<p><i>Your new address is :</i> &nbsp;&nbsp;<?php echo $users_contact; ?></p>
					<form method="post" id="addr_save" action="success.php">
						<input type="submit" name="contactnum_change_yes" value="Yes, I would love to!" />
						<span class="dismiss-request">Dismiss if you don't want to.</span>
					</form>
					<?php 		}
						}
					?>
					<?php } //end if ?>
				<div style="margin-top: 50px;">
					<a href="index.php" class="lend_feedback"><< Home</a>
					<a href="myaccount.php" class="lend_feedback">My Account</a>
				</div>

				</div>
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





<?php
	endif;
else :

	if (isset($_SESSION['fName']) && $_SESSION['chkaddr']) :
		$check_order = "SELECT * FROM checkout_orders WHERE firstname = '". $_SESSION['fName'] ."' AND address = '". $_SESSION['chkaddr'] ."'";
		if (mysqli_query($mysqli, $check_order)) :
?>





<!DOCTYPE html><html>
<head>
	<title>Your Basket - Candela</title>
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

	<div style="padding: 20px; margin: 90px 20px 10px 20px;">
		<div style="text-align: center;">
			<div id="basket-header">
				- Thank You for Choosing Us -
			</div>
			<div style="font-size: 120%;">
				<hr>
				<?php 
				if (isset($_SESSION['username'])) {
					$user_order_sql = mysqli_query($mysqli, "SELECT * FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."'");
				} else {
					$user_order_sql = mysqli_query($mysqli, "SELECT * FROM checkout_orders WHERE firstname = '". $_SESSION['fName'] ."' AND address = '". $_SESSION['chkaddr'] ."'");
				}
					while ($checkout_row = mysqli_fetch_array($user_order_sql)) {
						$p1 = $checkout_row['p1'];
						$p2 = $checkout_row['p2'];
						$p3 = $checkout_row['p3'];
						$p4 = $checkout_row['p4'];
						$p5 = $checkout_row['p5'];
						$p6 = $checkout_row['p6'];
						$total_cost = $checkout_row['total'];
						$users_addr = $checkout_row['address'];
						$users_contact = $checkout_row['contact_number'];
					}
					if ($users_addr == "") {
						$youraddress = mysqli_query($mysqli, "SELECT Address FROM users WHERE id = '". $_SESSION['id'] ."' AND Username = '". $_SESSION['username'] ."'");
						while ($myaddr = mysqli_fetch_array($youraddress)) {
							$users_addr = $myaddr['Address'];
						}
					}
					if ($users_contact == "") {
						$yournumber = mysqli_query($mysqli, "SELECT ContactNumber FROM users WHERE id = '". $_SESSION['id'] ."' AND Username = '". $_SESSION['username'] ."'");
						while ($mynum = mysqli_fetch_array($yournumber)) {
							$users_contact = $mynum['ContactNumber'];
						}
					}
				?>
				<p>You've successfully ordered:</p>
				<p style="font-size: 150%;">
					<?php 
					$p1_name = $p2_name = $p3_name = $p4_name = $p5_name = $p6_name = "";
					$p1_price = $p2_price = $p3_price = $p4_price = $p5_price = $p6_price = "";

					if ($p1 > 0) :
						$p1_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 1");
						while ($p1_row = mysqli_fetch_array($p1_sql)) {
							$p1_price = $p1_row['price'];
							$p1_name = $p1_row['pname'];
						}
						$p1total = $p1 * $p1_price;
					?>
						<?php echo $p1; ?> <b><?php echo $p1_name; ?>/s</b> : P<?php echo $p1total; ?><br>
					<?php
					endif; // p1
					if ($p2 > 0) :
						$p2_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 2");
						while ($p2_row = mysqli_fetch_array($p2_sql)) {
							$p2_price = $p2_row['price'];
							$p2_name = $p2_row['pname'];
						}
						$p2total = $p2 * $p2_price;
					?>
						<?php echo $p2; ?> <b><?php echo $p2_name; ?>/s</b> : P<?php echo $p2total; ?><br>
					<?php
					endif; // p2
					if ($p3 > 0) :
						$p3_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 3");
						while ($p3_row = mysqli_fetch_array($p3_sql)) {
							$p3_price = $p3_row['price'];
							$p3_name = $p3_row['pname'];
						}
						$p3total = $p3 * $p3_price;
					?>
						<?php echo $p3; ?> <b><?php echo $p3_name; ?>/s</b> : P<?php echo $p3total; ?><br>
					<?php
					endif; // p3
					if ($p4 > 0) :
						$p4_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 4");
						while ($p4_row = mysqli_fetch_array($p4_sql)) {
							$p4_price = $p4_row['price'];
							$p4_name = $p4_row['pname'];
						}
						$p4total = $p4 * $p4_price;
					?>
						<?php echo $p4; ?> <b><?php echo $p4_name; ?>/s</b> : P<?php echo $p4total; ?><br>
					<?php
					endif; // p4
					if ($p5 > 0) :
						$p5_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 5");
						while ($p5_row = mysqli_fetch_array($p5_sql)) {
							$p5_price = $p5_row['price'];
							$p5_name = $p5_row['pname'];
						}
						$p5total = $p5 * $p5_price;
					?>
						<?php echo $p5; ?> <b><?php echo $p5_name; ?>/s</b> : P<?php echo $p5total; ?><br>
					<?php
					endif; // p5
					if ($p6 > 0) :
						$p6_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE id = 6");
						while ($p6_row = mysqli_fetch_array($p6_sql)) {
							$p6_price = $p6_row['price'];
							$p6_name = $p6_row['pname'];
						}
						$p6total = $p6 * $p6_price;
					?>
						<?php echo $p6; ?> <b><?php echo $p6_name; ?>/s</b> : P<?php echo $p6total; ?><br>	
					<?php
					endif; // p6
					?>
				</p>
				<p>For a total of:</p>
				<p style="font-size: 150%;">
					P<?php echo $total_cost; ?>
				</p>
				<p>To be delivered at:</p>
				<p style="font-size: 150%;">
					<?php echo $users_addr; ?><br>
					<span style="font-size: medium;">Imus City, Cavite</span>
				</p>

				<hr>

				<p style="font-size: 20px;">Thank You for choosing Candela! Your order will now be delivered in <b>the upcoming Friday</b> of the week.</p>
				<hr><br>
				<p>Would you rather give us a feedback? We would love to hear it from you!</p>
				<br><a href="contact-us.php" class="lend_feedback">Lend A Feedback</a>
				<div style="padding: 30px 0;">

					<hr>
				<?php if (isset($_SESSION['username'])) {
					if (!isset($_POST['addr_no'])) {
						if (!isset($_SESSION['address'])) { ?>
					<p>You have now entered your <b>address</b>, would you like to save it on your account?</p>
					<form method="post" id="addr_save" action="success.php">
						<input type="submit" name="addr_yes" value="Yes, I would love to!" />
						<input type="submit" name="addr_no" value="No, thanks." />
					</form>
					<?php } else {
							if (!isset($_POST['addr_change_no'])) {
								if ($_SESSION['address'] != $users_addr) {
					?>
					<p>It seems like you've changed your <b>address</b>. Would you like to change your previous one?</p>
					<form method="post" id="addr_save" action="success.php">
						<input type="submit" name="addr_change_yes" value="Yes, I would love to!" />
						<input type="submit" name="addr_change_no" value="No, thanks." />
					</form>
					<?php		}
							 }
						}
					} ?>

					<hr>

					<?php 
					if (!isset($_POST['contactnum_no'])) {
						if (!isset($_SESSION['contactnumber'])) { ?>
					<p>You have now entered your <b>contact number</b>, would you like to save it on your account?</p>
					<form method="post" id="addr_save" action="success.php">
						<input type="submit" name="contactnum_yes" value="Yes, I would love to!" />
						<input type="submit" name="contactnum_no" value="No, thanks." />
					</form>
					<?php } elseif ($_SESSION['contactnumber'] == "") {
					?>
					<p>You have now entered your <b>contact number</b>, would you like to save it on your account?</p>
					<form method="post" id="addr_save" action="success.php">
						<input type="submit" name="contactnum_yes" value="Yes, I would love to!" />
						<input type="submit" name="contactnum_no" value="No, thanks." />
					</form>
					<?php
							} else {

							if (!isset($_POST['contactnum_change_no'])) {
								if ($_SESSION['contactnumber'] != $users_contact) {
					?>
					<p>It seems like you've changed your <b>contact number</b>. Would you like to change your previous one?</p>
					<form method="post" id="addr_save" action="success.php">
						<input type="submit" name="contactnum_change_yes" value="Yes, I would love to!" />
						<input type="submit" name="contactnum_change_no" value="No, thanks." />
					</form>
					<?php 		}
							}
						}
					}
				} ?>

				</div>
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




<?php 
		endif;
	endif;
endif;
?>