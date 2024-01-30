<?php 

// Processes for User Basket and saving orders on Basket


    // User adds item on Basket
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["add_to_basket"])) {
    // $_SESSION['basket']['product_id'] = $quantity_of_order;

    $_POST['product_id'] = test_input($mysqli, $_POST['product_id']);
    $_POST['quantity'] = test_input($mysqli, $_POST['quantity']);
    
    // over order handles when user orders more products than actual stocks we have
    $over_order = 0;
    if (isset($_SESSION['basket'][$_POST['product_id']])) {
        $stocks = Products::get_stocks($_POST['product_id']);
        if ($stocks)  {
            $over_order = ($_SESSION['basket'][$_POST['product_id']] >= $stocks['stocks']) ? 1 : 0;
        }
    }

    // 1. Check if quantity ordered is less than stocks
    // 2. Check if User is logged inn or not, this determines if the basket will be saved on the database
    // 3. If logged in, save the order or update the quantity of the order
    // 4. Else, just update the Session Basket for the guest user

    // 1.
    if ($over_order == 0) {
        // 2.
        if (isset($_SESSION['id'])) {

            // 3.
            if (!isset($_SESSION['basket'][$_POST['product_id']])) {	
                // First order of the product
                $_SESSION['basket'][$_POST['product_id']] = $_POST['quantity'];
                $query = mysqli_prepare($mysqli, "INSERT INTO basket_items (user_id, product_id, quantity) VALUES (?,?,?)");
                mysqli_stmt_bind_param($query, "sss", $_SESSION['id'], $_POST['product_id'], $_POST['quantity']);
            } else {									
                // Increase the quantity
                $_SESSION['basket'][$_POST['product_id']] += $_POST['quantity'];
                $query = mysqli_prepare($mysqli, "UPDATE basket_items SET quantity = ? WHERE user_id = ? AND product_id = ?");
                mysqli_stmt_bind_param($query, "sss", $_SESSION['basket'][$_POST['product_id']], $_SESSION['id'], $_POST['product_id']);
            }
            $result = mysqli_stmt_execute($query);
            
            if (!$result) {
                echo error_messages("alert_fail_add_basket");
            }
    
        // 4.
        } else {
            if (isset($_SESSION['basket'][$_POST['product_id']])) {
                // First order of the product
                $_SESSION['basket'][$_POST['product_id']] += $_POST['quantity'];
            } else {
                // Increase the quantity
                $_SESSION['basket'][$_POST['product_id']] = $_POST['quantity'];
            }
        }
    } else {
        echo error_messages("alert_maximum_product");
    }
   


    
}


    // User deletes item from Basket
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['remove_item'])) {

    $_POST['product_id'] = test_input($mysqli, $_POST['product_id']);

    if (isset($_SESSION['id'])) {
        $query = mysqli_prepare($mysqli, "DELETE FROM basket_items WHERE user_id = ? AND product_id = ?");
        mysqli_stmt_bind_param($query, "ii", $_SESSION['id'], $_POST['product_id']);
        $result = mysqli_stmt_execute($query);
        if (!$result) {
            echo error_messages("alert_fail_remove_basket");
        }
    } 
    unset($_SESSION['basket'][$_POST['product_id']]);
    
}


    // User clears the basket
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['clear_basket'])) {
    if (isset($_SESSION['id'])) {
        $query = mysqli_prepare($mysqli, "DELETE FROM basket_items WHERE user_id = ?");
        mysqli_stmt_bind_param($query, "i", $_SESSION['id']);
        $result = mysqli_stmt_execute($query);
        if (!$result) {
            echo error_messages("alert_fail_clear_basket");
        }
    }
    unset($_SESSION['basket']);
    unset($_SESSION['subtotal']);
    
}

?>