<?php 
// This file will contain most of the general processes that the website need
require("conn/db_connection.php");
require("sanitize_input.php");


if (!isset($_SESSION['basket'])) {
	$_SESSION['basket'] = array();
}

class Restrict {

	// FUNCTION - used to check if the user is logged in or not
	//  used on webpages when guest user are restricted
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
	
	// FUNCTION - usedd to check if Get ID is being used correctly
	//  or not in  product.php
	static function product_page_access($product_id) {
		global $mysqli;
		$product_info = Products::get_product_info($product_id); 
		if (!$product_info) {
			header("Location: product.php");
			exit();
		}
	
	}

}
// Product Functions
class Products {

    static function select_all() {
        global $mysqli;

        $query = 'SELECT * FROM products ORDER by product_id ASC';
        $result = @mysqli_query($mysqli, $query);
        return ($result || mysqli_num_rows($result) > 0) ? $result : false;
    }

    static function get_product_info($id) {
        global $mysqli;
        if (!isset($id)) return false;

        $id = test_input($mysqli, $id);
        $query = "SELECT * FROM products WHERE product_id = '$id'";
        $result = @mysqli_query($mysqli, $query);
        
        return ($result && mysqli_num_rows($result) > 0) ? $result : false;
    }


}

?>