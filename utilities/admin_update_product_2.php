<?php 
// For updates on Specific Product Details
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
    $id = test_input($mysqli, $_POST['product_id']);
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
    if ($file['size'] != 0 && (!in_array(exif_imagetype($file['tmp_name']), $file_types) || (getimagesize($file['tmp_name']) == false))) {
        $error['file'] = "File: Invalid file type.";
    }
    
    if (!$name || strlen($name) > 255) { $errors++; }
    if (!$price || !preg_match('/^[0-9.]+$/', $price) || strlen($price) > 10) { $errors++; }
    if ((!$stocks && $stocks != 0) || !preg_match('/^[0-9]+$/', $stocks) || (int) $stocks > 32767) { $errors++; }
    if (!$description || strlen($description) > 2000) { $errors++; }
    // if file is empty or file is not an image
    if ($file['size'] != 0 && (!in_array(exif_imagetype($file['tmp_name']), $file_types) || (getimagesize($file['tmp_name']) == false))) { $errors++; }

    $product_info = Products::get_product_info($id);
    if ($errors == 0) {
        $product = mysqli_fetch_array($product_info, MYSQLI_ASSOC);
        
        $changes = 0;
        
        if ($product['name'] != $name) { $changes++; }
        if ($product['price'] != $price) { $changes++; }
        if ($product['stocks'] != $stocks) { $changes++; }
        if ($product['description'] != $description) { $changes++; }


        if ($file['size'] != 0) {
            $upload_file = Products::upload_file($id, $file);
            if (!$upload_file) {
                $error['file'] = "File: Failed to upload.";
            }
        }

        if ($changes > 0) {
            $update = Products::product_modify("update", $id, $name, $price, $stocks, $description);
            if ($update || $upload_file)
                $success_msg = "Changes saved.";
        }

            /*$update = Products::update_product($id, $name, $price, $stocks, $description);
            if ($update) {
                $changes++;
            } else {
                $success_msg = "Failed to save changes.";
            }*/
    }
}

?>