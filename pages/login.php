<?php
session_start();  // Fillojmë sesionin

// Lidhja me bazën e të dhënave
$conn = new mysqli('localhost', 'root', '', 'bnb_project');

// Kontrollo lidhjen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kontrollo nëse forma është dërguar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Debug: shfaq kredencialet e dërguara (hiq në prodhim)
    var_dump($email, $password);

    // Kontrollo kredencialet e adminit
    if ($email === 'admin@hotmail.com' && $password === 'admin123') {
        // Debug: konfirmo hyrjen e adminit
        var_dump("Admin login successful");

        // Rikrijo ID e sesionit për siguri
        session_regenerate_id(true);

        // Vendos variablat e sesionit për adminin
        $_SESSION['user_id'] = 1;  // ID e adminit (mund të jetë çdo vlerë unike)
        $_SESSION['username'] = 'admin@hotmail.com';
        $_SESSION['role'] = 'admin';

        // Debug: kontrollo variablat e sesionit
        var_dump($_SESSION);

        // Ridrejto në admin_dashboard.php
        header("Location: /bnb-project/pages/admin_dashboard.php");
        exit();  // Ndalo ekzekutimin e mëtejshëm të skriptit
    }

    // Kontrollo kredencialet e përdoruesve normalë në bazën e të dhënave
    $stmt = $conn->prepare("SELECT id, username, role FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $role);

    if ($stmt->fetch()) {
        // Rikrijo ID e sesionit për siguri
        session_regenerate_id(true);

        // Vendos variablat e sesionit për përdoruesin normal
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        // Ridrejto në faqen kryesore për përdoruesit normalë
        header("Location: ../index.php");
        exit();  // Ndalo ekzekutimin e mëtejshëm të skriptit
    } else {
        echo "Invalid email or password!";
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
    <title>Login</title>
    <link rel="stylesheet" href="../css/style2.css">
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
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p class="login-link">Don't have an account? 
            <a href="/bnb-project/pages/register.php">Register</a>
        </p>
    </main>

    <footer>
        <p>&copy; 2025 BNB Project. All rights reserved.</p>
    </footer>
</body>
</html>