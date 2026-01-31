<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "university_lms";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session securely on every page that includes this
session_start();
?>