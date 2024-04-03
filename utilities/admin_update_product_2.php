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
    
    $file = $_FILES['file'];
    $id = test_input($mysqli, $_POST['product_id']);
    $name = test_input($mysqli, $_POST['name']);
    $price = test_input($mysqli, $_POST['price']);
    $stocks = test_input($mysqli, $_POST['stocks']);
    $description = test_input($mysqli, $_POST['description']);

    $product_info = Products::get_product_info($id);

    // Error Handling and their Error Messages
    if (!$name)
        $error['name'] = "Name: Required.";
    elseif (strlen($name) > 255)
        $error['name'] = "Name: Maximum of 255 characters only.";
    
    if (!$price)
        $error['price'] = "Price: Required.";
    elseif (!preg_match('/^[0-9.]+$/', $price))
        $error['price'] = "Price: Digits only.";
    elseif (strlen($price) > 10)
        $error['price'] = "Price: Too long.";

    if (!$stocks)
        $error['stocks'] = "Stocks: Required.";
    elseif (!preg_match('/^[0-9]+$/', $stocks))
        $error['stocks'] = "Stocks: Digits only.";
    elseif ((int) $stocks > 32767)
        $error['stocks'] = "Stocks: Maximum of 32,767 characters only.";
    
    if (!$description)
        $error['description'] = "Description: required.";
    elseif (strlen($description) > 2000)
        $error['description'] = "Description: Maximum of 2000 characters only.";

    if (empty($file['name'])) {
        $error['file'] = "File: Required.";
    } elseif (!in_array(exif_imagetype($file['tmp_name']), 
            [IMAGETYPE_JPEG, IMAGETYPE_JPEG2000, IMAGETYPE_JPX, 
            IMAGETYPE_JB2, IMAGETYPE_PNG, IMAGETYPE_SVG, IMAGETYPE_WEBP, IMAGETYPE_AVIF]) ||
            (getimagesize($file['tmp_name']) == false)) {
        $error['file'] = "File: Invalid file type.";
    }
    
    
    if (!$name || strlen($name) > 255) { $errors++; }
    if (!$price || !preg_match('/^[0-9.]+$/', $price) || strlen($price) > 10) { $errors++; }
    if (!$stocks || !preg_match('/^[0-9]+$/', $stocks) || (int) $stocks > 32767) { $errors++; }
    if (!$description || strlen($description) > 2000) { $errors++; }
    // if file is empty or file is not an image
    if (empty($file['name']) || !in_array(exif_imagetype($file['tmp_name']), 
            [IMAGETYPE_JPEG, IMAGETYPE_JPEG2000, IMAGETYPE_JPX, 
            IMAGETYPE_JB2, IMAGETYPE_PNG, IMAGETYPE_SVG, IMAGETYPE_WEBP, IMAGETYPE_AVIF]) ||
            (getimagesize($file['tmp_name']) == false)) { $errors++; }


    if ($errors == 0) {

    }
}

?>