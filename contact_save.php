<?php
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Szerver oldali validáció (PHP)
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $msg   = trim($_POST['message'] ?? '');

    if (empty($name)) {
        $errors[] = "A név mező kötelező!";
    } elseif (strlen($name) < 2) {
        $errors[] = "A névnek legalább 2 karakter hosszúnak kell lennie!";
    }

    if (empty($email)) {
        $errors[] = "Az email mező kötelező!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Érvénytelen email cím formátum!";
    }

    if (empty($msg)) {
        $errors[] = "Az üzenet mező kötelező!";
    } elseif (strlen($msg) < 5) {
        $errors[] = "Az üzenetnek legalább 5 karakter hosszúnak kell lennie!";
    }

    // Ha nincs hiba, mentjük az adatbázisba
    if (empty($errors)) {
        try {
            // Ha be van jelentkezve, eltároljuk a nevét, különben "Vendég"
            $sender = isset($_SESSION['login'])
                ? ($_SESSION['csaladi_nev'] . ' ' . $_SESSION['utonev'])
                : 'Vendég';

            $sql  = "INSERT INTO uzenetek (nev, email, szoveg, kuldo, datum) VALUES (?, ?, ?, ?, NOW())";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$name, $email, $msg, $sender]);
            $success = true;
        } catch (PDOException $e) {
            $errors[] = "Adatbázis hiba: " . $e->getMessage();
        }
    }
}
?>

<!-- 5. oldal: az elküldött adatok megjelenítése -->
<div class="container">
    <h2>📨 Üzenet elküldve</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <strong>❌ Hibák az űrlapon:</strong>
            <ul style="margin: 8px 0 0 20px;">
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <p><a href="index.php?page=contact" class="btn btn-secondary">← Vissza az űrlaphoz</a></p>

    <?php elseif ($success): ?>
        <div class="alert alert-success">✅ Az üzenetet sikeresen elküldtük!</div>

        <!-- Az elküldött adatok megjelenítése -->
        <div style="background: #222; border: 1px solid #333; border-radius: 8px; padding: 25px; max-width: 500px; margin-top: 20px;">
            <h3 style="color: #e50914; margin-top: 0;">Az elküldött üzenet adatai:</h3>
            <table style="width: 100%; margin-top: 10px;">
                <tr>
                    <th style="width: 30%;">Név:</th>
                    <td><?= htmlspecialchars($name) ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?= htmlspecialchars($email) ?></td>
                </tr>
                <tr>
                    <th>Üzenet:</th>
                    <td><?= nl2br(htmlspecialchars($msg)) ?></td>
                </tr>
                <tr>
                    <th>Küldés ideje:</th>
                    <td><?= date('Y-m-d H:i:s') ?></td>
                </tr>
            </table>
        </div>

        <p style="margin-top: 20px;">
            <a href="index.php?page=home" class="btn">🏠 Vissza a főoldalra</a>
            <a href="index.php?page=contact" class="btn btn-secondary" style="margin-left: 10px;">✉️ Új üzenet küldése</a>
        </p>

    <?php else: ?>
        <div class="alert alert-error">❌ Érvénytelen kérés.</div>
        <p><a href="index.php?page=contact" class="btn btn-secondary">← Vissza az űrlaphoz</a></p>
    <?php endif; ?>
</div>
