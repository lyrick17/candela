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
        case "contact_error":
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

        // for system failure
        case "system_error":
            return "System Error. Please contact the Candela Team";
            break;

        case "cant_delete_account":
            return "You cannot delete your account with order on process";
            break;


        case "fail_add_basket":
            return "Failed to add item to basket";
            break;

        case "fail_remove_basket":
            return "Failed to remove item from basket";
            break;

        case "fail_clear_basket":
            return "Failed to clear basket";
            break;

        case "fail_mysql_del_basket":
            return "Cannot delete the basket. Please contact the Candela team";
            break;
        
        case "fail_mysql_upd_basket":
            return "Cannot update the basket. Please contact the Candela team";
            break;
    }
}

// contains messages when  process is successful
function success_messages($message) {
    switch ($message) {
        case "update_successful":
            return "Successfully changed";
            break;
    }
}
?>