<?php
// add_to_cart.php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "handcraft_sales";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from the AJAX request
$user_id = $_POST['user_id'];
$product_id = $_POST['product_id'];
$quantity = 1; // Default quantity is 1

// Insert the data into the cart table
$sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $product_id, $quantity);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
}

$stmt->close();
$conn->close();
?>
