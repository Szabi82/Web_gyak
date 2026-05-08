<?php
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $csn = trim($_POST['lastname']);
    $un  = trim($_POST['firstname']);
    $u   = trim($_POST['username']);
    $pw  = $_POST['password'];

    if (!empty($csn) && !empty($un) && !empty($u) && !empty($pw)) {
        $p = password_hash($pw, PASSWORD_DEFAULT);
        try {
            $sql  = "INSERT INTO felhasznalok (csaladi_nev, utonev, bejelentkezes, jelszo) VALUES (?, ?, ?, ?)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$csn, $un, $u, $p]);
            $msg = "<div class='alert alert-success'>✅ Sikeres regisztráció! Most már bejelentkezhetsz.</div>";
        } catch (PDOException $e) {
            $msg = "<div class='alert alert-error'>❌ Hiba: A felhasználónév már foglalt!</div>";
        }
    } else {
        $msg = "<div class='alert alert-error'>❌ Kérjük, töltsd ki az összes mezőt!</div>";
    }
}
?>

<div class="container">
    <div style="max-width: 420px; margin: 30px auto; background: #2a2a2a; padding: 30px; border-radius: 10px; border: 1px solid #333;">
        <h2 style="text-align: center; color: #e50914; margin-top: 0;">📝 Regisztráció</h2>

        <?= $msg ?>

        <form method="post">
            <label>Vezetéknév:</label>
            <input type="text" name="lastname" required>

            <label>Keresztnév:</label>
            <input type="text" name="firstname" required>

            <label>Felhasználónév:</label>
            <input type="text" name="username" required>

            <label>Jelszó:</label>
            <input type="password" name="password" required>

            <button type="submit" style="width: 100%; margin-top: 15px;">Regisztráció</button>
        </form>

        <p style="text-align: center; margin-top: 15px; font-size: 14px;">
            Már van fiókod? <a href="index.php?page=login" style="color: #e50914;">Bejelentkezés</a>
        </p>
    </div>
</div>
