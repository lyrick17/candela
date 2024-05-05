<?php 
// require("utilities/server.php"); // this file is called from FetchAPI, so we need to require the server
$status_change = '';
$color = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $errors = 0;
    $success = 0;

    foreach ($_POST as $order_id => $status) {

        if ($order_id == 'orders') continue; // skip the status key (not an order_id

        $order_id = test_input($mysqli, $order_id);
        $status = test_input($mysqli, $status);
        $status_messages = ['Order Placed', 'Product Prepared', 'Out for Delivery', 'Delivered', 'Cancelled'];
        if (!in_array($status, $status_messages)) {
            $color = 'text-danger';
            $status_change = 'Status is not valid.';
            $errors++;
            continue;
        }
        
        if (!$order_id) {
            $color = 'text-danger';
            $status_change = 'Order ID is not valid.';
            $errors++;
            continue;
        }

        if ($_POST['orders'] == 1 && $status == "Order Placed") {
            continue;
        } elseif ($_POST['orders'] == 2 && $status == "Product Prepared") {
            continue;
        } elseif ($_POST['orders'] == 3 && $status == "Out for Delivery") {
            continue;
        } elseif ($_POST['orders'] == 4 && $status == "Delivered") {
            continue;
        } elseif ($_POST['orders'] == 5 && $status == "Cancelled") {
            continue;
        }
        $update = Orders::update_status($order_id, $status);
        if ($update) {
            $color = 'text-success';
            $status_change = 'Changes saved';
            $success++;
        } else {
            $color = 'text-danger';
            $status_change = 'Failed to change status.';
            $errors++;
        }
    }

    if ($errors == 0 && $success > 0) {
        $color = 'text-success';
        $status_change = 'Changes saved';
    } elseif ($success == 0 && $errors > 0) {
        $color = 'text-danger';
        $status_change = 'Failed to change all status.';
    } elseif ($success > 0 && $errors > 0) {
        $color = 'text-warning';
        $status_change = 'Some changes saved, some failed.';
    }
    
}
?>