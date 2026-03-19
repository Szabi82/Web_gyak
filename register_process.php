<?php
// Database connection setup
$servername = "sql303.infinityfree.com";
$username = "if0_41428018";
$password = " IITiAvhArV";
$dbname = "if0_41428018_adatok";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST and sanitize
$last_name = $conn->real_escape_string($_POST['vnev']);
$first_name = $conn->real_escape_string($_POST['unev']);
$username_input = $conn->real_escape_string($_POST['login']);

// Secure password hashing
$hashed_password = password_hash($_POST['jelszo'], PASSWORD_DEFAULT);

// SQL Query using English field names (make sure to rename them in phpMyAdmin!)
$sql = "INSERT INTO users (last_name, first_name, username, password) 
        VALUES ('$last_name', '$first_name', '$username_input', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    // Success - redirect back to login with success message
    header("Location: login.php?success=1");
    exit();
} else {
    echo "Error during registration: " . $conn->error;
}

$conn->close();
?>