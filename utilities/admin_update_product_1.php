<?php 

$changes = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // product_id
    // price
    // stocks
    $product_id = test_input($mysqli, $_POST['product_id']);
    $price = test_input($mysqli, $_POST['price']);
    $stocks = test_input($mysqli, $_POST['stocks']);

    $product_info = Products::get_product_info($product_id);

    // Add error handling, on prices, etc etc, limit
    if (!preg_match('/^[0-9.]+$/', $price) || !preg_match('/^[0-9.]+$/', $stocks)) {
        $response = ['error' => 1, 'type' => "error"];
        exit(json_encode($response));
    } elseif (strlen($price) > 10 || (int) $stocks > 32767) {
        $response = ['error' => 2, 'type' => "error"];
        exit(json_encode($response));
    }

    if ($product_info) {
        $product = mysqli_fetch_array($product_info, MYSQLI_ASSOC);
        if ($product['price'] != $price) {
            // Update Price
            $upd_price = Products::update_price($product_id, $price);
            if ($upd_price) {
                $changes++;
            } else {
                $response = ['error' => 3, 'type' => "error"];
                exit(json_encode($response));
            }
        }
        if ($product['stocks'] != $stocks) {
            // Update Stocks
            $upd_stocks = Products::update_stocks($product_id, $stocks);
            if ($upd_stocks) {
                $changes++;
            } else {
                $response = ['error' => 3, 'type' => "error"];
                exit(json_encode($response));
            }
        }
    } else {
        $response = ['error' => 3, 'type' => "error"];
        exit(json_encode($response));
    }

    if ($changes > 0) {
        $response = ['error' => 0, 'type' => "success"];
        exit(json_encode($response));
    } else {
        $response = ['error' => 4, 'type' => "none"];
        exit(json_encode($response));
    }

    /*
    error 0 = success
    error 1 = input not numeric
    error 2 = overflowing amount
    error 3 = mysql connection didnt happen
    error 4 = no changes
    */
}

?>