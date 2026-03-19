<?php
session_start();

// Database credentials
$servername = "sql303.infinityfree.com";
$username = "if0_41428018";
$password = "YOUR_PASSWORD";
$dbname = "if0_41428018_adatok";

// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Error handling for connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize user input to prevent SQL Injection
$login_name = $conn->real_escape_string($_POST['login']);
$password_input = $_POST['password'];

// Fetch user data from the database
$query = "SELECT * FROM users WHERE username = '$login_name'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    
    // Verify the hashed password
    if (password_verify($password_input, $user_data['password'])) {
        // Authentication successful - Set session variables
        $_SESSION['user_id'] = $user_data['id'];
        $_SESSION['last_name'] = $user_data['last_name'];
        $_SESSION['first_name'] = $user_data['first_name'];
        $_SESSION['username'] = $user_data['username'];
        
        // Redirect to homepage
        header("Location: index.php");
        exit();
    } else {
        // Invalid password
        header("Location: login.php?error=invalid_credentials");
        exit();
    }
} else {
    // User not found
    header("Location: login.php?error=user_not_found");
    exit();
}

$conn->close();
?>