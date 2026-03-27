<?php
session_start();
// Adatbázis csatlakozás (PDO) - Írd be a saját adataidat!
try {
    $dbh = new PDO('mysql:host=localhost;dbname=mozi_adatbazis', 'root', '', 
                  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}

// Meghatározzuk, melyik oldalt kell betölteni
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
            <?php else: ?>
                <li><a href="index.php?page=messages">Messages</a></li>
                <li><a href="index.php?page=logout">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <?php if(isset($_SESSION['login'])): ?>
        <div style="text-align: right; padding: 10px; color: #aaa;">
            Logged in as: <?= $_SESSION['csaladi_nev'] . " " . $_SESSION['utonev'] ?>
        </div>
    <?php endif; ?>
</header>

<main>
    <?php
    // Itt történik a "legózás": betöltjük a kért oldalt
    $allowed_pages = ['home', 'gallery', 'contact', 'contact_save', 'crud', 'messages', 'login', 'logout'];
    
    if (in_array($page, $allowed_pages)) {
        if (file_exists($page . ".php")) {
            include($page . ".php");
        } else {
            echo "<div class='container'><h2>Page not found!</h2></div>";
        }
    } else {
        include("home.php");
    }
    ?>
</main>

<footer>
    <p style="text-align: center; padding: 20px;">&copy; 2026 Cinema Project - Web-prog 1</p>
</footer>

</body>
</html>