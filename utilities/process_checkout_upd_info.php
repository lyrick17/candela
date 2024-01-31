<?php 


if ($_SERVER['REQUEST_METHOD'] = "POST" && isset($_SESSION['recent_order_id'])) {


if (isset($_POST['change_address'])) {
    $address = Orders::get_address($_SESSION['recent_order_id']);
    if ($address) {
        $update_query =  @mysqli_query($mysqli, "UPDATE addresses SET address = '". $address['address'] ."', barangay = '". $address['barangay'] ."' WHERE user_id = '". $_SESSION['id'] ."'");


        if ($update_query) {
            $_SESSION['address'] = $address['address'];
            $_SESSION['barangay'] = $address['barangay'];
            $response = ["error" => 0];
        } else {
            $response = ["error" => 1];
        }
        
        exit(json_encode($response));
    }
}
if (isset($_POST['change_contact_num'])) {
    $contactnumber = Orders::get_contact_number($_SESSION['recent_order_id']);
    if ($contactnumber) {
        $update_query =  @mysqli_query($mysqli, "UPDATE users SET contactnumber = ". $contactnumber['contactnumber'] ." WHERE user_id = '". $_SESSION['id'] ."'");
        $response = ["error" => 2];
        exit($response);
        if ($update_query) {
            $_SESSION['contactnumber'] = $contactnumber['contactnumber'];
            $response = ["error" => 0];
        } else {
            $response = ["error" => 1];
        }
        
        exit(json_encode($response));
    }
}


}


?>