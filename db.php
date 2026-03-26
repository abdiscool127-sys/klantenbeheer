<?php
// Database connection

// Database settings
$host = "localhost";
$user = "root";
$password = "";
$database = "klanten_db";

// Create MySQL connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Error: Unable to connect to database: " . $conn->connect_error);
}
?>