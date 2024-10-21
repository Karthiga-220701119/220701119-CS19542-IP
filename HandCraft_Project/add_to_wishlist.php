<?php
session_start();
$product_id = $_POST['product_id'];

// Your logic to add product to wishlist
if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}
if (!in_array($product_id, $_SESSION['wishlist'])) {
    $_SESSION['wishlist'][] = $product_id;
    echo json_encode(["message" => "Product added to wishlist successfully!"]);
} else {
    echo json_encode(["message" => "Product is already in the wishlist."]);
}
?>
