<?php
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $csn = $_POST['lastname'];
    $un = $_POST['firstname'];
    $u = $_POST['username'];
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT); // Biztonságos jelszó tárolás

    if (!empty($csn) && !empty($un) && !empty($u) && !empty($_POST['password'])) {
        try {
            $sql = "INSERT INTO felhasznalok (csaladi_nev, utonev, bejelentkezes, jelszo) VALUES (?, ?, ?, ?)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$csn, $un, $u, $p]);
            $msg = "<p style='color: #28a745;'>Registration successful! You can now log in.</p>";
        } catch (PDOException $e) {
            $msg = "<p style='color: #ff4d4d;'>Error: Username already exists!</p>";
        }
    } else {
        $msg = "<p style='color: #ff4d4d;'>Please fill all fields!</p>";
    }
}
?>

<div class="container">
    <div style="max-width: 400px; margin: auto; background: #333; padding: 20px; border-radius: 10px; margin-top: 30px;">
        <h2>Registration</h2>
        <?= $msg ?>
        <form method="post">
            <label>Last Name:</label>
            <input type="text" name="lastname" required>
            <label>First Name:</label>
            <input type="text" name="firstname" required>
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit" style="width: 100%; margin-top: 10px;">Register</button>
        </form>
        <p style="text-align: center; margin-top: 10px;"><a href="index.php?page=login" style="color: #e50914;">Back to Login</a></p>
    </div>
</div>