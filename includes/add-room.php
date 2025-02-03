<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $city = $_POST['city'];
    $created_at = date("Y-m-d H:i:s");

    // Handle Image Upload
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert room into database
    $stmt = $conn->prepare("INSERT INTO rooms (name, description, price, image, city, created_at) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsss", $name, $description, $price, $image, $city, $created_at);
    $stmt->execute();

    header("Location: admin_dashboard.php?success=Room added successfully");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <link rel="stylesheet" href="css/style6.css">
</head>
<body>
    <form action="add-room.php" method="post" enctype="multipart/form-data">
        <label for="name">Room Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="price">Price (€):</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>

        <button type="submit">Add Room</button>
    </form>
</body>
</html>