<?php 

// Contains sanitization of user inputs:
function testInput($mysqli, $data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($mysqli, $data);
    
    return $data;
}

// contains error messages for registration, contact forn
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


    }
}
?>