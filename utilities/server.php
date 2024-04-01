<?php 
// This file will contain most of the general processes that the website need
require("conn/db_connection.php");
require("sanitize_input.php");


if (!isset($_SESSION['basket'])) {
	$_SESSION['basket'] = array();
}


class Restrict {

	//  check if the user is logged in or not before allowing user to access a webpage
	static function user($type) {
		if ($type == "guest" && !isset($_SESSION['id'])) {
			header("Location: index.php");
			exit();
		}
		if ($type == "logged" && isset($_SESSION['id'])) {
			header("Location: index.php");
			exit();
		}
	}
	
	// check if Get ID is being used correctly or not in product.php
	static function product_page_access($product_id) {
		global $mysqli;
		$product_info = Products::get_product_info($product_id); 
		if (!$product_info) {
			header("Location: product.php");
			exit();
		}
	
	}

	// check if session id is set before confirming checkout
	static function confirm_checkout_page_access() {
		if (!isset($_SESSION['checkout'])) {
			header("Location: product.php");
			exit();
		}
	}
	
	// do not allow the user to see success.php unless user has successfully checked out
	static function success_page_access() {
		if (!isset($_SESSION['recent_order_id'])) {
			header("Location: index.php");
			exit();
		}
	}
	
	// always remove the session checkout whenever user is not doing th process
	static function remove_checkout_sess() {
		if (isset($_SESSION['checkout'])) {
			unset($_SESSION['checkout']);
		}
	}
	
	// always remove the session recent order it whenever user is finished on ordering
	static function remove_order_id_sess() {
		if (isset($_SESSION['recent_order_id'])) {
			unset($_SESSION['recent_order_id']);
		}
	}
	
}


// MySQLi Product Functions
class Products {
	
	// select all products in ascending order
	static function select_all() {
		global $mysqli;
		
        $query = 'SELECT * FROM products ORDER by product_id ASC';
        $result = @mysqli_query($mysqli, $query);
        return ($result || mysqli_num_rows($result) > 0) ? $result : false;
    }
	
	// select three products in descending order
	static function select_three() {
		global $mysqli;
		
        $query = 'SELECT * FROM products ORDER by product_id DESC LIMIT 3';
        $result = @mysqli_query($mysqli, $query);
        return ($result || mysqli_num_rows($result) > 0) ? $result : false;
    }
	
	// get specific product information
    static function get_product_info($id) {
		global $mysqli;
        if (!isset($id)) return false;
		
        $id = test_input($mysqli, $id);
        $query = "SELECT * FROM products WHERE product_id = '$id'";
        $result = @mysqli_query($mysqli, $query);
        
        return ($result && mysqli_num_rows($result) > 0) ? $result : false;
    }

	static function get_stocks($id) {
		global $mysqli;
        if (!isset($id)) return false;
		
        $id = test_input($mysqli, $id);
        $query = "SELECT stocks FROM products WHERE product_id = '$id'";
        $result = @mysqli_query($mysqli, $query);
        
        return ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_array($result, MYSQLI_ASSOC) : false;
	}

	static function revert_stocks($id, $quantity) {
		global $mysqli;
		$id = test_input($mysqli, $id);
		$quantity = test_input($mysqli, $quantity);

		$query = "UPDATE products SET stocks = stocks + $quantity WHERE product_id = '$id'";
		$result = @mysqli_query($mysqli, $query);

		return $result;
	}

	static function update_price($id, $newprice) {
		global $mysqli;
		$id = test_input($mysqli, $id);
		$newprice = test_input($mysqli, $newprice);

		$query = "UPDATE products SET price = $newprice WHERE product_id = '$id'";
		$result = @mysqli_query($mysqli, $query);

		return $result;
	
	}
	
	static function update_stocks($id, $newstocks) {
		global $mysqli;
		$id = test_input($mysqli, $id);
		$newstocks = test_input($mysqli, $newstocks);

		$query = "UPDATE products SET stocks = $newstocks WHERE product_id = '$id'";
		$result = @mysqli_query($mysqli, $query);

		return $result;
	
	}
	
	
}


// MySQLi User Functions
class Users {

	// get all information of a specific user
	static function get_all_info($email) {
		global $mysqli;
		$email = test_input($mysqli, $email) ?? "";

		$query = "SELECT * FROM users WHERE `email` = '". $email ."'";
        $result = @mysqli_query($mysqli, $query);
		// once one result has been selected, return the result in an array
        return (mysqli_num_rows($result) == 1) ? mysqli_fetch_array($result, MYSQLI_ASSOC) : false;

	}

	// verify if email is already taken or not
	static function verify_email($email) {
		global $mysqli;
		$email = test_input($mysqli, $email) ?? "";
		
		$query = "SELECT * FROM `users` WHERE email = '" . $email . "'";
    	$result = mysqli_query($mysqli, $query);
		$count = mysqli_num_rows($result);
		// return true if email is verified and not used yet
    	return ($result && $count == 0) ? true : false;
	}
	
	// get address of a specific user
	static function get_address($id) {
		global $mysqli;
		$id = test_input($mysqli, $id) ?? "";
		$query = "SELECT * FROM addresses WHERE `user_id` = '". $id ."'";
		$result = @mysqli_query($mysqli, $query);
		// return the address info 
		return ($result) ? mysqli_fetch_array($result, MYSQLI_ASSOC) : false;
	}	
	
