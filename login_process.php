<?php
session_start();

$servername = "sql303.infinityfree.com";
$username = "if0_41428018";
$password = "IITiAvhArV"; 
$dbname = "if0_41428018_adatok";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if ($conn->connect_error) { die("Hiba: " . $conn->connect_error); }

if (isset($_POST['login']) && isset($_POST['jelszo'])) {
    $login_name = $conn->real_escape_string($_POST['login']);
    $password_input = $_POST['jelszo'];

    // A táblád neve 'felhasznalok', az oszlop 'bejelentkezes'
    $query = "SELECT * FROM felhasznalok WHERE bejelentkezes = '$login_name'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        
        // Az oszlop neve nálad 'jelszo'
        if (password_verify($password_input, $user_data['jelszo'])) {
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['last_name'] = $user_data['csaladi_nev'];
            $_SESSION['first_name'] = $user_data['uto_nev'];
            $_SESSION['username'] = $user_data['bejelentkezes'];
            
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php?error=invalid_password");
            exit();
        }
    } else {
        header("Location: login.php?error=user_not_found");
        exit();
    }
}
?>