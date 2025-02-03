<?php
session_start();
require_once 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /bnb-project/pages/login.php");
    exit();
}

// Get form data
$room_id = $_POST['room_id'];
$user_id = $_SESSION['user_id'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];

// Insert booking into the database
$stmt = $conn->prepare("INSERT INTO bookings (user_id, room_id, check_in, check_out) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $user_id, $room_id, $check_in, $check_out);

if ($stmt->execute()) {
    echo "Booking successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>