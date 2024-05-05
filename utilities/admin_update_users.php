<?php 
// For updates on Prices and Stocks
$changes = 0;

$edit = array('id' => '',
              'username' => '',
              'lastname' => '',
              'email' => '',
              'contact' => '',
              'address' => '',
              'barangay' => '',
              'adminpass' => '');
$errors = 0;
$specialerrors = 0;
$changes = 0;
$updateerrors = 0;
$errormsg = array();
$successfulupdate = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    /*
    username
    lastname
    email
    contactnumber
    address
    barangayvalue
    adminpass
    usersubmit
    */
    
    $edit['id'] = test_input($mysqli, $_GET['id']) ?? "";

    
    // NOTE, CHECK IF ADMIN PASSWORD IS CORRECT FIRST BEFORE PROCEEDING ON EDITING EVERYTHING
    // -----Admin Password
    $edit['adminpass'] = $_POST['adminpass'];
    
    if (!$edit['adminpass']) {
        array_push($errormsg, error_messages("psw_error_1"));    // admin password is empty
        $specialerrors++;
    } else {

        $pass = Users::get_password($_SESSION['id']);

        if ($pass) {
            $hashed_pass = $pass['password'];
            if (!password_verify($edit['adminpass'], $hashed_pass)) {
                array_push($errormsg, error_messages("psw_error_6"));    // admin password is incorrect
                $specialerrors++;
            }
        } else {
            array_push($errormsg, error_messages("system_error"));
            $specialerrors++;
        }

    }
    
    if ($specialerrors == 0) {

        $userlist = Users::select_info($edit['id']); 
        $user = mysqli_fetch_array($userlist, MYSQLI_ASSOC);
    
        if (!$user) { 
            $errors++;
            array_push($errormsg, "User not found in the database. Contact the Development Team.");
        } else {
    
            // -----Username / Firstname
            $edit['username'] = test_input($mysqli, $_POST["username"]) ?? "";
    
            if (!$edit['username']) {
                array_push($errormsg, error_messages("username_error"));     // username is empty
                $errors++;
            } elseif (strlen($edit['username']) > 255) {
                array_push($errormsg, error_messages("maxchar_error_255"));  // username character is over 255
                $errors++;
            } elseif ($edit['username'] != $user['username']) {
                $changes++;
            }
    
            // -----Lastname 
            $edit['lastname'] = test_input($mysqli, $_POST["lastname"]) ?? "";
    
            if (!$edit['lastname']) {
                array_push($errormsg, error_messages("lastname_error"));       // lastname is empty
                $errors++;
            } elseif (strlen($edit['lastname']) > 255) {
                array_push($errormsg, error_messages("maxchar_error_255"));    // lastname character is over 255
                $errors++;
            } elseif ($edit['lastname'] != $user['lastname']) {
                $changes++;
            }
    
            // -----Email
            $edit['email'] = test_input($mysqli, $_POST['email']) ?? "";
    
            if (!$edit['email']) {
                array_push($errormsg, error_messages("email_error_1"));        // email is empty
                $errors++;
            } elseif (strlen($edit['email']) > 100) {
                array_push($errormsg, error_messages("maxchar_error_100"));    // email character is over 100
                $errors++;
            } elseif (!filter_var($edit['email'], FILTER_VALIDATE_EMAIL)) {
                array_push($errormsg, error_messages("email_error_2"));        // email is not valid
                $errors++;
            } elseif (!Users::verify_email($edit['email']) && $edit['email'] != $user['email']) {
                array_push($errormsg, error_messages("email_error_3"));        // email is already takeen
                $errors++;
            } elseif ($edit['email'] != $user['email']) {
                $changes++;
            }
    
            // -----Contact Number
            
            $edit['contact'] = test_input($mysqli, $_POST['contactnumber']) ?? "";
            if ($edit['contact'] && !preg_match("/^(09)\d{9}$/",$edit['contact'])) {
                array_push($errormsg, error_messages("contact_error_2"));       // phone num not valid
                $errors++;
            } elseif ($edit['contact'] != $user['contactnumber']) {
                $changes++;
            }
    
            // -----Address
    
            $edit['address'] = test_input($mysqli, $_POST['address']) ?? "";
    
            if (!$edit['address'] && $user['user_address'] != '') {
                array_push($errormsg, error_messages("address_error_1"));       // address is empty
                $errors++;
            } elseif ($edit['address'] != $user['user_address']) {
                $changes++;
            }
    
            // -----Barangay
            require("information/barangay_info.php");
    
            $edit['barangay'] = test_input($mysqli, $_POST['barangay']) ?? "";
    
            if ($user['barangay'] != '') {
                // user has chosen a barangay
                if (!in_array($edit['barangay'], $barangay)) {
                    array_push($errormsg, error_messages("barangay_error"));        // barangay not valid
                    $errors++;
                } elseif ($edit['barangay'] != $user['barangay']) {
                    $changes++;
                }
            } elseif ($edit['barangay'] != "- Select Your Barangay -") {
                // user has not chosen a barangay but admin  will choose one
                if (!in_array($edit['barangay'], $barangay)) {
                    array_push($errormsg, error_messages("barangay_error"));        // barangay not valid
                    $errors++;
                } else {
                    $changes++;
                }
            }
    
            if ($changes > 0 && $errors == 0) {
                // username update
                if ($edit['username'] != $user['username']) {
                    $username_update_sql = "UPDATE users SET username = '". $edit['username'] ."' WHERE user_id = '". $edit['id'] ."'";
                    $username_update_sqlresult = @mysqli_query($mysqli, $username_update_sql);
                    if ($username_update_sqlresult) {
                        array_push($successfulupdate, success_messages("admin_username_edit_successful"));
                    } else {
                        $updateerrors++;
                    }
                }

                // lastname update
                if ($edit['lastname'] != $user['lastname']) {
                    $lastname_update_sql = "UPDATE users SET lastname = '". $edit['lastname'] ."' WHERE user_id = '". $edit['id'] ."'";
                    $lastname_update_sqlresult = @mysqli_query($mysqli, $lastname_update_sql);
                    if ($lastname_update_sqlresult) {
                        array_push($successfulupdate, success_messages("admin_lastname_edit_successful"));
                    } else {
                        $updateerrors++;
                    }
                }

                // email update
                if ($edit['email'] != $user['email']) {
                    $email_update_sql = "UPDATE users SET email = '". $edit['email'] ."' WHERE user_id = '". $edit['id'] ."'";
                    $email_update_sqlresult = @mysqli_query($mysqli, $email_update_sql);
                    if ($email_update_sqlresult) {
                        array_push($successfulupdate, success_messages("admin_email_edit_successful"));
                    } else {
                        $updateerrors++;
                    }
                }

                // contact number update
                if ($edit['contact'] != $user['contactnumber']) {
                    $contact_update_sql = "UPDATE users SET contactnumber = '". $edit['contact'] ."' WHERE user_id = '". $edit['id'] ."'";
                    $contact_update_sqlresult = @mysqli_query($mysqli, $contact_update_sql);
                    if ($contact_update_sqlresult) {
                        array_push($successfulupdate, success_messages("admin_contactnumber_edit_successful"));
                    } else {
                        $updateerrors++;
                    }
                }
                // address update
                if ($user['user_address'] == '' &&  $edit['address'] != '') {
                    // user does not have an address yet
                    if ($user['barangay'] == '') {
                        // user does not have address db yet
                        $address_update_sql = "INSERT INTO addresses (user_id, user_address) VALUES ('". $edit['id'] ."', '". $edit['address'] ."')";
                    } else {
                        // user has address db already
                        $address_update_sql = "UPDATE addresses SET user_address = '". $edit['address'] ."' WHERE user_id = '". $edit['id'] ."'";
                    }
                    $address_update_sqlresult = @mysqli_query($mysqli, $address_update_sql);
                    if ($address_update_sqlresult) {
                        array_push($successfulupdate, success_messages("admin_address_edit_successful"));
                        $user['user_address'] = $edit['address'];
                    } else {
                        $updateerrors++;
                    }
                } elseif ($edit['address'] != $user['user_address']) {
                    // user has an address and admin wants to change it
                    $address_update_sql = "UPDATE addresses SET user_address = '". $edit['address'] ."' WHERE user_id = '". $edit['id'] ."'";
                    $address_update_sqlresult = @mysqli_query($mysqli, $address_update_sql);
                    if ($address_update_sqlresult) {
                        array_push($successfulupdate, success_messages("admin_address_edit_successful"));
                    } else {
                        $updateerrors++;
                    }
                }


                // barangay update
                if ($user['barangay'] == '' && $edit['barangay'] != "- Select Your Barangay -") {
                    if ($user['user_address'] == '') {
                        // user alr has no db info of address
                        $barangay_update_sql = "INSERT INTO addresses (user_id, barangay) VALUES ('". $edit['id'] ."', '". $edit['barangay'] ."')";
                    } else {
                        // user alr has db info of address
                        $barangay_update_sql = "UPDATE addresses SET barangay = '". $edit['barangay'] ."' WHERE user_id = '". $edit['id'] ."'";
                    }
                    $barangay_update_sqlresult = @mysqli_query($mysqli, $barangay_update_sql);
                    if ($barangay_update_sqlresult) {
                        array_push($successfulupdate, success_messages("admin_barangay_edit_successful"));
                        $user['barangay'] = $edit['barangay'];
                    } else {
                        $updateerrors++;
                    }

                } elseif ($edit['barangay'] != $user['barangay'] && $edit['barangay'] != "- Select Your Barangay -") {
                    $barangay_update_sql = "UPDATE addresses SET barangay = '". $edit['barangay'] ."' WHERE user_id = '". $edit['id'] ."'";
                    $barangay_update_sqlresult = @mysqli_query($mysqli, $barangay_update_sql);
                    if ($barangay_update_sqlresult) {
                        array_push($successfulupdate, success_messages("admin_barangay_edit_successful"));
                    } else {
                        $updateerrors++;
                    }
                }

                if ($updateerrors > 0) {
                    array_push($errormsg, "Failed to update some information. Contact the Development Team.");
                    $errors++;
                }

            }
    
    
        }
        
    }

}