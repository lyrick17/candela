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
}
?>