	// get password of a specific user
	static function get_password($id) {
		global $mysqli;
		$id = test_input($mysqli, $id) ?? "";
		
		
		$query = "SELECT password FROM users WHERE `user_id` = '". $id ."'";
    	$result = @mysqli_query($mysqli, $query);
		return ($result) ? mysqli_fetch_array($result, MYSQLI_ASSOC) : false;
	}
	
	
}


// MySQLi Basket Functions
class Basket {

	// get all basket items of a specific user
	static function get_all_items($id) {
		global $mysqli;
		$id = test_input($mysqli, $id) ?? "";

		$query = "SELECT * FROM basket_items WHERE user_id = '". $id ."'";
		$result = @mysqli_query($mysqli, $query);

		return ($result) ? $result : false;
	}
	
	// get the quantity of the specific product of a specific user
	static function get_quantity($id, $product_id) {
		global $mysqli;
		$id = test_input($mysqli, $id) ?? "";
		$product_id = test_input($mysqli, $product_id) ?? "";

		$query = "SELECT quantity FROM basket_items WHERE user_id = '$id' AND product_id = '$product_id'";
		$result = @mysqli_query($mysqli, $query);

		return ($result) ? mysqli_fetch_array($result, MYSQLI_ASSOC) : false;
	}
}

// MySQLi Checkout Order Functions
class Orders {
	
	// get all orders of a specific user
	static function get_orders_admin() {
		global $mysqli;

		$query = "SELECT * FROM checkout_orders ORDER BY checkout_id DESC";
		$result = @mysqli_query($mysqli, $query);

		return ($result) ? $result : false;
	
	}

	// get all orders of a specific user
	static function get_all_orders($user_id) {
		global $mysqli;
		$user_id = test_input($mysqli, $user_id) ?? "";

		$query = "SELECT * FROM checkout_orders WHERE user_id = '$user_id' ORDER BY checkout_id DESC";
		$result = @mysqli_query($mysqli, $query);

		return ($result) ? $result : false;
	
	}
	
	// get all not delivered orders of a specific user
	static function get_recent_orders($user_id) {
		global $mysqli;
		$user_id = test_input($mysqli, $user_id) ?? "";

		$query = "SELECT * FROM checkout_orders WHERE user_id = '$user_id' AND delivered NOT LIKE 'delivered' OR delivered IS NULL ORDER BY checkout_id DESC";
		$result = @mysqli_query($mysqli, $query);

		return ($result) ? $result : false;
	
	}

	// get the recent order of a specific user
	static function get_order($order_id) {
		global $mysqli;
		$order_id = test_input($mysqli, $order_id) ?? "";

		$query = "SELECT * FROM checkout_orders WHERE order_id = '$order_id'";
		$result = @mysqli_query($mysqli, $query);

		return ($result) ? mysqli_fetch_array($result, MYSQLI_ASSOC) : false;
	}
	
	// get the most recent order's checkout_id
	static function get_recent_checkout_id() {
		global $mysqli;

		$query = "SELECT checkout_id FROM checkout_orders ORDER BY checkout_id DESC LIMIT 1";
		$result = @mysqli_query($mysqli, $query);

		return ($result) ? mysqli_fetch_array($result, MYSQLI_ASSOC) : false;
	}

	static function get_address($order_id) {
		global $mysqli;
		$order_id = test_input($mysqli, $order_id) ?? "";

		$query = "SELECT address, barangay FROM checkout_orders WHERE order_id = '$order_id'";
		$result = @mysqli_query($mysqli, $query);

		return ($result) ? mysqli_fetch_array($result, MYSQLI_ASSOC) : false;
	}

	static function get_contact_number($order_id) {
		global $mysqli;
		$order_id = test_input($mysqli, $order_id) ?? "";

		$query = "SELECT contactnumber FROM checkout_orders WHERE order_id = '$order_id'";
		$result = @mysqli_query($mysqli, $query);

		return ($result) ? mysqli_fetch_array($result, MYSQLI_ASSOC) : false;
	}

	// update status of a specific order
	static function update_status($order_id, $status) {
		global $mysqli;
		$order_id = test_input($mysqli, $order_id) ?? "";
		$status = test_input($mysqli, $status) ?? "";

		// revert the stocks if the order is cancelled
		if ($status == "Cancelled") {
			$order = Orders::get_order($order_id);
			if ($order) {
				$products = json_decode($order['products'], true);
				foreach ($products as $product_id => $quantity) {
					Products::revert_stocks($product_id, $quantity);
				}
			}
		}
			
		$query = "UPDATE checkout_orders SET delivered = '$status' WHERE order_id = '$order_id'";
		$result = @mysqli_query($mysqli, $query);

		return $result;
	}

}

// Other repeatable codes for the website 
class Formats {
	static function display_stocks_left($stocks) {
		if ($stocks <= 15) {
			echo $stocks . "stock/s left";
		} elseif ($stocks == 0) {
			echo "Unavailable";
		}
	}

	static function display_info($id, $info) {
		
		// this is used on checkout.php when user already went to 
		// confirmation.php but went back to checkout.php
		if (isset($_SESSION['checkout'])) {
			return $_SESSION['checkout'][$id];
		}

		// general purpose of the function
		return (isset($_SESSION[$id])) ? $_SESSION[$id] : $info;
	}
}
?>