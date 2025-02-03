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

$booking_id = $_GET['id'];
$conn->query("DELETE FROM bookings WHERE id = $booking_id");

header("Location: /bnb-project/pages/admin_dashboard.php");
?>