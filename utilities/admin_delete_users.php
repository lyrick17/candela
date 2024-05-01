<?php 

$delete_error = '';
$error = 0;
// process when user agreed on deleting the account
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SESSION['type'] == 1) {
    
    // check admin password first
    $adminpass = $_POST['adminpass'];

    
    
    if (!$adminpass) {
        $delete_error = error_messages("psw_error_1");    // admin password is empty
        $error++;
    } else {

        $pass = Users::get_password($_SESSION['id']);

        if ($pass) {
            $hashed_pass = $pass['password'];
            if (!password_verify($adminpass, $hashed_pass)) {
                $delete_error = error_messages("psw_error_6");    // admin password is incorrect
                $error++;
            }
        } else {
            $delete_error = error_messages("system_error");
            $error++;
        }
    }

    if ($error == 0) {

        $user_id = test_input($mysqli, $_GET['id']);
        //$delete_user_chk = mysqli_query($mysqli, "DELETE FROM checkout_orders WHERE user_id = '". $_SESSION['id'] ."' AND delivered = 'Delivered' ") or die("Unable to delete orders");
        $delete_user_bas = mysqli_query($mysqli, "DELETE FROM basket_items WHERE user_id = '". $user_id ."'") or die("Unable to delete basket");
        $delete_user_acc = mysqli_query($mysqli, "DELETE FROM addresses WHERE user_id = '". $user_id ."'") or die("Unable to delete information");
        $delete_user_acc2 = mysqli_query($mysqli, "DELETE FROM users WHERE user_id = '". $user_id ."'") or die("Unable to delete information");
        echo "<script> alert('User has been successfully deleted.'); </script>";
        echo "<script>window.location = 'admin-users.php';</script>";
        exit();
    }
    
}


?>