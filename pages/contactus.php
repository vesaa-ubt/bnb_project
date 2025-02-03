<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $stmt = $conn->prepare("INSERT INTO contacts (email, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $message);

    if ($stmt->execute()) {
        $successMessage = "Your message has been sent successfully.";
    } else {
        $errorMessage = "There was an error sending your message. Please try again later.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../css/style4.css">
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
        <div class="contact-container">
            <!-- Left Side: Contact Info -->
            <div class="contact-info">
                <h2>Get in Touch</h2>
                <p><strong>Email:</strong> info@bnb.com</p>
                <p><strong>Phone:</strong> +1 234 567 890</p>
                <p><strong>Address:</strong> 123 Main Street, City, Country</p>
                <p><strong>Working Hours:</strong> Mon-Fri: 9AM - 5PM</p>
            </div>

            <!-- Right Side: Contact Form -->
            <div class="contact-form">
                <h2>Contact Us</h2>
                <?php
                if (isset($successMessage)) {
                    echo "<p class='success'>$successMessage</p>";
                } elseif (isset($errorMessage)) {
                    echo "<p class='error'>$errorMessage</p>";
                }
                ?>
                <form action="" method="post">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>
                    
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 BNB Project. All rights reserved.</p>
    </footer>
</body>
</html>
