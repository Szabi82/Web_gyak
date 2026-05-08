<?php
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pw   = $_POST['password'];

    $stmt = $dbh->prepare("SELECT * FROM felhasznalok WHERE bejelentkezes = ?");
    $stmt->execute([$user]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($pw, $row['jelszo'])) {
        $_SESSION['login']       = $row['bejelentkezes'];
        $_SESSION['csaladi_nev'] = $row['csaladi_nev'];
        $_SESSION['utonev']      = $row['utonev'];
        header("Location: index.php?page=home");
        exit();
    } else {
        $error = "Hibás felhasználónév vagy jelszó!";
    }
}
?>

<div class="container">
    <div style="max-width: 400px; margin: 50px auto; background: #2a2a2a; padding: 30px; border-radius: 10px; border: 1px solid #333;">
        <h2 style="text-align: center; color: #e50914; margin-top: 0;">🔐 Bejelentkezés</h2>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <label>Felhasználónév:</label>
            <input type="text" name="username" required autofocus>

            <label>Jelszó:</label>
            <input type="password" name="password" required>

            <button type="submit" style="width: 100%; margin-top: 15px;">Bejelentkezés</button>
        </form>

        <p style="text-align: center; margin-top: 20px; color: #aaa; font-size: 14px;">
            Még nincs fiókod? <a href="index.php?page=registration" style="color: #e50914;">Regisztrálj itt</a>
        </p>
    </div>
</div>
