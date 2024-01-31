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
        $update_query =  @mysqli_query($mysqli, "UPDATE users SET contactnumber = '". $contactnumber['address'] ."' WHERE user_id = '". $_SESSION['id'] ."'");

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

# For Changing and Saving Address and Contact Number after Checking Out
if (isset($_POST['addr_yes']) || isset($_POST['addr_change_yes'])) {
    $addr_sql = mysqli_query($mysqli, "SELECT address FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."'");
    while ($addr_row = mysqli_fetch_array($addr_sql)) {
        $myaddr = $addr_row['address'];
    }
        $add_addr =  mysqli_query($mysqli, "UPDATE users SET Address = '". $myaddr ."' WHERE id = '". $_SESSION['id'] ."' AND Username = '". $_SESSION['username'] ."'");
        $set_addr = mysqli_query($mysqli, "SELECT Address FROM users WHERE id = '". $_SESSION['id'] ."' AND Username = '". $_SESSION['username'] ."'");
        while ($setting_address = mysqli_fetch_array($set_addr)) {
            $myaddress = $setting_address['Address'];
        }
        $_SESSION['address'] = $myaddress;
        if (isset($_POST['addr_yes'])) {
            echo "<script>alert('Successfully Added!');</script>";
        } elseif (isset($_POST['addr_change_yes'])) {
            echo "<script>alert('Address Successfully Changed!');</script>";
        }
}
if (isset($_POST['contactnum_yes']) || isset($_POST['contactnum_change_yes'])) {
    $contact_sql = mysqli_query($mysqli, "SELECT contact_number FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."'");
    while ($contact_row = mysqli_fetch_array($contact_sql)) {
        $mycontact = $contact_row['contact_number'];
    }
        $add_contact =  mysqli_query($mysqli, "UPDATE users SET ContactNumber = '". $mycontact ."' WHERE id = '". $_SESSION['id'] ."' AND Username = '". $_SESSION['username'] ."'");
        $set_contact = mysqli_query($mysqli, "SELECT ContactNumber FROM users WHERE id = '". $_SESSION['id'] ."' AND Username = '". $_SESSION['username'] ."'");
        while ($setting_contact = mysqli_fetch_array($set_contact)) {
            $mynumber = $setting_contact['ContactNumber'];
        }
        $_SESSION['contactnumber'] = $mynumber;
        if (isset($_POST['contactnum_yes'])) {
            echo "<script>alert('Successfully Added!');</script>";
        } elseif (isset($_POST['contactnum_change_yes'])) {
            echo "<script>alert('Contact Number Successfully Changed!');</script>";
        }
}


?>