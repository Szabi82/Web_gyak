<?php include('header.php'); ?>

<div class="content-block">
    <div style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 40px;">
        
        <div style="flex: 1; min-width: 300px;">
            <h2>Regisztráció</h2>
            <form action="regisztracio_feldolgoz.php" method="POST">
                <input type="text" name="vnev" placeholder="Családi név" required>
                <input type="text" name="unev" placeholder="Utónév" required>
                <input type="text" name="login" placeholder="Felhasználónév (Login)" required>
                <input type="password" name="jelszo" placeholder="Jelszó" required>
                <button type="submit" class="btn">Regisztrálok</button>
            </form>
        </div>

        <div style="flex: 1; min-width: 300px; border-left: 1px solid #333; padding-left: 20px;">
            <h2>Belépés</h2>
            <form action="belep_feldolgoz.php" method="POST">
                <input type="text" name="login" placeholder="Felhasználónév" required>
                <input type="password" name="jelszo" placeholder="Jelszó" required>
                <button type="submit" class="btn" style="background-color: #333; border: 1px solid #00adb5;">Belépés</button>
            </form>
        </div>

    </div>
</div>

<?php if(isset($_GET['siker'])): ?>
    <p style="color: #00adb5; text-align: center;">Sikeres regisztráció! Most már beléphetsz.</p>
<?php endif; ?>

<?php if(isset($_GET['hiba'])): ?>
    <p style="color: #e74c3c; text-align: center;">Hiba: Rossz felhasználónév vagy jelszó!</p>
<?php endif; ?>

</body>
</html>