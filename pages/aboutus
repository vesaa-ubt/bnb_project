<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'bnb_project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch about us content from the database
$sql = "SELECT content FROM about_us WHERE id = 1"; // Assuming the content is stored in a table
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="/bnb-project/pages/aboutus.php">About Us</a></li>
                <li><a href="/bnb-project/pages/contactus.php">Contact Us</a></li>
                <li><a href="/bnb-project/pages/rooms.php">Rooms</a></li>
                <li><a href="/bnb-project/pages/login.php">Log In</a></li>
                <li><a href="/bnb-project/pages/register.php">Register</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>About Us</h2>
        <p>Welcome to <b>BnB</b>, your gateway to unique and memorable stays!<br><br>At BnB, we believe that every trip should feel like coming home, no matter where you are. Whether you’re seeking a cozy retreat, a luxurious escape, or a unique local experience, our platform connects you to one-of-a-kind accommodations that suit your style and budget.
            <br><br>
            <b>Our Mission</b><br><br>
            Our mission is to make travel accessible, comfortable, and enriching for everyone. We aim to create connections between hosts and guests, fostering communities that celebrate diversity, hospitality, and trust.
            <br><br>
            <b>What We Offer</b>
            <br><br>
            <b>Exceptional Stays:</b> Discover curated properties ranging from charming cottages to modern apartments.
            <br>
            <b>Seamless Booking:</b> Effortless and secure booking to make your travel planning stress-free.
            <br>
            <b>Support When You Need It:</b> Our dedicated team is here 24/7 to ensure your experience is nothing short of exceptional.
            <br><br>
            <b>Why Choose BnB?</b><br><br>
            We’re not just about places to stay; we’re about the stories you create. With BnB, you can explore destinations like a local, find hidden gems, and enjoy a personalized travel experience that you’ll cherish forever.
            <br><br>
            <i>Join the BnB community today and let us help you find your perfect stay, wherever your journey takes you.</i></p>
    </main>

    <footer>
        <p>&copy; 2025 BNB Project. All rights reserved.</p>
    </footer>
</body>
</html>