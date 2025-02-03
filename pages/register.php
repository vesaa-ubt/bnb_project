<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'bnb_project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/style3.css">
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
    <div class="register-box">
        <h2>Register</h2>

        <?php if (isset($error)) { echo "<p class='error-message'>$error</p>"; } ?>

        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Register</button>
        </form>
        <p class="login-link">Already have an account? 
            <a href="/bnb-project/pages/login.php">Log In</a>
        </p>
    </div>
</main>

    <footer>
        <p>&copy; 2025 BNB Project. All rights reserved.</p>
    </footer>
    <script src="../js/script.js"></script>
</body>
</html>