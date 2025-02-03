<?php
session_start();

// Redirect if not logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /bnb-project/pages/login.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'bnb_project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_POST['image'];

$stmt = $conn->prepare("INSERT INTO rooms (name, description, price, image) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssds", $name, $description, $price, $image);

if ($stmt->execute()) {
    header("Location: /bnb-project/pages/admin_dashboard.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>