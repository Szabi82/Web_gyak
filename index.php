<?php
session_start();

// InfinityFree Adatbázis csatlakozás
$host = 'sql303.infinityfree.com';
$dbname = 'if0_41428018_mozi_adatbazis'; 
$user = 'if0_41428018';
$pass = 'IITiAvhArV'; 

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, 
                  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    $db_error = "Database connection failed.";
}

// 1. EGYSÉGES LISTA: Itt definiáljuk az összes elérhető oldalt
$allowed_pages = ['home', 'gallery', 'contact', 'contact_save', 'crud', 'messages', 'login', 'logout', 'registration'];

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Project</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="index.php?page=home">Home</a></li>
            <li><a href="index.php?page=gallery">Gallery</a></li>
            <li><a href="index.php?page=contact">Contact</a></li>
            <li><a href="index.php?page=crud">Movies</a></li>
            
            <?php if(!isset($_SESSION['login'])): ?>
                <li><a href="index.php?page=login">Login</a></li>
                <li><a href="index.php?page=registration">Register</a></li>
            <?php else: ?>
                <li><a href="index.php?page=messages">Messages</a></li>
                <li><a href="index.php?page=logout">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <?php if(isset($_SESSION['login'])): ?>
        <div style="text-align: right; padding: 10px; color: #aaa; background: #222; font-size: 14px;">
            Logged in as: <strong><?= htmlspecialchars($_SESSION['csaladi_nev'] . " " . $_SESSION['utonev']) ?></strong>
        </div>
    <?php endif; ?>
</header>

<main>
    <?php
    // 2. ELLENŐRZÉS: Itt is ugyanazt a listát használjuk, amit felül definiáltunk
    if (in_array($page, $allowed_pages)) {
        if (file_exists($page . ".php")) {
            include($page . ".php");
        } else {
            echo "<div class='container' style='padding:50px; text-align:center;'>
                    <h2>Page not found!</h2>
                    <p>A fájl hiányzik: <b>$page.php</b></p>
                  </div>";
        }
    } else {
        include("home.php");
    }
    ?>
</main>

<footer style="margin-top: 50px; border-top: 1px solid #333;">
    <p style="text-align: center; padding: 20px; color: #666;">&copy; 2026 Cinema Project - Web-prog 1</p>
</footer>

</body>
</html>