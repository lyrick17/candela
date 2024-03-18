<?php 

$confirm_error = array("captcha" => "");
$errors = 0;
// confirm checkout

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Captcha Validation
    if ($_POST['formcaptcha'] != "filled") {
        $confirm_error['captcha'] = error_messages("captcha_error");      // captcha not filled
    }

    // error if captcha is not filled
    $errors += ($_POST['formcaptcha'] != "filled");

    if ($errors == 0) {
        
        
        require("process_basket_sync.php");

        if ($less_stocks > 0) {
            echo "<script>alert('Oops! Sorry, the stocks left have been reduced lower than your chosen quantity, please update your basket.')</script>";
            echo "<script>window.location = 'product.php';</script>";
        } else {
            // The order will be processed
            // 1. Create an Order_id 
            // 2. Get the Total Order
            // 3. using session basket, create a json string that would store it in the database
            // 4. Insert all information in checkout_orders table in db (inclluding delivery message)
            // 5. if step 4 is successful, update the stocks in products table
            // 6. remove the basket records in database if user is set
            // 7. unset all  session checkout and baskets
            // 8. set the sesssion order_id after the checkout is successful

            // 1.
            $date = getdate();
            if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
            } else {
                $get_order = Orders::get_recent_checkout_id();
                $id = ($get_order) ? ($get_order['checkout_id'] + 1) % 100 : "00";
            }
            $initial = (isset($_SESSION['id'])) ? "U" : "G";
            $order_id = $initial . "-" .
                        $id . 
                        sprintf("%02d", $date['hours']) . 
                        sprintf("%02d", $date['minutes']) .
                        sprintf("%02d", $date['seconds']) . 
                        sprintf("%02d", $date['mon']) . 
                        sprintf("%02d", $date['mday']) . 
                        sprintf("%04d", $date['year']);

            // 2.
            $shipping_fee = ($_SESSION['subtotal'] < 2000) ? 50 : 0;  
            $total_order = $_SESSION['total'];
            
            // 3.
            $json_basket = json_encode($_SESSION['basket'], JSON_FORCE_OBJECT);

            // 4.
            if (isset($_SESSION['id'])) {
                $delivered = "Order Placed";
                $orders_stmt = mysqli_prepare($mysqli, "INSERT INTO `checkout_orders` 
                                (user_id, order_id, firstname, lastname, email, contactnumber, address, barangay, products, shipping_fee, total, delivered) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($orders_stmt, "issssssssiss", 
                    $_SESSION['id'],
                    $order_id,
                    $_SESSION['checkout']['username'],
                    $_SESSION['checkout']['lastname'],
                    $_SESSION['checkout']['email'],
                    $_SESSION['checkout']['contactnumber'],
                    $_SESSION['checkout']['address'],
                    $_SESSION['checkout']['barangay'],
                    $json_basket,
                    $shipping_fee,
                    $total_order,
                    $delivered);
                    
            } else {
                $orders_stmt = mysqli_prepare($mysqli, "INSERT INTO `checkout_orders` 
                                (order_id, firstname, lastname, email, contactnumber, address, barangay, products, shipping_fee, total, delivered) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($orders_stmt, "ssssssssiss",
                    $order_id,
                    $_SESSION['checkout']['username'],
                    $_SESSION['checkout']['lastname'],
                    $_SESSION['checkout']['email'],
                    $_SESSION['checkout']['contactnumber'],
                    $_SESSION['checkout']['address'],
                    $_SESSION['checkout']['barangay'],
                    $json_basket,
                    $shipping_fee,
                    $total_order,
                    $delivered);
                
            }
            $result = mysqli_stmt_execute($orders_stmt);
            if ($result) {
                // 5.
                foreach ($_SESSION['basket'] as $product_id => $quantity) {
                    $update_stmt = mysqli_prepare($mysqli, "UPDATE `products` SET stocks = stocks - ? WHERE product_id = ?");
                    mysqli_stmt_bind_param($update_stmt, "ii", $quantity, $product_id);
                    mysqli_stmt_execute($update_stmt);

                }
                
                // 6.
                $remove_basket = mysqli_prepare($mysqli, "DELETE FROM `basket_items` WHERE user_id = ?");
                mysqli_stmt_bind_param($remove_basket, "i", $_SESSION['id']);
                mysqli_stmt_execute($remove_basket);
                
                
                // 7.
                unset($_SESSION['basket']);
                unset($_SESSION['subtotal']);
                unset($_SESSION['total']);
                unset($_SESSION['checkout']);

                // 8.
                $_SESSION['recent_order_id'] = $order_id;
                header("Location: success.php");
                exit();
            }

            
        }
    }
}

?>