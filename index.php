<?php
session_start();

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

$allowed_pages = ['home', 'gallery', 'contact', 'contact_save', 'crud', 'messages', 'login', 'logout', 'registration'];

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Project</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="header-top">
        <div class="logo">🎬 CinemaProject</div>
        <?php if(isset($_SESSION['login'])): ?>
            <div class="user-info">
                Bejelentkezett: <strong><?= htmlspecialchars($_SESSION['csaladi_nev'] . " " . $_SESSION['utonev']) ?></strong>
                (<?= htmlspecialchars($_SESSION['login']) ?>)
            </div>
        <?php endif; ?>
        <button class="hamburger" id="hamburgerBtn" aria-label="Menü megnyitása">&#9776;</button>
    </div>
    <nav>
        <ul id="navMenu">
            <li><a href="index.php?page=home">Főoldal</a></li>
            <li><a href="index.php?page=gallery">Képek</a></li>
            <li><a href="index.php?page=contact">Kapcsolat</a></li>
            <li><a href="index.php?page=crud">CRUD</a></li>
            <?php if(!isset($_SESSION['login'])): ?>
                <li><a href="index.php?page=login">Bejelentkezés</a></li>
            <?php else: ?>
                <li><a href="index.php?page=messages">Üzenetek</a></li>
                <li><a href="index.php?page=logout">Kilépés</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>
    <?php
    if (in_array($page, $allowed_pages)) {
        if (file_exists($page . ".php")) {
            include($page . ".php");
        } else {
            echo "<div class='container' style='padding:50px; text-align:center;'>
                    <h2>Az oldal nem található!</h2>
                    <p>Hiányzó fájl: <b>$page.php</b></p>
                  </div>";
        }
    } else {
        include("home.php");
    }
    ?>
</main>

<footer>
    <p>&copy; 2026 Cinema Project – Web-programozás 1. beadandó</p>
</footer>

<script>
// Hamburger menü
document.getElementById('hamburgerBtn').addEventListener('click', function() {
    document.getElementById('navMenu').classList.toggle('open');
});
</script>

</body>
</html>
