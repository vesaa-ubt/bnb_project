<?php
session_start();
require_once '../includes/db.php';

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Fetch rooms from the database
$sql = "SELECT id, name, description, price, image, city FROM rooms";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
    <link rel="stylesheet" href="../css/style1.css">
    
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/bnb-project/index.php">Home</a></li>
                <li><a href="/bnb-project/pages/aboutus.php">About Us</a></li>
                <li><a href="/bnb-project/pages/contactus.php">Contact Us</a></li>
                <li><a href="/bnb-project/pages/rooms.php">Rooms</a></li>
                <li><a href="/bnb-project/pages/login.php">Log In</a></li>
                <li><a href="/bnb-project/pages/register.php">Register</a></li>
                <li><a href="/bnb-project/includes/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Available Rooms</h2>
        <div class="rooms-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='room'>";
                    echo "<img src='/bnb-project/images/{$row['image']}' alt='{$row['name']}'>";
                    echo "<h3>{$row['name']}</h3>";
                    echo "<p>{$row['description']}</p>";
                    echo "<p>Price: {$row['price']}$ per night</p>";
                    echo "<p>City: {$row['city']}</p>";

                    // Show "Book Room" button only if the user is logged in
                    if ($isLoggedIn) {
                        echo "<form action='/bnb-project/includes/book_room.php' method='post'>";
                        echo "<input type='hidden' name='room_id' value='{$row['id']}'>";
                        echo "<label for='check_in'>Check-in Date:</label>";
                        echo "<input type='date' id='check_in' name='check_in' required>";
                        echo "<label for='check_out'>Check-out Date:</label>";
                        echo "<input type='date' id='check_out' name='check_out' required>";
                        echo "<button type='submit'>Book Room</button>";
                        echo "</form>";
                    } else {
                        echo "<p><a href='/bnb-project/pages/login.php' class='login-btn'>Login to Book</a></p>";
                    }

                    echo "</div>";
                }
            } else {
                echo "<p>No rooms available.</p>";
            }
            ?>
        </div>
    </main>

    
    <footer>
        <p>&copy; 2025 BNB Project. All rights reserved.</p>
    </footer>
</body>
</html>