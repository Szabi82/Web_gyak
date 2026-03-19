<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stilus.css">
    <title>High-End Streamer Projekt</title>
</head>
<body>
    <header>
        <div class="user-info">
            <?php if(isset($_SESSION['user_id'])): ?>
                Bejelentkezett: <?php echo $_SESSION['vezeteknev'] . " " . $_SESSION['utonev'] . " (" . $_SESSION['login'] . ")"; ?>
            <?php endif; ?>
        </div>
        <nav>
            <a href="index.php">Főoldal</a>
            <a href="kepek.php">Képek</a>
            <a href="kapcsolat.php">Kapcsolat</a>
            <a href="crud.php">CRUD</a>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="uzenetek.php">Üzenetek</a>
                <a href="logout.php">Kilépés</a>
            <?php else: ?>
                <a href="login.php">Bejelentkezés</a>
            <?php endif; ?>
        </nav>
    </header>
    <div class="container">