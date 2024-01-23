<?php 
require("conn/db_connection.php");

require("sanitize_input.php");

// Contains Process and Validation when User:
//  - sign ups / register
//  - log in

# FOR REGISTRATION ------------------------------------------------


// array that would hold all the sanitized user inputs for processing
$signup = array("username" => "",
                "lastname" => "",
                "email" => "",
                "contact" => "",
                "psw" => ""); 


// contains the error messages
$signup_err = array("username" => "",
                    "lastname" => "",
                    "email" => "",
                    "contact" => "",
                    "psw" => "",
                    "repsw" => "",
                    "captcha" => "");

// contains number of errors, would not proceed once incremented
$errors = 0;

// variables needed to be initialized for processing
$emailcount = 0;
$passlength = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == 'signup') {

    // Captcha Validation
    if ($_POST['formcaptcha'] != "filled") {
        $signup_err['captcha'] = error_messages("captcha_error");      // captcha not filled
    }


    // -----Username / Firstname
        // must not be empty
    $signup['username'] = testInput($mysqli, $_POST["uName"]) ?? "";

    if (!$signup['username']) {
        $signup_err['username'] = error_messages("username_error");     // username is empty
    } elseif (strlen($signup['username']) > 255) {
        $signup_err['username'] = error_messages("maxchar_error_255");    // username character is over 255
    }

    // -----Lastname
        // must not be empty   
    $signup['lastname'] = testInput($mysqli, $_POST["LName"]) ?? "";

    if (!$signup['lastname']) {
        $signup_err['lastname'] = error_messages("lastname_error");       // lastname is empty
    } elseif (strlen($signup['lastname']) > 255) {
        $signup_err['lastname'] = error_messages("maxchar_error_255");    // lastname character is over 255
    }

    // -----Email
        // must not be empty
        // must be unique and valid
        // must be less than or equal to 100 characters
    $signup['email'] = testInput($mysqli, $_POST['email']) ?? "";

    $emailcheck = "SELECT * FROM `users` WHERE email = '" . $signup['email'] . "'";
    $emailresult = mysqli_query($mysqli, $emailcheck);
    $emailcount = mysqli_num_rows($emailresult);
    
    if (!$signup['email']) {
        $signup_err['email'] = error_messages("email_error_1");        // email is empty
    } elseif (strlen($signup['email']) > 100) {
        $signup_err['email'] = error_messages("maxchar_error_100");    // email character is over 100
    } elseif (!filter_var($signup['email'], FILTER_VALIDATE_EMAIL)) {
        $signup_err['email'] = error_messages("email_error_2");        // email is not valid
    } elseif ($emailcount == 1) {
        $signup_err['email'] = error_messages("email_error_3");        // email is already takeen
    }

    
    // -----Contact Number
        // must start with 09
        // must have 11 characters
        // all digits
        // optional
    $signup['contact'] = testInput($mysqli, $_POST['contactnum']) ?? "";
    if ($signup['contact'] && !preg_match("/^(09)\d{9}$/",$signup['contact'])) {
        $signup_err['contact'] = error_messages("contact_error");       // phone num not valid
    }
    

    // -----Password
        // must be atleast 8 characters
        // must be confirmed
    $signup['psw'] = $_POST["psw"] ?? "";
    $passlength = strlen($signup['psw']);

    if (!$signup['psw']) {
        $signup_err['psw'] = error_messages("psw_error_1");            // no password input
    } elseif ($passlength < 8) {
        $signup_err['psw'] = error_messages("psw_error_2");            // password less than 8 characters
    }

    // -----Confirm Password
    $signup['rePass'] = $_POST["rePass"] ?? "";

    if ($signup['psw'] && $passlength >= 8) {
        if (!$signup['rePass']) {
            $signup_err['repsw'] = error_messages("psw_error_3");      // password not confirmed
        } elseif ($signup['psw'] != $signup['rePass']) {
            $signup_err['repsw'] = error_messages("psw_error_4");      // passwords do not match
        } 
    }
    
    
    // error if captcha is not filled
    $errors += ($_POST['formcaptcha'] != "filled");
    // compile the errors, once $error is incremented, there is error found
    $errors += (empty($_POST['uName']) || strlen($signup['username']) > 255);
    $errors += empty($_POST['LName'] || strlen($signup['lastname']) > 255);
    $errors += (empty($_POST['email']) || strlen($signup['email']) > 100 || !filter_var($signup['email'],FILTER_VALIDATE_EMAIL) || $emailcount == 1);
    $errors = $signup_err['contact'] ? $errors + 1 : $errors;
    $errors += (empty($_POST['psw']) || $passlength < 8);
    $errors += (empty($_POST['rePass']) || $signup['psw'] != $signup['rePass']);

    if ($errors == 0) {
        // hash password    
        $signup['psw'] = password_hash($signup['psw'], PASSWORD_BCRYPT);
        $usertype = 0;

        $sql = "INSERT INTO users (username, lastname, email, contactnumber, password, type) VALUES (?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssssi",
            $signup['username'],
            $signup['lastname'],
            $signup['email'],
            $signup['contact'],
            $signup['psw'],
            $usertype);
        $stmt->execute();

        $sql_get_info = "SELECT * FROM users WHERE `email` = '". $signup['email'] ."'";
        $sql_get_info_result = @mysqli_query($mysqli, $sql_get_info);
        $user_row = (mysqli_num_rows($sql_get_info_result) == 1) ? mysqli_fetch_array($sql_get_info_result, MYSQLI_ASSOC) : false;
        
        if ($user_row) {
            // initialize the session variables
            $_SESSION['id'] = $user_row['user_id'];
            $_SESSION['username'] = $user_row['username'];
            $_SESSION['lastname'] = $user_row['lastname'];
            $_SESSION['email'] = $user_row['email'];
            $_SESSION['contactnumber'] = $user_row['contactnumber'];
            $_SESSION['type'] = (int) $user_row['type'];

            $get_addr = "SELECT * FROM addresses WHERE `user_id` = '". $_SESSION['id'] ."'";
            $get_addr_result = @mysqli_query($mysqli, $get_addr);

            if ($get_addr_result) {
                $row = mysqli_fetch_array($get_addr_result, MYSQLI_ASSOC);
                $_SESSION['address_id'] = $row['address_id'];
                $_SESSION['address'] = $row['user_address'];
                $_SESSION['barangay'] = $row['barangay'];
            }
            
        
        
        }

        // unset the basket that the guest user created
        if (isset($_SESSION['basket'])) {
            unset($_SESSION['basket']);
        }
        
        mysqli_close($mysqli);
        
        echo "<script>alert('Welcome To Candela! Thank You for Signing In!')</script>";
        echo "<script>window.location = 'index.php';</script>";
        //header("Location: index.php");
        exit();

    }
}

