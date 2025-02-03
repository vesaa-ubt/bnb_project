<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'bnb_project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'];
$message = $_POST['message'];

// Insert data into database
$stmt = $conn->prepare("INSERT INTO contacts (email, message) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $message);

if ($stmt->execute()) {
    echo "Message sent successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>