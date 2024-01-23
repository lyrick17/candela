<?php
require("conn/db_connection.php");

require("sanitize_input.php");


$notice = array("firstname" => "",
                "lastname" => "",
                "email" => "",
                "number" => "",
                "address" => "",
                "password" => "",
                "deleteaccount" => "");
$success = array("firstname" => "",
                "lastname" => "",
                "email" => "",
                "number" => "",
                "address" => "",
                "password" => "");
$mydetails = array("firstname" => "",
                    "lastname" => "",
                    "email" => "",
                    "number" => "",
                    "address" => "",
                    "barangay" => "");

//changing general account details in myaccount.php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == "general") {
    
    // Firstname
    $mydetails['firstname'] = testInput($mysqli, $_POST["myfirstname"]) ?? "";
    if (!$mydetails['firstname']) {                  
        $notice['firstname'] = error_messages("username_error");              // user left empty field    
    } elseif (strlen($mydetails['firstname']) > 255) {
        $notice['firstname'] = error_messages("maxchar_error_255");     // user max 255 characters
    } elseif ($mydetails['firstname'] != $_SESSION['username']) {
        $firstname_update_sql = "UPDATE users SET username = '". $mydetails['firstname'] ."' WHERE user_id = '". $_SESSION['id'] ."'";
        $firstname_update_sqlresult = @mysqli_query($mysqli, $firstname_update_sql);
        if ($firstname_update_sqlresult) {
            $success['firstname'] = success_messages("update_successful");
            $_SESSION['username'] = $mydetails['firstname'];
        } else {
            $notice['firstname'] = error_messages("system_error");
        }
    }

    // Lastname
    $mydetails['lastname'] = testInput($mysqli, $_POST['mylastname']) ?? "";
    if (!$mydetails['lastname']) {                  
        $notice['lastname'] = error_messages("lastname_error");              // user left empty field    
    } elseif (strlen($mydetails['lastname']) > 255) {
        $notice['lastname'] = error_messages("maxchar_error_255");     // user max 255 characters
    } elseif ($mydetails['lastname'] != $_SESSION['lastname']) {
        $lastname_update_sql = "UPDATE users SET lastname = '". $mydetails['lastname'] ."' WHERE user_id = '". $_SESSION['id'] ."'";
        $lastname_update_sqlresult = @mysqli_query($mysqli, $lastname_update_sql);
        if ($lastname_update_sqlresult) {
            $success['lastname'] = success_messages("update_successful");
            $_SESSION['lastname'] = $mydetails['lastname'];
        } else {
            $notice['lastname'] = error_messages("system_error");
        }
    }

    // Email
    $mydetails['email'] = testInput($mysqli, $_POST['myemail']) ?? "";

    $emailcheck = "SELECT * FROM `users` WHERE email = '".$mydetails['email']."'";
    $emailresult = mysqli_query($mysqli, $emailcheck);
    $emailcount = mysqli_num_rows($emailresult);

    if (!$mydetails['email']) {                  
        $notice['email'] = error_messages("email_error_1");                   // user left empty field    
    } elseif (strlen($mydetails['email']) > 100) {
        $notice['email'] = error_messages("maxchar_error_100");     // user max 255 characters
    } elseif (!filter_var($mydetails['email'],FILTER_VALIDATE_EMAIL)) {
        $notice['email'] = error_messages("email_error_2");              // invalid email
    } elseif ($emailcount == 1 && $mydetails['email'] != $_SESSION['email']) {
        $notice['email'] = error_messages("email_error_3");                       // email already taken
    } elseif ($mydetails['email'] != $_SESSION['email']) {
        $email_update_sql = "UPDATE users SET email = '". $mydetails['email'] ."' WHERE user_id = '". $_SESSION['id'] ."'";
        $email_update_sqlresult = @mysqli_query($mysqli, $email_update_sql);
        if ($email_update_sqlresult) {
            $success['email'] = "Successfully changed";
            $_SESSION['email'] = $mydetails['email'];
        } else {
            $notice['email'] = error_messages("system_error");
        }
    }

    // Contact Number
    $mydetails['number'] = testInput($mysqli, $_POST['mynumber']) ?? "";
    if ($mydetails['number'] && !preg_match("/^(09)\d{9}$/",$mydetails['number'])) {
        $notice['number'] = error_messages("contact_error");            // phone num not valid
    } elseif ($mydetails['number'] != $_SESSION['contactnumber']) {
        $number_update_sql = "UPDATE users SET contactnumber = '". $mydetails['number'] ."' WHERE user_id = '". $_SESSION['id'] ."'";
        $number_update_sqlresult = @mysqli_query($mysqli, $number_update_sql);
        if ($number_update_sqlresult) {
            $success['number'] = success_messages("update_successful");
            $_SESSION['contactnumber'] = $mydetails['number'];
        } else {
            $notice['number'] = error_messages("system_error");
        }
    }


    
} // end if change general new account information




