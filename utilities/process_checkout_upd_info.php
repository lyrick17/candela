<?php 

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['recent_order_id'])) {

    // 1. get the order information using the order id
    // 2. exit when there is an error
    // 3. insert or update the database information
    // 4. change the session variables as well
    // 5. return the response

    // 1.
    $order = Orders::get_order($_SESSION['recent_order_id']);
    

    // 2.
    if (!$order) {
        $response = ['error' => 1, 'type' => ""];
        exit(json_encode($response));
    }
    
    $query_address = false;
    $query_contactnumber = false;  

    // 3.
    if (isset($_POST['insert_address'])) {
        $query_address =  @mysqli_query($mysqli, "INSERT INTO addresses (user_id, user_address, barangay) VALUES ('". $order['user_id'] ."', '". $order['address'] ."', '". $order['barangay'] ."')");
    } elseif (isset($_POST['change_address'])) {
        $query_address =  @mysqli_query($mysqli, "UPDATE addresses SET user_address = '". $order['address'] ."', barangay = '". $order['barangay'] ."' WHERE user_id = '". $order['user_id'] ."'");
    } elseif (isset($_POST['change_contactnum'])) {
        $query_contactnumber =  @mysqli_query($mysqli, "UPDATE users SET contactnumber = '". $order['contactnumber'] ."' WHERE user_id = '". $order['user_id'] ."'");
    }

    // 4.
    if ($query_address) {
        $_SESSION['address'] = $order['address'];
        $_SESSION['barangay'] = $order['barangay'];
        $response = ['error' => 0, 'type' => "address"];
    } elseif ($query_contactnumber) {
        $_SESSION['contactnumber'] = $order['contactnumber'];
        $response = ['error' => 0, 'type' => "contactnumber"];
    } else {
        $response = ['error' => 1, 'type' => ""];
    }

    // 5.
    exit(json_encode($response));
}

?>