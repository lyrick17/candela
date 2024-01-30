<?php 
// This process is displayed on the sidebar of product.php


$total = 0;             // will hold the total amount of order
$less_stocks = 0;       // will increment once the stock is less than quantity ordered by user

// ---PROCESS---
// loop through the basket, while also making sure the values in SESSION Basket aligns
//	with the data in the database

// ---STEPS---
// 1. get the name, price and stocks of every product that user has placed in basket
// 2. compare the quantity and stocks,  if there are less stocks, reduce the quantity in user's orderss
// 3. Update or delete the database if user is logged in, otherwise, do not bother changing info in db
// 4. if changes are needed, unset the basket orr reduce the quantity in basket
// 5. compute for total
// 6. if there are changes made, alert the user

foreach ($_SESSION['basket'] as $product_id => $quantity) {

    // 1.
    $productsql_result = Products::get_product_info($product_id);

    if (!$productsql_result) continue; // if product can't be selected, discontinue process

    $product = mysqli_fetch_array($productsql_result, MYSQLI_ASSOC);

    // 2.
    if ($product['stocks'] < $quantity) {
            
        $quantity = $product['stocks'];
        
        // 3. when out of stock, delete the order in basket
        if ($quantity == 0) {
            $delete_order_sql = (isset($_SESSION['id'])) 
                            ? @mysqli_query($mysqli, "DELETE FROM basket_items WHERE user_id = '". $_SESSION['id'] ."' AND product_id = '$product_id'") 
                            : "unregistered";
            
            if (!$delete_order_sql) {
                echo special_error_messages("alert_fail_mysql_del_basket", $product['name']);
                continue;
            }
            // 4.
            unset($_SESSION['basket'][$product_id]);
            $less_stocks++;
            continue;
        }

        // 3. when stock is just lesser than basket quantity
        $update_qty_sql = (isset($_SESSION['id'])) 
                            ? @mysqli_query($mysqli, "UPDATE basket_items SET quantity = '". $quantity ."' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = '$product_id'") 
                            : "unregistered";

        if (!$update_qty_sql) {
            echo special_error_messages("alert_fail_mysql_upd_basket", $product['name']);
            continue;
        }
                            
        // 4.
        $_SESSION['basket'][$product_id] = $quantity;
        $less_stocks++;


    }


    // 5.
    $total = $total + ($quantity * $product['price']);
							
} // end foreach

// 6.
if ($less_stocks > 0) {
    echo error_messages("reduced_order");
}
$_SESSION['subtotal'] = $total;

?>