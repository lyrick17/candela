<?php  
    $no_order_message = "";
    if (isset($_GET['orders'])) {
        if ($_GET['orders'] == 1)
            $no_order_message = "Customers are still shopping. No recent orders have been received yet.";
        elseif ($_GET['orders'] == 2)
            $no_order_message = "Whew. All products have been prepared!";
        elseif ($_GET['orders'] == 3)
            $no_order_message = "No products are on the road yet.";
        elseif ($_GET['orders'] == 3)
            $no_order_message = "No products have been delivered yet.";
        else 
            $no_order_message = "Woohoo! No products are cancelled!";
    } else {
        $no_order_message = "Customers are still shopping. No recent orders have been received yet.";
    }	
    echo $no_order_message;
?>