# FOR LOGIN ------------------------------------------------


$username = "";
// contains the error message to be displayed
$inputErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == 'login') {

    // get inputs
    $username = (!empty($_POST['loginName'])) ? testInput($mysqli, $_POST['loginName']) : FALSE;
    $password = (!empty($_POST['loginPass'])) ? $_POST['loginPass'] : FALSE;
    
    if ($username && $password) {
        // check username exists, then get its password
        $q1 = "SELECT * FROM users WHERE `email` = '". $username ."'";
        $result1 = @mysqli_query($mysqli, $q1);
        $user_row = (mysqli_num_rows($result1) == 1) ? mysqli_fetch_array($result1, MYSQLI_ASSOC) : false;
        
        if ($user_row) {
            $hashed_pass = $user_row['password'];
            
            // compare the password typed now and from the db
            if (password_verify($password, $hashed_pass)) {
                // password matched, assign the session variables
                $_SESSION['id'] = $user_row['user_id'];
                $_SESSION['username'] = $user_row['username'];
                $_SESSION['lastname'] = $user_row['lastname'];
                $_SESSION['email'] = $user_row['email'];
                $_SESSION['contactnumber'] = $user_row['contactnumber'];
                $_SESSION['type'] = (int) $user_row['type'];
                
                // get the addresses
                $get_addr = "SELECT * FROM addresses WHERE `user_id` = '". $_SESSION['id'] ."'";
                $get_addr_result = @mysqli_query($mysqli, $get_addr);

                if ($get_addr_result) {
                    $row = mysqli_fetch_array($get_addr_result, MYSQLI_ASSOC);
                    $_SESSION['address_id'] = $row['address_id'];
                    $_SESSION['address'] = $row['user_address'];
                    $_SESSION['barangay'] = $row['barangay'];
                } 


                mysqli_free_result($result1);
                mysqli_free_result($get_addr_result);
                mysqli_close($mysqli);
                
                header("location: index.php");
                exit();
            } else {
                $inputErr  = error_messages("login_error_2");     // invalid login
            }

        } else {
            $inputErr = error_messages("login_error_2");                        // invalid login
        }
    } else {
        $inputErr  = error_messages("login_error_1");                           // incomplete details
    }
}
?>