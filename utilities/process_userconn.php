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
$uNameErr = $LNameErr = $emailErr = $contactnumErr = $pswErr = $repswErr = $captchaErr = "";

// contains number of errors, would not proceed once incremented
$errors = 0;

// variables needed to be initialized for processing
$emailcount = 0;
$passlength = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == 'signup') {
    # For Register Form...

    // -----Username / Firstname
        // must not be empty
    $signup['username'] = testInput($mysqli, $_POST["uName"]) ?? "";

    $uNameErr = $signup['username'] ? "" : error_messages("username_error");

    
    // -----Lastname
        // must not be empty   
    $signup['lastname'] = testInput($mysqli, $_POST["LName"]) ?? "";

    $LNameErr = $signup['lastname'] ? "" : error_messages("lastname_error");


    // -----Email
        // must not be empty
        // must be unique and valid
        // must be less than or equal to 100 characters
    $signup['email'] = testInput($mysqli, $_POST['email']) ?? "";

    $emailcheck = "SELECT * FROM `users` WHERE email = '" . $signup['email'] . "'";
    $emailresult = mysqli_query($mysqli, $emailcheck);
    $emailcount = mysqli_num_rows($emailresult);
    
    if (!$signup['email']) {
        $emailErr = error_messages("email_error_1");
    } elseif (!filter_var($signup['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = error_messages("email_error_2");
    } elseif ($emailcount == 1) {
        $emailErr = error_messages("email_error_3");

    }

    
    // -----Contact Number
        // must start with 09
        // must have 11 characters
        // all digits
        // optional
    $signup['contact'] = testInput($mysqli, $_POST['contactnum']) ?? "";
    if ($signup['contact'] && !preg_match("/^(09)\d{9}$/",$signup['contact'])) {
        $contactnumErr = error_messages("contact_error");
    }
    

    // -----Password
        // must be 8 characters
        // must be confirmed
    $signup['psw'] = $_POST["psw"] ?? "";
    $passlength = strlen($signup['psw']);

    if (!$signup['psw']) {
        $pswErr = error_messages("psw_error_1");
    } elseif ($passlength < 8) {
        $pswErr = error_messages("psw_error_2");
    }

    // -----Confirm Password
    $signup['rePass'] = $_POST["rePass"] ?? "";

    if ($signup['psw'] && $passlength >= 8) {
        if (!$signup['rePass']) {
            $repswErr = error_messages("psw_error_3");
        } elseif ($signup['psw'] != $signup['rePass']) {
            $repswErr = error_messages("psw_error_4");

        } 
    }
    
    // compile the errors, once $error is incremented, there is error found
    $errors += empty($_POST['uName']);
    $errors += empty($_POST['LName']);
    $errors += (empty($_POST['email']) || !filter_var($signup['email'],FILTER_VALIDATE_EMAIL) || $emailcount == 1);
    $errors = $contactnumErr ? $errors + 1 : $errors;
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

    $username = (!empty($_POST['loginName'])) ? testInput($mysqli, $_POST['loginName']) : FALSE;
    $password = (!empty($_POST['loginPass'])) ? $_POST['loginPass'] : FALSE;
    
    if ($username && $password) {

        $q1 = "SELECT * FROM users WHERE `email` = '". $username ."'";
        $result1 = @mysqli_query($mysqli, $q1);
        $user_row = (mysqli_num_rows($result1) == 1) ? mysqli_fetch_array($result1, MYSQLI_ASSOC) : false;
        
        if ($user_row) {
            $hashed_pass = $user_row['password'];
            
            if (password_verify($password, $hashed_pass)) {
                $_SESSION['id'] = $user_row['user_id'];
                $_SESSION['username'] = $user_row['username'];
                $_SESSION['lastname'] = $user_row['lastname'];
                $_SESSION['email'] = $user_row['email'];
                $_SESSION['contactnumber'] = $user_row['contactnumber'];
                $_SESSION['type'] = (int) $user_row['type'];
                
                mysqli_free_result($result1);
                mysqli_close($mysqli);
                
                header("location: index.php");
                exit();
            } else {
                $display_errors['login']  = error_message("login_error_2");
            }

        } else {
            $inputErr = error_messages("login_error_2");
        }
    } else {
        $inputErr  = error_messages("login_error_1");
    }
}
?>