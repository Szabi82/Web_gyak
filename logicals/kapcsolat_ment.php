<?php
$errors  = [];
$success = false;
$k_name  = '';
$k_email = '';
$k_msg   = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $k_name  = trim($_POST['name']    ?? '');
    $k_email = trim($_POST['email']   ?? '');
    $k_msg   = trim($_POST['message'] ?? '');

    if (empty($k_name))               { $errors[] = "A név mező kötelező!"; }
    elseif (strlen($k_name) < 2)      { $errors[] = "A névnek legalább 2 karakter hosszúnak kell lennie!"; }

    if (empty($k_email))              { $errors[] = "Az email mező kötelező!"; }
    elseif (!filter_var($k_email, FILTER_VALIDATE_EMAIL)) { $errors[] = "Érvénytelen email cím formátum!"; }

    if (empty($k_msg))                { $errors[] = "Az üzenet mező kötelező!"; }
    elseif (strlen($k_msg) < 5)       { $errors[] = "Az üzenetnek legalább 5 karakter hosszúnak kell lennie!"; }

    if (empty($errors)) {
        try {
            $sender = isset($_SESSION['login'])
                ? ($_SESSION['csn'] . ' ' . $_SESSION['un'])
                : 'Vendég';

            $stmt = $dbh->prepare("INSERT INTO uzenetek (nev, email, szoveg, kuldo, datum) VALUES (?, ?, ?, ?, NOW())");
            $stmt->execute([$k_name, $k_email, $k_msg, $sender]);
            $success = true;
        } catch (PDOException $e) {
            $errors[] = "Adatbázis hiba: " . $e->getMessage();
        }
    }
}
?>
