<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection settings
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "handcraft_sales"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify password
        if (password_verify($password, $hashed_password)) {
            echo "Login successful"; // Handle successful login
            // You can also set session variables here if needed
        } else {
            echo "Invalid password"; // Password mismatch
        }
    } else {
        echo "User not found"; // User doesn't exist
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
