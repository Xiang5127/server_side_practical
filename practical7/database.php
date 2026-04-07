<?php
// Default XAMPP Credentials
$servername = "localhost";
$username = "root";      // Default XAMPP user
$password = "";          // Default XAMPP password is empty
$dbname = "practical 7";     // Change this to your actual database name

// 1. Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// 2. Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 3. Set charset to UTF-8 (Crucial for Malaysian names/addresses)
$con->set_charset("utf8mb4");

echo "Connected successfully to the Data Tier!";
?>