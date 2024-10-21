<?php
session_start();
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    // Counting the total number of items in the cart
    $cart_count = array_sum($_SESSION['cart']);
}

$response = ['count' => $cart_count];
header('Content-Type: application/json');
echo json_encode($response);
?>
