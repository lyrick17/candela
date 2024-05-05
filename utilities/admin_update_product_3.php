<?php 
// For creating a new product
$changes = 0;
$error = array(
            "name" => "", 
            "price" => "",
            "stocks" => "",
            "description" => "",
            "file" => "");
$success_msg = "";
$errors = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $file = $_FILES['userfile'];
    $name = test_input($mysqli, $_POST['name']);
    $price = test_input($mysqli, $_POST['price']);
    $stocks = test_input($mysqli, $_POST['stocks']);
    $description = test_input($mysqli, $_POST['description']);

    // Error Handling and their Error Messages
    if (!$name)
        $error['name'] = "Name: Required.";
    elseif (strlen($name) > 255)
        $error['name'] = "Name: Name is too long.";
    
    if (!$price)
        $error['price'] = "Price: Required.";
    elseif (!preg_match('/^[0-9.]+$/', $price))
        $error['price'] = "Price: Digits only.";
    elseif (strlen($price) > 10)
        $error['price'] = "Price: Too long.";

    if (!$stocks && $stocks != 0)
        $error['stocks'] = "Stocks: Required.";
    elseif (!preg_match('/^[0-9]+$/', $stocks))
        $error['stocks'] = "Stocks: Digits only.";
    elseif ((int) $stocks > 32767)
        $error['stocks'] = "Stocks: Maximum of 32,767 stocks only.";
    
    if (!$description)
        $error['description'] = "Description: required.";
    elseif (strlen($description) > 2000)
        $error['description'] = "Description: Maximum of 2000 characters only.";

    
    $file_types = array(IMAGETYPE_JPEG, 
                        IMAGETYPE_JPEG2000, 
                        IMAGETYPE_JPX, 
                        IMAGETYPE_JB2, 
                        IMAGETYPE_PNG, 
                        IMAGETYPE_WEBP, 
                        IMAGETYPE_AVIF);
    if ($file['size'] == 0) {
        $error['file'] = "File: Required.";
    } elseif (!in_array(exif_imagetype($file['tmp_name']), $file_types) || (getimagesize($file['tmp_name']) == false)) {
        $error['file'] = "File: Invalid file type.";
    }
    
    if (!$name || strlen($name) > 255) { $errors++; }
    if (!$price || !preg_match('/^[0-9.]+$/', $price) || strlen($price) > 10) { $errors++; }
    if ((!$stocks && $stocks != 0) || !preg_match('/^[0-9]+$/', $stocks) || (int) $stocks > 32767) { $errors++; }
    if (!$description || strlen($description) > 2000) { $errors++; }
    if ($file['size'] == 0 || !in_array(exif_imagetype($file['tmp_name']), $file_types) || (getimagesize($file['tmp_name']) == false)) { $errors++; }

    if ($errors == 0) {
        
        // Get the latest product id, and increment it to assign on this new product
        $get_product = Products::select_three();
        if ($get_product) {

            $latest_product = mysqli_fetch_assoc($get_product);
            
            $latest_product['product_id'];
            $new_product_id = $latest_product['product_id'] + 1;
            
            // add the product
            $update = Products::product_modify("create", $new_product_id, $name, $price, $stocks, $description);
            if ($update) {
                // upload the file after the creation of new product 
                $upload_file = Products::upload_file($new_product_id, $file);
                if ($upload_file) {
                    echo "<script>alert('Product Successfully Added')</script>";
                } else {
                    echo "<script>alert('Product Successfully Added, but Unable to Upload the Image. Try Again.')</script>";
                }
                echo "<script>window.location = 'admin-products-edit.php?id=$new_product_id';</script>";

            } else {
                $error['name'] = "Unable to add product. Try Again.";
            }
        } else {
            $error['name'] = "Unable to access Database. Try Again.";
        }
    }
}

?>