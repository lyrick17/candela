<?php


	
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


?>