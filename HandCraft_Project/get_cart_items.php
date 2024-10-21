<?php
session_start();
include 'db_connect.php'; // Include database connection

$userId = $_SESSION['user_id']; // Assuming user ID is stored in session after login

// Query to get the cart items
$sql = "SELECT p.name AS product_name, p.price 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = array();
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

echo json_encode($cartItems);

$stmt->close();
$conn->close();
?>
