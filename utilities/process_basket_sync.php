<?php 
// This process is displayed on the sidebar of product.php


$total = 0;             // will hold the total amount of order
$less_stocks = 0;       // will increment once the stock is less than quantity ordered by user

// ---PROCESS---
// loop through the basket, while also making sure the values in SESSION Basket aligns
//	with the data in the database

// ---STEPS---
// 1. get the name, price and stocks of every product that user has placed in basket
// 2. check if the product is still available, else remove them from basket
// 3. compare the quantity and stocks,  if there are less stocks, reduce the quantity in user's orderss
// 4. Update or delete the database if user is logged in, otherwise, do not bother changing info in db
// 5. if changes are needed, unset the basket orr reduce the quantity in basket
// 6. compute for total
// 7. if there are changes made, alert the user

foreach ($_SESSION['basket'] as $product_id => $quantity) {

    // 1.
    $productsql_result = Products::get_product_info_hide($product_id, 0);

    // must sync hidden products or not
    // consider the get_product_info transitioning to get_product_info_hide

    // 2. if products can't be selected, remove the product
    if (!$productsql_result) {
        $delete_order_sql = (isset($_SESSION['id'])) 
                            ? @mysqli_query($mysqli, "DELETE FROM basket_items WHERE user_id = '". $_SESSION['id'] ."' AND product_id = '$product_id'") 
                            : "unregistered";
        if (!$delete_order_sql) {
            echo special_error_messages("alert_fail_mysql_del_basket", $product['name']);
        }

        unset($_SESSION['basket'][$product_id]);
        $less_stocks++;
        continue;
    } // 

    $product = mysqli_fetch_array($productsql_result, MYSQLI_ASSOC);



    // 3.
    if ($product['stocks'] < $quantity) {
            
        $quantity = $product['stocks'];
        
        // 4. when out of stock, delete the order in basket
        if ($quantity == 0) {
            $delete_order_sql = (isset($_SESSION['id'])) 
                            ? @mysqli_query($mysqli, "DELETE FROM basket_items WHERE user_id = '". $_SESSION['id'] ."' AND product_id = '$product_id'") 
                            : "unregistered";
            
            if (!$delete_order_sql) {
                echo special_error_messages("alert_fail_mysql_del_basket", $product['name']);
                continue;
            }
            // 5.
            unset($_SESSION['basket'][$product_id]);
            $less_stocks++;
            continue;
        }

        // 4. when stock is just lesser than basket quantity
        $update_qty_sql = (isset($_SESSION['id'])) 
                            ? @mysqli_query($mysqli, "UPDATE basket_items SET quantity = '". $quantity ."' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = '$product_id'") 
                            : "unregistered";

        if (!$update_qty_sql) {
            echo special_error_messages("alert_fail_mysql_upd_basket", $product['name']);
            continue;
        }
                            
        // 5.
        $_SESSION['basket'][$product_id] = $quantity;
        $less_stocks++;


    }


    // 5.
    $total = $total + ($quantity * $product['price']);
							
} // end foreach

// 7.
if ($less_stocks > 0) {
    echo error_messages("reduced_order");
}
$_SESSION['subtotal'] = $total;

?>