<?php 

// Contains sanitization of user inputs:
function testInput($mysqli, $data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($mysqli, $data);
    
    return $data;
}

// contains error messages for registration
function error_messages($error) {
    switch ($error) {
        case "username_error":
            return "^ Please enter your First Name / Username";
            break;
        case "lastname_error":
            return "^ Please enter your Last Name";
            break;
        case "email_error_1":
            return "^ Please enter your Email";
            break;
        case "email_error_2":
            return "^ Invalid Email format";
            break;
        case "email_error_3":
            return "^ Email Already Taken";
            break;
        case "contact_error":
            return "^ Invalid Phone Number format";
            break;
        case "psw_error_1":
            return "^ Please enter your Password";
            break;
        case "psw_error_2":
            return "^ Password must be at least 8 characters";
            break;
        case "psw_error_3":
            return "^ Please confirm your password";
            break;
        case "psw_error_4":
            return "^ Passwords Don't Match";
            break;
        

        case "login_error_1":
            return "Please enter your Email or Password";
            break;
        case "login_error_2":
            return "Invalid Email or Password";
            break;
    }
}
?>