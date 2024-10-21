<?php
session_start(); // Start a new session or resume an existing one

// Database connection settings
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "handcraft_sales"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password
    $phone = $_POST['phone'];

    // Check for empty fields
    if (empty($username) || empty($email) || empty($password) || empty($phone)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare and execute the SQL statement
    $query = "INSERT INTO users (username, email, password, phone) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $username, $email, $password, $phone);

    if ($stmt->execute()) {
        echo "User registered successfully.";
    } else {
        echo "Error executing statement: " . $stmt->error; // Output the error
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
