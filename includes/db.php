<?php
// includes/db.php

$conn = new mysqli('localhost', 'root', '', 'bnb_project');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}