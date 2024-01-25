<?php
	$termsConditions = "<h1>Terms and Conditions</h1>
			   	<p>Please read these Terms and Conditions carefully before using the http://candela.com website owned and operated by Candela.</p>
			   	<p>Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.</p>
			   	<p><b>By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms, then you may not access the Service.</b></p>
			   	<h3>Intellectual Property</h3>
			   	<p>The Site and all of its original content are the sole property of Candela and are, as such, fully protected by the appropriate international copyright and other intellectual property rights laws.</p>
			   	<h3>Termination</h3>
			   	<p>Candela reserves the right to terminate your access to the Site, without any advance notice.</p>
			   	<h3>Governing Law</h3>
			   	<p>This Agreement is governed in accordance with the laws of Cavite, Philippines.</p>
			   	<h3>Changes to This Agreement</h3>
			   	<p>Candela reserves the right to modify these Terms and Conditions at any time. We do so by posting and drawing attention to the updated terms on the Site. Your decision to continue to visit and make use of the Site after such changes have been made constitutes your formal acceptance of the new Terms and Conditions.</p>
				<p>Therefore, we ask that you check and review this Agreement for such changes on an occasional basis. Should you not agree to any provision of this Agreement or any changes we make to this Agreement, we ask and advise that you do not use or continue to access the Candela site immediately.</p>
				
				<hr>

				<h2>Account</h2>
				<p>Users can have choices to create an account or not for purchases.</p>
				<p>Users will be provided a Guest Checkout Option once a purchase is desired without an account.</p>
				<p>Previous orders before logging in or signing up will be deleted, providing that the buyer is creating a new set of orders.</p>
			   	<h2>Purchases</h2>
			   	<p>If you wish to purchase any product or service made available through the Service ('Purchase'), you may be asked to supply certain information relevant to your Purchase including, without limitation, your …</p>
			   	<ul>
			   		<li>Full Name</li>
			   		<li>Email</li>
			   		<li>Contact Number / Phone Number</li>
			   		<li>Complete Address</li>
			   	</ul>
			   	<p>A required total cost of orders (excluding shipping fee) is Five Hundred Pesos (P500.00) before submitting the order.</p>
			   	<p>Purchases of buyers without an account will not be displayed on the site. The buyer can only rely through communication using Candela's Email or Contact Number.</p>
			   	<p>The quantity of the items has limited stocks, providing that buyers could only order limited items.</p>
			   	<h2>Payment</h2>
			   	<p>All payments are due upon receipt. The payment method is <i>Cash on Delivery</i>. If the payment is not received, the buyer forfeits the ownership of any items purchased.</p>
			   	<h2>Shipping Policies</h2>
			   	<p>Shipping will be paid for by the buyer in the amount agreed upon by the seller at the time of purchase. If an item is lost during shipping, the total cost of lost item will be deducted from the total cost of purchase by the seller. If an item is damaged during shipping, seller will not be held responsible.</p>
			   	<p>Shipping fee (P50.00) will be added to the total cost of orders if the buyer has purchased with no more than Two Thousand Pesos (P2,000.00).</p>
			   	<p>Candela operates only in Imus City, Cavite. Purchases outside the city will be disregarded. Thus, if the address of the buyer cannot be located, the purchase will be disregarded, informing the buyer that the delivery is cancelled. Candela is not responsible for incomplete or wrong addresses.</p>
			   	<p>All orders are scheduled to ship on Friday of the week. All purchases on Friday will be delivered on the next scheduled day.</p>
			   	<h2>Cancellation of Orders</h2>
			   	<p>An item may be cancelled up until payment has been processed. Once payment has been processed, the buyer is responsible for payment, and it cannot be cancelled.</p>
			   	<h2>No Refund/Return Policy</h2>
			   	<p>Once an item is delivered to the buyer, he/she is responsible to check the items before the payment. Candela will not hold the responsible for future complaints after the payment and the delivery of the purchases.</p>
			   	<h2>Legalities</h2>
			   	<p>The seller is not responsible for any health or safety concerns once the buyer has received the item. If any harm is incurred from the items purchased by the buyer, the seller shares no responsibility.</p>
			   	<h2>Contact Us</h2>
			   	<p>If you have any questions or complaints about the Terms of Service and Conditions, please feel free to contact us at candela.foodcandle@gmail.com, or you could call or text us at 0971-697-0022.</p>
			   	<br><p>These terms and conditions are subject to change.</p><br>
			   	<p><b>I have read and agree to the terms and conditions.</b></p><br>";

	session_start();


	# Variables for Register Form...
	$uName = $LName = $email = $contactnum = $psw = $rePass = "";
	$comment = "";
	$addr = $lName = $fName = "";
	$answer = $number1 = $number2 = "";
	$uNameErr = $LNameErr = $emailErr = $contactnumErr = $pswErr = $repswErr = $captchaErr = "";
	$contnameErr = $contemailErr = $contcontactnumErr = $contcommentErr = "";
	$fNameErr = $lNameErr = $addrErr = $chkemailErr = $chkcontactnumErr = "";
	$errors = array();
	$conterrors = array();
	$checkouterrors = array();
	$confirm_checkoutErr  = array();
	$stockerror = array();

	$myfirstname = $mylastname = $myemail = $mynumber = $myaddress = $mypassword = "";
	$myfirstnameNotice = $mylastnameNotice = $myemailNotice = $mynumberNotice = $myaddressNotice = $mypasswordNotice= "";
	$myfirstnameSuccess = $mylastnameSuccess = $myemailSuccess = $mynumberSuccess = $myaddressSuccess = $mypasswordSuccess= "";
	$oldpassword = $newpassword = $confirmpassword = "";
	$oldpasswordErr = $newpasswordErr = $newpasswordSuccess = $confirmpasswordErr = $del_oldpasswordErr = "";

	$qtyminusstock = "";

	# Variables for Login Form...
	$loginName = $loginPass = $inputErr = "";
	//$username = "";

	$passlength = strlen($psw);
	$field = htmlspecialchars($_SERVER['PHP_SELF']);
	$alert = "";

		// connection to database
	$user = "root"; $pass = ""; $db = "candela_database";
	$mysqli = mysqli_connect('localhost', $user, $pass, $db) or die("Unable To Connect");
	
	function testInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	#Captcha...
	$no1 = rand(1,10);
	$no2 = rand(1,10);
	

	# Form being Submitted...
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		
	} // end of if($_SERVER["REQUEST_METHOD"] == "POST") statement

	// makes sure session id is set













	
	//Getting the data of products in products table
		$productquery = 'SELECT * FROM products ORDER by id ASC';
		$productresult = mysqli_query($mysqli,$productquery);

		$p1 = "SELECT * FROM products WHERE id = 1";
		$p1result = mysqli_query($mysqli, $p1);
		$p2 = "SELECT * FROM products WHERE id = 2";
		$p2result = mysqli_query($mysqli, $p2);
		$p3 = "SELECT * FROM products WHERE id = 3";
		$p3result = mysqli_query($mysqli, $p3);
		$p4 = "SELECT * FROM products WHERE id = 4";
		$p4result = mysqli_query($mysqli, $p4);
		$p5 = "SELECT * FROM products WHERE id = 5";
		$p5result = mysqli_query($mysqli, $p5);
		$p6 = "SELECT * FROM products WHERE id = 6";
		$p6result = mysqli_query($mysqli, $p6);


	function fname() {
		$fName = $GLOBALS['fName'];
		if(isset($_SESSION['username'])){
			echo $_SESSION['username'];
		} elseif (isset($_SESSION['fName'])) {
			echo $_SESSION['fName'];
		} else {
			echo $fName;
		}
	}
	function lname() {
		$lName = $GLOBALS['lName'];
		if (isset($_SESSION['lastname'])) {
			echo $_SESSION['lastname'];
		} elseif (isset($_SESSION['lName'])) {
			echo $_SESSION['lName'];
		} {
			echo $lName;
		}
	}
	function email() {
		$email = $GLOBALS['email'];
		if(isset($_SESSION['email']) != ""){
			echo $_SESSION['email'];
		} elseif (isset($_SESSION['chkemail'])) {
			echo $_SESSION['chkemail'];
		} else {
			echo $email;
		}
	}
	function chkcontact() {
		$contactnum = $GLOBALS['contactnum'];
		if(isset($_SESSION['contactnumber']) != ""){
			echo $_SESSION['contactnumber'];
		} elseif (isset($_SESSION['chkcontact'])) {
			echo $_SESSION['chkcontact'];
		} else {
			echo $contactnum;
		}
	}
	function chkaddr() {
		$addr = $GLOBALS['addr'];
		if(isset($_SESSION['address']) != ""){
			echo $_SESSION['address'];
		} elseif (isset($_SESSION['chkaddr'])) {
			echo $_SESSION['chkaddr'];
		} else {
			echo $addr;
		}
	}








	
	if (isset($_POST['checkout_submit'])) {
		#For Check Out Forms...
		if (empty($_POST['fName'])) {
			$fNameErr = "Please enter your First Name";
			array_push($checkouterrors, $checkouterrors);
		} else {
			$fName = testInput($_POST["fName"]);
			if (!preg_match("/^[a-zA-Z ]*$/",$fName)) {
				$fNameErr = "Only letters and white space allowed";
				array_push($checkouterrors, $checkouterrors);
			}
		}

		if (empty($_POST['LName'])) {
			$lNameErr = "Please enter your Last Name";
			array_push($checkouterrors, $checkouterrors);
		} else {
			$lName = testInput($_POST["LName"]);
			if (!preg_match("/^[a-zA-Z ]*$/",$lName)) {
				$lNameErr = "Only letters and white space allowed";
				array_push($checkouterrors, $checkouterrors);
			}
		}

		if (empty($_POST['addr'])) {
			$addrErr = "Please enter your Address";
			array_push($checkouterrors, $checkouterrors);
		} else {
			$addr = testInput($_POST['addr']);
		}

		//add the barangay
		if ($_POST['barangay'] == "- Select Your Location -") {
			$addrErr = "Please choose a valid address";
			array_push($checkouterrors, $checkouterrors);
		} else {
			$brgy = testInput($_POST['barangay']);
		}

		if (empty($_POST['email'])) {
			$chkemailErr = "Please enter your Email";
			array_push($checkouterrors, $checkouterrors);
		} else {
			$email = testInput($_POST["email"]);
			if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
				$chkemailErr = "Invalid Email format";
				array_push($checkouterrors, $checkouterrors);
			}
		}

		if (empty($_POST['contactnum'])) {
			$chkcontactnumErr = "Please enter your Contact Number";
			array_push($checkouterrors, $checkouterrors);
		} else {
			$contactnum = testInput($_POST['contactnum']);
			if (!preg_match("/^[[09]|[|\d{2}|\d{3}]][-|\s][\d{9}|\d{7}]*$/",$contactnum)) {
				$chkcontactnumErr = "Invalid Phone Number format";
				array_push($checkouterrors, $checkouterrors);
			}
		}

		if (count($checkouterrors) == 0) {
			if (isset($_SESSION['id'])) {

				$qty1_sql = mysqli_query($mysqli, "SELECT quantity FROM `basket_items` WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 1");
				$qty2_sql = mysqli_query($mysqli, "SELECT quantity FROM `basket_items` WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 2");
				$qty3_sql = mysqli_query($mysqli, "SELECT quantity FROM `basket_items` WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 3");
				$qty4_sql = mysqli_query($mysqli, "SELECT quantity FROM `basket_items` WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 4");
				$qty5_sql = mysqli_query($mysqli, "SELECT quantity FROM `basket_items` WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 5");
				$qty1 = mysqli_fetch_array($qty1_sql);
				$quant1 = $qty1['quantity'];
				$qty2 = mysqli_fetch_array($qty2_sql);
				$quant2 = $qty2['quantity'];
				$qty3 = mysqli_fetch_array($qty3_sql);
				$quant3 = $qty3['quantity'];
				$qty4 = mysqli_fetch_array($qty4_sql);
				$quant4 = $qty4['quantity'];
				$qty5 = mysqli_fetch_array($qty5_sql);
				$quant5 = $qty5['quantity'];

				while ($p1_stock_row = mysqli_fetch_array($p1result) ) {
					$p1stock = $p1_stock_row['stocks'];
				}
				while ($p2_stock_row = mysqli_fetch_array($p2result) ) {
					$p2stock = $p2_stock_row['stocks'];
				}
				while ($p3_stock_row = mysqli_fetch_array($p3result) ) {
					$p3stock = $p3_stock_row['stocks'];
				}
				while ($p4_stock_row = mysqli_fetch_array($p4result) ) {
					$p4stock = $p4_stock_row['stocks'];
				}
				while ($p5_stock_row = mysqli_fetch_array($p5result) ) {
					$p5stock = $p5_stock_row['stocks'];
				}
					if ($p1stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant1)) {
						if ($p1stock < $quant1) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p2stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant2)) {
						if ($p2stock < $quant2) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p3stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant3)) {
						if ($p3stock < $quant3) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p4stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant4)) {
						if ($p4stock < $quant4) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p5stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant5)) {
						if ($p5stock < $quant5) {
							array_push($stockerror, $stockerror);
						}
					}
			} else { // if the user doesn't have an account

				foreach ($_SESSION['basket'] as $key => $value) {
					if ( $value['id'] == 1 ) {
						$quant1 = $value['quantity'];
					}
					if ( $value['id'] == 2 ) {
						$quant2 = $value['quantity'];
					}
					if ( $value['id'] == 3 ) {
						$quant3 = $value['quantity'];
					}
					if ( $value['id'] == 4 ) {
						$quant4 = $value['quantity'];
					}
					if ( $value['id'] == 5 ) {
						$quant5 = $value['quantity'];
					}
				}
					while ($p1_stock_row = mysqli_fetch_array($p1result) ) {
						$p1stock = $p1_stock_row['stocks'];
					}
					while ($p2_stock_row = mysqli_fetch_array($p2result) ) {
						$p2stock = $p2_stock_row['stocks'];
					}
					while ($p3_stock_row = mysqli_fetch_array($p3result) ) {
						$p3stock = $p3_stock_row['stocks'];
					}
					while ($p4_stock_row = mysqli_fetch_array($p4result) ) {
						$p4stock = $p4_stock_row['stocks'];
					}
					while ($p5_stock_row = mysqli_fetch_array($p5result) ) {
						$p5stock = $p5_stock_row['stocks'];
					}
					if ($p1stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant1)) {
						if ($p1stock < $quant1) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p2stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant2)) {
						if ($p2stock < $quant2) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p3stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant3)) {
						if ($p3stock < $quant3) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p4stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant4)) {
						if ($p4stock < $quant4) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p5stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant5)) {
						if ($p5stock < $quant5) {
							array_push($stockerror, $stockerror);
						}
					}

			}
				if (count($stockerror) == 0) {
					if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
						echo "<script>alert('Please be reminded that you CANNOT cancel your orders once checked out.')</script>";
						echo "<script>window.location = 'confirmation.php'; </script>";
					} else { // if they are using guest checkout option
						echo "<script>alert('Please be reminded that you CANNOT cancel or view your orders once checked out.')</script>";
						echo "<script>window.location = 'confirmation.php'; </script>";
					}
					$_SESSION['fName'] = $fName;
					$_SESSION['lName'] = $lName;
					$_SESSION['chkemail'] = $email;
					$_SESSION['chkcontact'] = $contactnum;
					$_SESSION['chkaddr'] = $addr . ", " . $brgy;

					$need_confirm = "set";
				} else {
					echo "<script>alert('Oops! Sorry, the stocks left have been reduced lower than your chosen quantity, please update your basket.')</script>";
					echo "<script>window.location = 'product.php';</script>";
				}
		}

	} // end if statement for Checkout Forms...



	// confirm checkout
	if (isset($_POST['confirm_checkout'])) {
		if (!empty($_POST['captcha'])) {
			$answer = $_POST['captcha'];
			$number1 = $_POST['no1'];
			$number2 = $_POST['no2'];
			$total = $number1 + $number2;
				if ( $total != $answer ) {
					$captchaErr = "Please Type The Correct Answer";
						array_push($confirm_checkoutErr, $confirm_checkoutErr);
				}
		}
		if (count($confirm_checkoutErr) == 0) {
			if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
				$qty1_sql = mysqli_query($mysqli, "SELECT quantity FROM `basket_items` WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 1");
				$qty2_sql = mysqli_query($mysqli, "SELECT quantity FROM `basket_items` WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 2");
				$qty3_sql = mysqli_query($mysqli, "SELECT quantity FROM `basket_items` WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 3");
				$qty4_sql = mysqli_query($mysqli, "SELECT quantity FROM `basket_items` WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 4");
				$qty5_sql = mysqli_query($mysqli, "SELECT quantity FROM `basket_items` WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 5");
				$qty1 = mysqli_fetch_array($qty1_sql);
				$quant1 = $qty1['quantity'];
				$qty2 = mysqli_fetch_array($qty2_sql);
				$quant2 = $qty2['quantity'];
				$qty3 = mysqli_fetch_array($qty3_sql);
				$quant3 = $qty3['quantity'];
				$qty4 = mysqli_fetch_array($qty4_sql);
				$quant4 = $qty4['quantity'];
				$qty5 = mysqli_fetch_array($qty5_sql);
				$quant5 = $qty5['quantity'];
				
				while ($p1_stock_row = mysqli_fetch_array($p1result) ) {
					$p1stock = $p1_stock_row['stocks'];
				}
				while ($p2_stock_row = mysqli_fetch_array($p2result) ) {
					$p2stock = $p2_stock_row['stocks'];
				}
				while ($p3_stock_row = mysqli_fetch_array($p3result) ) {
					$p3stock = $p3_stock_row['stocks'];
				}
				while ($p4_stock_row = mysqli_fetch_array($p4result) ) {
					$p4stock = $p4_stock_row['stocks'];
				}
				while ($p5_stock_row = mysqli_fetch_array($p5result) ) {
					$p5stock = $p5_stock_row['stocks'];
				}
					if ($p1stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant1)) {
						if ($p1stock < $quant1) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p2stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant2)) {
						if ($p2stock < $quant2) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p3stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant3)) {
						if ($p3stock < $quant3) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p4stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant4)) {
						if ($p4stock < $quant4) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p5stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant5)) {
						if ($p5stock < $quant5) {
							array_push($stockerror, $stockerror);
						}
					}


				if (count($stockerror) == 0) {
					$user_id = $_SESSION['id'];
					$username = $_SESSION['username'];
					$user_lastname = $_SESSION['lastname'];
					$user_email = $_SESSION['email'];
					if (isset($_SESSION['address'])) {
						$useraddr = $_SESSION['address'];
						if ($useraddr != $_SESSION['chkaddr']) {
							$user_addr = $_SESSION['chkaddr'];
						}
					} else {
						$user_addr = $_SESSION['chkaddr'];
					}
					if (isset($_SESSION['contactnumber'])) {
						$usercontactnum = $_SESSION['contactnumber'];
						if ($usercontactnum != $_SESSION['chkcontact']) {
							$user_contactnum = $_SESSION['chkcontact'];
						} else {
							$user_contactnum = $usercontactnum;
						}
					} else {
						$user_contactnum = $_SESSION['chkcontact'];
					}


					// $total represents the whole price, including the shipping fee worth P50.00
					$total = $_SESSION['subtotal'];

					if ($username != $_SESSION['fName']) {
						$firstname = $_SESSION['fName'];
					} else {
						$firstname = $username;
					}
					if ($user_lastname != $_SESSION['lName']) {
						$lastname = $_SESSION['lName'];
					} else {
						$lastname = $user_lastname;
					}
					if ($user_email != $_SESSION['chkemail']) {
						$useremail = $_SESSION['chkemail'];
					} else {
						$useremail = $user_email;
					}
					$orders_sql = "INSERT INTO `checkout_orders` (user_id, firstname, lastname, email, contact_number, address, p1, p2, p3, p4, p5, p6, total) VALUES ('".$user_id."', '".$firstname."', '".$lastname."', '".$useremail."', '".$user_contactnum."', '".$user_addr."', '".$quant1."', '".$quant2."', '".$quant3."', '".$quant4."', '".$quant5."', '".$quant6."', '".$total."')";
					$checkout_result = mysqli_query($mysqli, $orders_sql) or die("Unable to checkout");
					header('location: success.php');
					$delete_sql = "DELETE FROM basket_items WHERE user_id = '". $user_id ."' ";
					mysqli_query($mysqli, $delete_sql);

					//reducing the stock amount in products table
					//p1-6result variables are references from getting product rows, line 358 to 372
					if ($quant1 >= 1) {
						while ($p1_stock_updaterow = mysqli_fetch_array($p1result) ) {
							$p1stock = $p1_stock_updaterow['stocks'];
						}
						$p1stock = $p1stock - $quant1;
						$executeupdatein_p1row = mysqli_query($mysqli, "UPDATE products SET stocks = '". $p1stock ."' WHERE id = 1");
					}

					if ($quant2 >= 1) {
						while ($p2_stock_updaterow = mysqli_fetch_array($p2result) ) {
							$p2stock = $p2_stock_updaterow['stocks'];
						}
						$p2stock = $p2stock - $quant2;
						$executeupdatein_p2row = mysqli_query($mysqli, "UPDATE products SET stocks = '". $p2stock ."' WHERE id = 2");
					}

					if ($quant3 >= 1) {
						while ($p3_stock_updaterow = mysqli_fetch_array($p3result) ) {
							$p3stock = $p3_stock_updaterow['stocks'];
						}
						$p3stock = $p3stock - $quant3;
						$executeupdatein_p3row = mysqli_query($mysqli, "UPDATE products SET stocks = '". $p3stock ."' WHERE id = 3");
					}
					if ($quant4 >= 1) {
						while ($p4_stock_updaterow = mysqli_fetch_array($p4result) ) {
							$p4stock = $p4_stock_updaterow['stocks'];
						}
						$p4stock = $p4stock - $quant4;
						$executeupdatein_p4row = mysqli_query($mysqli, "UPDATE products SET stocks = '". $p4stock ."' WHERE id = 4");
					}

					if ($quant5 >= 1) {
						while ($p5_stock_updaterow = mysqli_fetch_array($p5result) ) {
							$p5stock = $p5_stock_updaterow['stocks'];
						}
						$p5stock = $p5stock - $quant5;
						$executeupdatein_p5row = mysqli_query($mysqli, "UPDATE products SET stocks = '". $p5stock ."' WHERE id = 5");
					}
				}

			} else { // if the customer will be checking out without an account
				foreach ($_SESSION['basket'] as $key => $value) {
					if ( $value['id'] == 1 ) {
						$quant1 = $value['quantity'];
					}
					if ( $value['id'] == 2 ) {
						$quant2 = $value['quantity'];
					}
					if ( $value['id'] == 3 ) {
						$quant3 = $value['quantity'];
					}
					if ( $value['id'] == 4 ) {
						$quant4 = $value['quantity'];
					}
					if ( $value['id'] == 5 ) {
						$quant5 = $value['quantity'];
					}
					while ($p1_stock_row = mysqli_fetch_array($p1result) ) {
						$p1stock = $p1_stock_row['stocks'];
					}
					while ($p2_stock_row = mysqli_fetch_array($p2result) ) {
						$p2stock = $p2_stock_row['stocks'];
					}
					while ($p3_stock_row = mysqli_fetch_array($p3result) ) {
						$p3stock = $p3_stock_row['stocks'];
					}
					while ($p4_stock_row = mysqli_fetch_array($p4result) ) {
						$p4stock = $p4_stock_row['stocks'];
					}
					while ($p5_stock_row = mysqli_fetch_array($p5result) ) {
						$p5stock = $p5_stock_row['stocks'];
					}
					if ($p1stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif ($p1stock < $quant1) {
						array_push($stockerror, $stockerror);
					}
										if ($p1stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant1)) {
						if ($p1stock < $quant1) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p2stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant2)) {
						if ($p2stock < $quant2) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p3stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant3)) {
						if ($p3stock < $quant3) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p4stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant4)) {
						if ($p4stock < $quant4) {
							array_push($stockerror, $stockerror);
						}
					}
					if ($p5stock == 0) {
						array_push($stockerror, $stockerror);
					} elseif (isset($quant5)) {
						if ($p5stock < $quant5) {
							array_push($stockerror, $stockerror);
						}
					}
				}

				if (count($stockerror) == 0) {
					$guest_fName = $_SESSION['fName'];
					$guest_lName = $_SESSION['lName'];
					$guest_email = $_SESSION['chkemail'];
					$guest_contact = $_SESSION['chkcontact'];
					$guest_addr = $_SESSION['chkaddr'];
					
					// $total represents the whole price, including the shipping fee worth P50.00
					$total = $_SESSION['subtotal'];

					$orders_sql = "INSERT INTO `checkout_orders` ( firstname, lastname, email, contact_number, address, p1, p2, p3, p4, p5, p6, total) VALUES ('".$guest_fName."', '".$guest_lName."', '".$guest_email."', '".$guest_contact."', '".$guest_addr."', '".$quant1."', '".$quant2."', '".$quant3."', '".$quant4."', '".$quant5."', '".$quant6."', '".$total."')";
					$checkout_result = mysqli_query($mysqli, $orders_sql) or die("Unable to checkout");
					header('location: success.php');
					unset($_SESSION['basket']);
					$_SESSION['fName'] = $guest_fName;
					$_SESSION['chkaddr'] = $guest_addr;
					$_SESSION['total'] = $total;
					unset($_SESSION['lName']);
					unset($_SESSION['chkemail']);
					unset($_SESSION['chkcontact']);

					if ($quant1 >= 1) {
						while ($p1_stock_updaterow = mysqli_fetch_array($p1result) ) {
							$p1stock = $p1_stock_updaterow['stocks'];
						}
						$p1stock = $p1stock - $quant1;
						$executeupdatein_p1row = mysqli_query($mysqli, "UPDATE products SET stocks = '". $p1stock ."' WHERE id = 1");
					}
					if ($quant2 >= 1) {
						while ($p2_stock_updaterow = mysqli_fetch_array($p2result) ) {
							$p2stock = $p2_stock_updaterow['stocks'];
						}
						$p2stock = $p2stock - $quant2;
						$executeupdatein_p2row = mysqli_query($mysqli, "UPDATE products SET stocks = '". $p2stock ."' WHERE id = 2");
					}
					if ($quant3 >= 1) {
						while ($p3_stock_updaterow = mysqli_fetch_array($p3result) ) {
							$p3stock = $p3_stock_updaterow['stocks'];
						}
						$p3stock = $p3stock - $quant3;
						$executeupdatein_p3row = mysqli_query($mysqli, "UPDATE products SET stocks = '". $p3stock ."' WHERE id = 3");
					}
					if ($quant4 >= 1) {
						while ($p4_stock_updaterow = mysqli_fetch_array($p4result) ) {
							$p4stock = $p4_stock_updaterow['stocks'];
						}
						$p4stock = $p4stock - $quant4;
						$executeupdatein_p4row = mysqli_query($mysqli, "UPDATE products SET stocks = '". $p4stock ."' WHERE id = 4");
					}
					if ($quant5 >= 1) {
						while ($p5_stock_updaterow = mysqli_fetch_array($p5result) ) {
							$p5stock = $p5_stock_updaterow['stocks'];
						}
						$p5stock = $p5stock - $quant5;
						$executeupdatein_p5row = mysqli_query($mysqli, "UPDATE products SET stocks = '". $p5stock ."' WHERE id = 5");
					}
				}
				
				}
			}
	} // end if confirm_checkout

	# For Changing and Saving Address and Contact Number after Checking Out
	if (isset($_POST['addr_yes']) || isset($_POST['addr_change_yes'])) {
		$addr_sql = mysqli_query($mysqli, "SELECT address FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."'");
		while ($addr_row = mysqli_fetch_array($addr_sql)) {
			$myaddr = $addr_row['address'];
		}
			$add_addr =  mysqli_query($mysqli, "UPDATE users SET Address = '". $myaddr ."' WHERE id = '". $_SESSION['id'] ."' AND Username = '". $_SESSION['username'] ."'");
			$set_addr = mysqli_query($mysqli, "SELECT Address FROM users WHERE id = '". $_SESSION['id'] ."' AND Username = '". $_SESSION['username'] ."'");
			while ($setting_address = mysqli_fetch_array($set_addr)) {
				$myaddress = $setting_address['Address'];
			}
			$_SESSION['address'] = $myaddress;
			if (isset($_POST['addr_yes'])) {
				echo "<script>alert('Successfully Added!');</script>";
			} elseif (isset($_POST['addr_change_yes'])) {
				echo "<script>alert('Address Successfully Changed!');</script>";
			}
	}
	if (isset($_POST['contactnum_yes']) || isset($_POST['contactnum_change_yes'])) {
		$contact_sql = mysqli_query($mysqli, "SELECT contact_number FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."'");
		while ($contact_row = mysqli_fetch_array($contact_sql)) {
			$mycontact = $contact_row['contact_number'];
		}
			$add_contact =  mysqli_query($mysqli, "UPDATE users SET ContactNumber = '". $mycontact ."' WHERE id = '". $_SESSION['id'] ."' AND Username = '". $_SESSION['username'] ."'");
			$set_contact = mysqli_query($mysqli, "SELECT ContactNumber FROM users WHERE id = '". $_SESSION['id'] ."' AND Username = '". $_SESSION['username'] ."'");
			while ($setting_contact = mysqli_fetch_array($set_contact)) {
				$mynumber = $setting_contact['ContactNumber'];
			}
			$_SESSION['contactnumber'] = $mynumber;
			if (isset($_POST['contactnum_yes'])) {
				echo "<script>alert('Successfully Added!');</script>";
			} elseif (isset($_POST['contactnum_change_yes'])) {
				echo "<script>alert('Contact Number Successfully Changed!');</script>";
			}
	}



	# If user will delete recorded checked out orders
	if (filter_input(INPUT_GET, 'action') == 'deletechk') {
		$users_checkout_sql = mysqli_query($mysqli, "SELECT * FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."' AND id = '". $_GET['id'] ."'");
		$users_checkout_count = mysqli_num_rows($users_checkout_sql);
		$myrow = array();
		if ($users_checkout_count >= 1) {
			while ($checkout_row = mysqli_fetch_array($users_checkout_sql)) {
				$myrow[] = $checkout_row;
				$id_checkedout = $checkout_row['id'];
				$user_id_checkedout = $checkout_row['user_id'];
				$date_checkedout = $checkout_row['checked_out'];
				$delivered_checkedout = $checkout_row['delivered'];
			}
			if ($id_checkedout == filter_input(INPUT_GET, 'id')) {
				unset($_SESSION['basket']);
				if (isset($_SESSION['username'])) {
					$delete_sql = "DELETE FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."' AND id = '". $id_checkedout ."'";
					mysqli_query($mysqli, $delete_sql) or die("Deleting Query Failed");
				}

			}
		}
	}

	if (!isset($_SESSION['basket'])) {
		if (isset($_SESSION['total'])) {
			unset($_SESSION['total']);
		}
	}

?>