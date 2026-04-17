<?php
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pw = $_POST['password'];

    $stmt = $dbh->prepare("SELECT * FROM felhasznalok WHERE bejelentkezes = ?");
    $stmt->execute([$user]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($pw, $row['jelszo'])) {
        $_SESSION['login'] = $row['bejelentkezes'];
        $_SESSION['csaladi_nev'] = $row['csaladi_nev'];
        $_SESSION['utonev'] = $row['utonev'];
        header("Location: index.php?page=home");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<


<div class="container">
    <div style="max-width: 400px; margin: auto; background: #333; padding: 20px; border-radius: 10px; margin-top: 50px;">
        <h2>Login</h2>
        <?php if($error) echo "<p style='color: #ff4d4d;'>$error</p>"; ?>
        
        <form method="post">
            <label>Username:</label>
            <input type="text" name="username" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit" style="width: 100%; margin-top: 10px;">Sign In</button>
        </form>
        p style="text-align: center; margin-top: 15px;">
    Don't have an account? <a href="index.php?page=registration" style="color: #e50914;">Register here</a>
</p>
        <p style="font-size: 12px; color: #888; margin-top: 15px;">Hint: admin / admin123</p>
    </div>
</div>