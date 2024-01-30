<?php 
// require("conn/db_connection.php");
// require("sanitize_input.php");

$info_error = array("username" => "",
                    "lastname" => "",
                    "email" => "",
                    "contact" => "",
                    "address" => "",
                    "quantity" => "");
$checkout_info = array("username" => "",
                    "lastname" => "",
                    "email" => "",
                    "contact" => "",
                    "address" => "",
                    "barangay" => "");
$errors = 0;
                    
// Contains saving information when user checks out orders:
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['checkout_submit'])) {
    
    
    // -----Username / Firstname
    // must not be empty
    $checkout_info['username'] = test_input($mysqli, $_POST["fName"]) ?? "";

    if (!$checkout_info['username']) {
        $info_error['username'] = error_messages("username_error");     // username is empty
    } elseif (strlen($checkout_info['username']) > 255) {
        $info_error['username'] = error_messages("maxchar_error_255");    // username character is over 255
    }

    // -----Lastname
        // must not be empty   
    $checkout_info['lastname'] = test_input($mysqli, $_POST["LName"]) ?? "";

    if (!$checkout_info['lastname']) {
        $info_error['lastname'] = error_messages("lastname_error");       // lastname is empty
    } elseif (strlen($checkout_info['lastname']) > 255) {
        $info_error['lastname'] = error_messages("maxchar_error_255");    // lastname character is over 255
    }

    // -----Email
        // must not be empty
        // must be unique and valid
        // must be less than or equal to 100 characters
    $checkout_info['email'] = test_input($mysqli, $_POST['email']) ?? "";

    if (!$checkout_info['email']) {
        $info_error['email'] = error_messages("email_error_1");        // email is empty
    } elseif (strlen($checkout_info['email']) > 100) {
        $info_error['email'] = error_messages("maxchar_error_100");    // email character is over 100
    } elseif (!filter_var($checkout_info['email'], FILTER_VALIDATE_EMAIL)) {
        $info_error['email'] = error_messages("email_error_2");        // email is not valid
    } elseif (!Users::verify_email($checkout_info['email'])  && $checkout_info['email'] != $_SESSION['email']) {
        $info_error['email'] = error_messages("email_error_3");        // email is already takeen
    }

    
    // -----Contact Number
        // must start with 09
        // must have 11 characters
        // all digits
        // optional
    $checkout_info['contact'] = test_input($mysqli, $_POST['contactnum']) ?? "";
    if (!$checkout_info['contact']) {
        $info_error['contact'] = error_messages("contact_error_1");        // contact is empty
    } elseif (!preg_match("/^(09)\d{9}$/",$checkout_info['contact'])) {
        $info_error['contact'] = error_messages("contact_error_2");        // contact is not valid
    }

    // -----Address
        // must not be empty
        // must be less than or equal to 255 characters
    $checkout_info['address'] = test_input($mysqli, $_POST['addr']) ?? "";
    if (!$checkout_info['address']) {
        $info_error['address'] = error_messages("address_error_1");        // address is empty
    }

    require("information/barangay_info.php");
    $checkout_info['barangay'] = test_input($mysqli, $_POST['barangay']) ?? "";
    if ($checkout_info['address'] && !in_array($checkout_info['barangay'], $barangay)) {
        $info_error['address'] = error_messages("barangay_error");        // barangay is not valid
    }

    // error if captcha is not filled
    // compile the errors, once $error is incremented, there is error found
    $errors += $info_error['username'] ? $errors + 1 : $errors;
    $errors += $info_error['lastname'] ? $errors + 1 : $errors;
    $errors += $info_error['email'] ? $errors + 1 : $errors;
    $errors += $info_error['contact'] ? $errors + 1 : $errors;
    $errors += $info_error['address'] ? $errors + 1 : $errors;

    if (isset($_SESSION['id'])) {
        // if user is logged in, we will check first if quantity in SESSION matches the quantity in Database
        foreach ($_SESSION['basket'] as $product_id => $quantity) {
            $product_quantity = Basket::get_quantity($_SESSION['id'], $product_id);
            if ($product_quantity && $product_quantity['quantity'] == $quantity) {
                continue;
            }
            // provide an error if quantity in SESSION does not match the quantity in Database
            $info_error['quantity'] = error_messages("quantity_error");
            $errors++;
            echo "<script>alert('Your quantity orders do not match in our records. Please contact the Candela Team.')</script>";
            echo "<script>window.location = 'product.php'; </script>";
        }
    }


    if ($errors == 0 && isset($_SESSION['basket'])) {

        require("process_basket_sync.php");

        if ($less_stocks > 0) {
            echo "<script>alert('Oops! Sorry, the stocks left have been reduced lower than your chosen quantity, please update your basket.')</script>";
            echo "<script>window.location = 'product.php';</script>";
        } else {
            // if there are no errors, we will save the information in SESSION and proceed to payment page

            $_SESSION['checkout'] = array();
            $_SESSION['checkout']['username'] = $checkout_info['username'];
            $_SESSION['checkout']['lastname'] = $checkout_info['lastname'];
            $_SESSION['checkout']['email'] = $checkout_info['email'];
            $_SESSION['checkout']['contact'] = $checkout_info['contact'];
            $_SESSION['checkout']['address'] = $checkout_info['address'];
            $_SESSION['checkout']['barangay'] = $checkout_info['barangay'];
            
            $need_confirm = "set";

            header("Location: confirmation.php");
            exit();

        }
    }
} // end if statement for Checkout Forms...





?>