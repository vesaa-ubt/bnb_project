<?php
require_once 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNB Project</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="/bnb-project/pages/aboutus.php">About Us</a></li>
                <li><a href="/bnb-project/pages/contactus.php">Contact Us</a></li>
                <li><a href="/bnb-project/pages/rooms.php">Rooms</a></li>
                <li><a href="/bnb-project/pages/login.php">Log In</a></li>
                <li><a href="/bnb-project/pages/register.php">Register</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="hero">
            <h1>Welcome to BNB Project</h1>
            <p>Your perfect getaway is just a click away!</p>
            <a href="pages/rooms.php" class="btn">Book Now</a>
        </section>

        <!-- Most Visited Places Section -->
        <section id="most-visited">
            <h2>Most Visited Places</h2>
            <div class="places-container">
                <div class="place">
                    <img src="images/europe.jpg" alt="Place 1">
                    <h3>Luxury City Apartment</h3>
                </div>
                <div class="place">
                    <img src="images/US.jpg" alt="Place 2">
                    <h3>Park Cabin Retreat</h3>
                </div>
                <div class="place">
                    <img src="images/thailand.jpg" alt="Place 3">
                    <h3>Beautiful Beach Resort</h3>
                </div>
            </div>
        </section>

    <div id="customer-feedback">
      <h2>Customer Feedback</h2>
      <div class="feedback-container">
        <div class="feedback">
            <img src="images/feedback1.png" alt="Customer 1" class="feedback-img">
            <div class="feedback-text">
                <p>"Amazing experience! The rooms were clean, and the service was outstanding."</p>
                <img src="images/starsrating.jpg" alt="5-star rating" class="star-rating">
            </div>
        </div>

        <div class="feedback">
            <img src="images/feedback2.png" alt="Customer 2" class="feedback-img">
            <div class="feedback-text">
                <p>"A very cozy and relaxing place to stay. Highly recommended!"</p>
                <img src="images/starsrating.jpg" alt="5-star rating" class="star-rating">
            </div>
        </div>

        <div class="feedback">
            <img src="images/feedback3.png" alt="Customer 3" class="feedback-img">
            <div class="feedback-text">
                <p>"Best vacation ever! The host was very friendly and helpful."</p>
                <img src="images/starsrating.jpg" alt="5-star rating" class="star-rating">
            </div>
        </div>
    </div>
    </main>

    <footer>
        <p>&copy; 2025 BNB Project. All rights reserved.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
