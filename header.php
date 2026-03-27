<nav>
    <ul style="display: flex; list-style: none; gap: 20px; background: #333; padding: 10px;">
        <li><a href="index.php?oldal=fooldal" style="color: white;">Főoldal</a></li>
        <li><a href="index.php?oldal=kepek" style="color: white;">Képek</a></li>
        <li><a href="index.php?oldal=kapcsolat" style="color: white;">Kapcsolat</a></li>
        <li><a href="index.php?oldal=crud" style="color: white;">CRUD (Filmek)</a></li>
        
        <?php if(!isset($_SESSION['login'])): ?>
            <li><a href="index.php?oldal=bejelentkezes" style="color: white;">Bejelentkezés</a></li>
        <?php else: ?>
            <li><a href="index.php?oldal=uzenetek" style="color: white;">Üzenetek</a></li>
            <li><a href="index.php?oldal=kilepes" style="color: white;">Kilépés</a></li>
        <?php endif; ?>
    </ul>
</nav>

<?php if(isset($_SESSION['login'])): ?>
    <div style="text-align: right; padding: 5px;">
        Bejelentkezett: <?= $_SESSION['csaladi_nev'] . " " . $_SESSION['utonev'] . " (" . $_SESSION['login'] . ")" ?>
    </div>
<?php endif; ?>