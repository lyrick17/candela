<?php 

// Contains sanitization of user inputs:
function test_input($mysqli, $data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($mysqli, $data);
    
    return $data;
}

// contains error messages for registration, contactform, editing user account
function error_messages($error) {
    switch ($error) {
        // for general
        case "maxchar_error_255":
            return "Only maximum of 255 characters are allowed";
            break;
        case "maxchar_error_100":
            return "Only maximum of 100 characters are allowed";
            break;
        case "maxchar_error_2000":
            return "Only maximum of 2000 characters are allowed";
            break;
        case "captcha_error":
            return "Please Fill up the Captcha";
            break;

        // for general fields registration
        case "username_error":
            return "Please enter your First Name / Username";
            break;
        case "name_error":
            return "Please enter your Name";
            break;
        case "lastname_error":
            return "Please enter your Last Name";
            break;
        case "email_error_1":
            return "Please enter your Email";
            break;
        case "email_error_2":
            return "Invalid Email format";
            break;
        case "email_error_3":
            return "Email Already Taken";
            break;
        case "contact_error_1":
            return "Please enter your Contact Number";
            break;
        case "contact_error_2":
            return "Invalid Phone Number format";
            break;
        case "psw_error_1":
            return "Please enter your Password";
            break;
        case "psw_error_2":
            return "Password must be at least 8 characters";
            break;
        case "psw_error_3":
            return "Please confirm your password";
            break;
        case "psw_error_4":
            return "Passwords Don't Match";
            break;
        case "psw_error_5":
            return "Please complete the form to change password";
            break;
        case "psw_error_6":
            return "That is not your password";
            break;
        case "psw_error_7":
            return "New password must be different from old password";
            break;
        
        
        // for login
        case "login_error_1":
            return "Please enter your Email or Password";
            break;
        case "login_error_2":
            return "Invalid Email or Password";
            break;
    

        // for contact form
        case "comment_error":
            return "Please enter your Feedback";
            break;
        case "subject_error":
            return "Please enter the Title/Subject";
            break;

        // for editing User Address
        case "address_error":
            return "Please complete the address";
            break;
        case "barangay_error":
            return "Please select a valid Barangay";
            break;

        // for system failure
        case "system_error":
            return "System Error. Please contact the Candela Team";
            break;

        case "cant_delete_account":
            return "You cannot delete your account with order on process";
            break;


        case "alert_fail_add_basket":
            return "<script>alert('Failed to add item to basket. Please contact the Candela Team.');</script>";
            break;
            
        case "alert_fail_remove_basket":
            return "<script>alert('Failed to remove item from basket. Please contact the Candela Team.');</script>";
            break;
            
        case "alert_fail_clear_basket":
            return "<script>alert('Failed to clear the basket. Please contact the Candela Team.');</script>";
            break;

        case "alert_maximum_product":
            return "<script>alert('Sorry, you have ordered the maximum amount of the product available.');</script>";
            break;
        case "reduced_order":
            return "<script>alert('Sorry, some of your orders have been reduced its quantity or removed. We have less stocks than your chosen quantity or the product has been removed.')</script>";
            break;
        }
}

// Error messages that contains specific names
function special_error_messages($error, $name) {
    switch ($error) {
        
        case "alert_fail_mysql_del_basket":
            return "<script>alert('Cannot delete the basket due to no more stocks available on product " . $name . ". Please contact the Candela team');</script>";
            break;
            
        case "alert_fail_mysql_upd_basket":
            return "<script>alert('Cannot update the basket to match records in our Database on product " . $name . ". Please contact the Candela team');</script>";
            break;
    
    }
}
// contains messages when  process is successful
function success_messages($message) {
    switch ($message) {
        case "update_successful":
            return "Successfully changed";
            break;
        case "admin_username_edit_successful":
            return "Successfully edited username";
            break;
        case "admin_lastname_edit_successful":
            return "Successfully edited lastname";
            break;
        case "admin_email_edit_successful":
            return "Successfully edited email";
            break;
        case "admin_contactnumber_edit_successful":
            return "Successfully edited contact number";
            break;
        case "admin_address_edit_successful":
            return "Successfully edited address";
            break;
        case "admin_barangay_edit_successful":
            return "Successfully edited barangay";
            break;
        
    }
}
?>