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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Admin Dashboard Styles */
        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .dashboard-section {
            width: 80%;
            margin: 20px 0;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-section h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .dashboard-section form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .dashboard-section input, .dashboard-section textarea, .dashboard-section select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .dashboard-section button {
            padding: 10px;
            background: #ee9b00;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .dashboard-section button:hover {
            background: #ca6702;
        }

        .dashboard-section table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .dashboard-section table th, .dashboard-section table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .dashboard-section table th {
            background: #f4f4f4;
        }

        .dashboard-section table td button {
            padding: 5px 10px;
            background: #ff6347;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .dashboard-section table td button:hover {
            background: #ff4500;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/bnb-project/index.php">Home</a></li>
                <li><a href="/bnb-project/pages/admin_dashboard.php">Admin Dashboard</a></li>
                <li><a href="/bnb-project/includes/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="dashboard-container">
        <!-- About Us Section -->
        <div class="dashboard-section">
            <h2>Manage About Us</h2>
            <form action="/bnb-project/includes/update_aboutus.php" method="post">
                <textarea name="content" rows="5" placeholder="Update About Us content"></textarea>
                <button type="submit">Update</button>
            </form>
        </div>

        <!-- Bookings Section -->
        <div class="dashboard-section">
            <h2>Manage Bookings</h2>
            <?php
            $bookings = $conn->query("SELECT * FROM bookings");
            if ($bookings->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Room ID</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Action</th>
                        </tr>";
                while ($row = $bookings->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['user_id']}</td>
                            <td>{$row['room_id']}</td>
                            <td>{$row['check_in']}</td>
                            <td>{$row['check_out']}</td>
                            <td><button onclick=\"deleteBooking({$row['id']})\">Delete</button></td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No bookings found.</p>";
            }
            ?>
        </div>

        <!-- Contacts Section -->
        <div class="dashboard-section">
            <h2>Manage Messages</h2>
            <?php
            $messages = $conn->query("SELECT * FROM contacts");
            if ($messages->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>";
                while ($row = $messages->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['message']}</td>
                            <td><button onclick=\"deleteMessage({$row['id']})\">Delete</button></td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No messages found.</p>";
            }
            ?>
        </div>

        <!-- Rooms Section -->
        <div class="dashboard-section">
            <h2>Manage Rooms</h2>
            <form action="add_room.php" method="post">
                <input type="text" name="name" placeholder="Room Name" required>
                <textarea name="description" placeholder="Room Description" required></textarea>
                <input type="number" name="price" placeholder="Price" required>
                <input type="text" name="image" placeholder="Image URL" required>
                <button type="submit">Add Room</button>
            </form>
            <?php
            $rooms = $conn->query("SELECT * FROM rooms");
            if ($rooms->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>";
                while ($row = $rooms->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['description']}</td>
                            <td>{$row['price']}</td>
                            <td><img src='../images/{$row['image']}' width='100'></td>
                            <td><button onclick=\"deleteRoom({$row['id']})\">Delete</button></td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No rooms found.</p>";
            }
            ?>
        </div>

        <!-- Users Section -->
        <div class="dashboard-section">
            <h2>Manage Users</h2>
            <?php
            $users = $conn->query("SELECT * FROM users");
            if ($users->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>";
                while ($row = $users->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['role']}</td>
                            <td><button onclick=\"deleteUser({$row['id']})\">Delete</button></td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No users found.</p>";
            }
            ?>
        </div>
    </main>

    

    <script>
        function deleteBooking(id) {
            if (confirm("Are you sure you want to delete this booking?")) {
                window.location.href = `/bnb-project/includes/delete_booking.php?id=${id}`;
            }
        }

        function deleteMessage(id) {
            if (confirm("Are you sure you want to delete this message?")) {
                window.location.href = `/bnb-project/includes/delete_message.php?id=${id}`;
            }
        }

        function deleteRoom(id) {
            if (confirm("Are you sure you want to delete this room?")) {
                window.location.href = `/bnb-project/includes/delete_room.php?id=${id}`;
            }
        }

        function deleteUser(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = `/bnb-project/includes/delete_user.php?id=${id}`;
            }
        }
    </script>
</body>
</html>