//changing address details in myaccount.php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == "address") {
    // Address of User
    $mydetails['address'] = testInput($mysqli, $_POST["myaddress"]) ?? "";
    $mydetails['barangay'] = testInput($mysqli, $_POST["barangay"]) ?? "";

    if (!$mydetails['address'] || $mydetails['barangay'] == "- Select Your Barangay -") {                  
        $notice['address'] = error_messages("address_error");              // user did not complete address, user left empty on address    
    } elseif (($mydetails['address'] != $_SESSION['address']) || ($mydetails['barangay']  != $_SESSION['barangay'])) {
        $address_update_sql = "UPDATE addresses SET user_address = '". $mydetails['address'] ."', barangay = '". $mydetails['barangay'] ."' WHERE user_id = '". $_SESSION['id'] ."'";
        $address_update_sqlresult = @mysqli_query($mysqli, $address_update_sql);
        if ($address_update_sqlresult) {
            $success['address'] = success_messages("update_successful");
            $_SESSION['address'] = $mydetails['address'];
            $_SESSION['barangay'] = $mydetails['barangay'];
        } else {
            $notice['address'] = error_messages("system_error");
        }
    }
}




//changing password in myaccount.php
$pass_error = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == "password") {
    $password = $_POST['oldpassword'] ?? "";
    $newpassword = $_POST['newpassword'] ?? "";
    $confirmpassword = $_POST['confirmpassword'] ?? "";

    // get hashed password in database for it to be compared
    $q1 = "SELECT password FROM users WHERE `user_id` = '". $_SESSION['id'] ."'";
    $result1 = @mysqli_query($mysqli, $q1);
    $row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
    $hashed_pass = $row['password'];


    if (!$password || !$newpassword || !$confirmpassword) {
        $notice['password'] = error_messages("psw_error_5"); $pass_error++;
    } elseif (!password_verify($password, $hashed_pass)) {
        $notice['password'] = error_messages("psw_error_6"); $pass_error++;
    } elseif ($newpassword != $confirmpassword) {
        $notice['password'] = error_messages("psw_error_4"); $pass_error++;
    } elseif (strlen($newpassword) < 8) {
        $notice['password'] = error_messages("psw_error_2"); $pass_error++;
    } elseif ($newpassword == $password) {
        $notice['password'] = error_messages("psw_error_7"); $pass_error++;
    }

    if ($pass_error == 0) {
        $newpassword = password_hash($newpassword, PASSWORD_BCRYPT);
        $q2 = "UPDATE users SET password = '". $newpassword ."' WHERE `user_id` = '". $_SESSION['id'] ."'";
        $result2 = @mysqli_query($mysqli, $q2);
        if ($result2) {
            $success['password'] = success_messages("update_successful");
        } else {
            $notice['password'] = error_messages("system_error");
        }
    }
}




//delete account validation first in myaccount.php
$del_process = "";
$deletevalue = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == "deleteaccount") {
    
    // get hashed password in database for it to be compared
    $q1 = "SELECT password FROM users WHERE `user_id` = '". $_SESSION['id'] ."'";
    $result1 = @mysqli_query($mysqli, $q1);
    $row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
    $hashed_pass = $row['password'];

    $verify_order_sql = mysqli_query($mysqli,"SELECT * FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."' AND delivered = '' ") or die("Failed to Get User's Information");
    $chk_count = mysqli_num_rows($verify_order_sql);

    if (empty($_POST['mypassword'])) {
        $notice['deleteaccount'] = error_messages("psw_error_1");
    } elseif (!password_verify($_POST['mypassword'], $hashed_pass)) {
        $notice['deleteaccount'] = error_messages("psw_error_6");
    } elseif ($chk_count > 0) {
        $notice['deleteaccount'] = error_messages("cant_delete_account");
    } else {
        $deletevalue = "yes";
    }
}

// process when user agreed on deleting the account
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['Sure'])) {
    $delete_user_chk = mysqli_query($mysqli, "DELETE FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."' AND delivered = 'Delivered' ") or die("Unable to delete orders");
    $delete_user_bas = mysqli_query($mysqli, "DELETE FROM basket_items WHERE user_id = '". $_SESSION['id'] ."'") or die("Unable to delete basket");
    $delete_user_acc = mysqli_query($mysqli, "DELETE FROM addresses WHERE user_id = '". $_SESSION['id'] ."'") or die("Unable to delete information");
    $delete_user_acc = mysqli_query($mysqli, "DELETE FROM contacts WHERE user_id = '". $_SESSION['id'] ."'") or die("Unable to delete information");
    $delete_user_acc2 = mysqli_query($mysqli, "DELETE FROM users WHERE user_id = '". $_SESSION['id'] ."'") or die("Unable to delete information");
    echo "<script> alert('We're Sorry To See You Go.'); </script>";
    
    header("location: logout.php");
} elseif (isset($_POST['Nope'])) {
    unset($_POST['deleteAcc']);
    header("location: myaccount.php");
}

?>