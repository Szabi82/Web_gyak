<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>High-End Streamer Project</title>
    <link rel="stylesheet" href="stilus.css">
</head>
<body>

<header>
    <div class="container header-flex">
        <div class="logo">
            <span style="color: #00adb5;">High-End</span> Streamer
        </div>
        
        <div class="user-status">
            <?php if(isset($_SESSION['user_id'])): ?>
                <span class="welcome-text">Bejelentkezett: 
                    <strong><?php echo $_SESSION['last_name'] . " " . $_SESSION['first_name'] . " (" . $_SESSION['username'] . ")"; ?></strong>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <nav>
        <div class="container nav-flex">
            <a href="index.php">Főoldal</a>
           <a href="picture.php">Képek</a>
            <a href="kapcsolat.php">Kapcsolat</a>
            <a href="crud.php">CRUD</a>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="uzenetek.php">Üzenetek</a>
                <a href="logout.php" class="logout-btn">Kilépés</a>
            <?php else: ?>
                <a href="login.php" class="login-btn">Bejelentkezés</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main class="container">