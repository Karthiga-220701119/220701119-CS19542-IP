<?php
session_start();
include 'db_connect.php'; // Include the database connection

$userId = $_SESSION['user_id']; // Assuming the user is logged in and their ID is in the session

// Query to get the wishlist item count for the user
$sql = "SELECT COUNT(*) as count FROM wishlist WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($wishlistCount);
$stmt->fetch();

echo json_encode(array("count" => $wishlistCount));

$stmt->close();
$conn->close();
?>
