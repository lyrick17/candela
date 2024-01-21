<?php 
require("conn/db_connection.php");
require("sanitize_input.php");
// Contains Process and Validation when User:
//  - sends feedback through contact form

$contact = array("name" => "",
                "email" => "",
                "contact" => "",
                "subject" => "",
                "comment" => "");
$contact_err = array("name" => "",
                    "email" => "",
                    "contact" => "",
                    "subject" => "",
                    "comment" => "");
$contnameErr = $contemailErr = $contcontactnumErr = $contsubjectErr = $contcommentErr = "";

$errors = 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Name
    $contact['name'] = testInput($mysqli, $_POST['uName']) ?? "";

    if (!$contact['name']) {
        $contact_err['name'] = error_messages("name_error");           // username is empty
    } elseif (strlen($contact['name']) > 255) {
        $contact_err['name'] = error_messages("maxchar_error_255");         // username character is over 255
    }
    
    // Email
    $contact['email'] = testInput($mysqli, $_POST['email']) ?? "";
    if (!$contact['email']) {
        $contact_err['email'] = error_messages("email_error_1");       // no email input
    } elseif (strlen($contact['email']) > 100) {
        $contact_err['email'] = error_messages("maxchar_error_100");        // email character is over 100
    } elseif (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
        $contact_err['email'] = error_messages("email_error_2");       // invalid email
    }

    // Contact Number
    $contact['contact'] = testInput($mysqli, $_POST['contactnum']) ?? "";
    if ($contact['contact'] && !preg_match("/^(09)\d{9}$/",$contact['contact'])) {
        $contact_err['contact'] = error_messages("contact_error");  // invalid phone number
    }
    
    // Subject
    $contact['subject'] = testInput($mysqli, $_POST['subject']) ?? "";

    if (!$contact['subject']) {
        $contact_err['subject'] = error_messages("subject_error");     // username is empty
    } elseif (strlen($contact['subject']) > 255) {
        $contact_err['subject'] = error_messages("maxchar_error_255");      // username character is over 255
    }

    // Comment
    $contact['comment'] = testInput($mysqli, $_POST['comment']) ?? "";
    if (!$contact['comment']) {
        $contact_err['comment'] = error_messages("comment_error");     // username is empty
    } elseif (strlen($contact['comment']) > 255) {
        $contact_err['comment'] = error_messages("maxchar_error_2000");     // username character is over 255
    }


    $errors += (empty($_POST['uName']) || strlen($contact['name']) > 255);
    $errors += (empty($_POST['email']) || !filter_var($contact['email'], FILTER_VALIDATE_EMAIL));
    $errors += $contcontactnumErr ? $errors + 1 : $errors;
    $errors += (empty($_POST['subject']) || strlen($contact['subject']) > 255);
    $errors += (empty($_POST['comment']) || strlen($contact['comment']) > 2000);

    if ($errors == 0)  {
        //print_r("<script>alert('Thank you for contacting us! We appreciate it.');</script>");
        
        
        // check if user is logged in 
        if (isset($_SESSION['id'])) {

            $sql = "INSERT INTO contacts (user_id, name, email, contactnumber, subject, comment) VALUES (?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("isssss",
                    $_SESSION['id'],
                    $contact["name"],
                    $contact["email"],
                    $contact["contact"],
                    $contact["subject"],
                    $contact["comment"] );
            $stmt->execute();
            
        } else {
            $sql = "INSERT INTO contacts (name, email, contactnumber, subject, comment) VALUES (?,?,?,?,?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("sssss",
                    $contact["name"],
                    $contact["email"],
                    $contact["contact"],
                    $contact["subject"],
                    $contact["comment"] );
            $stmt->execute();

        }
        

        echo "<script>alert('Thank you for contacting us! We appreciate it.');</script>";
        echo "<script>window.location = 'contact-us.php';</script>";
        //exit();
    }
}
?>