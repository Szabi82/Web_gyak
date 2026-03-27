<?php 
include('header.php'); 

// Csak bejelentkezett felhasználók használhatják
if (!isset($_SESSION['user_id'])) {
    echo "<div class='container'><div class='content-block'><h2>Kérlek, jelentkezz be az üzenetek megtekintéséhez!</h2></div></div>";
    exit();
}

$servername = "sql303.infinityfree.com";
$username = "if0_41428018";
$password = "IITiAvhArV"; 
$dbname = "if0_41428018_adatok";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if ($conn->connect_error) { die("Hiba: " . $conn->connect_error); }

// --- 1. ÚJ ÜZENET MENTÉSE ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_msg'])) {
    $msg = $conn->real_escape_string($_POST['message_content']);
    $uid = $_SESSION['user_id']; // A bejelentkezett user ID-ja

    if (!empty(trim($msg))) {
        // JAVÍTVA: magyar tábla és oszlopnevek
        $sql = "INSERT INTO uzenetek (felhasznalo_id, uzenet_szovege) VALUES ('$uid', '$msg')";
        $conn->query($sql);
        header("Location: uzenetek.php");
        exit();
    }
}

// --- 2. ÜZENETEK LEKÉRÉSE (Összekötve a felhasználók nevével) ---
$query = "SELECT uzenetek.*, felhasznalok.csaladi_nev, felhasznalok.uto_nev 
          FROM uzenetek 
          JOIN felhasznalok ON uzenetek.felhasznalo_id = felhasznalok.id 
          ORDER BY uzenetek.id DESC"; 
$result = $conn->query($query);
?>

<div class="container">
    <div class="content-block">
        <h2>Üzenőfal</h2>
        
        <div style="background: #252525; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #333;">
            <form action="uzenetek.php" method="POST">
                <textarea name="message_content" placeholder="Írj valamit a falra..." required 
                          style="width: 100%; padding: 10px; background: #121212; color: white; border: 1px solid #444; border-radius: 5px; min-height: 80px;"></textarea>
                <button type="submit" name="send_msg" class="btn" style="margin-top: 10px;">Üzenet küldése</button>
            </form>
        </div>
<div class="message-list">
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="message-card">
                <div class="message-header">
                    <span class="message-user">
                        <?php echo htmlspecialchars($row['csaladi_nev'] . " " . $row['uto_nev']); ?>
                    </span>
                    <span class="message-date">
                        <?php echo date('Y.m.d H:i', strtotime($row['letrehozva'])); ?>
                    </span>
                </div>
                <div class="message-text">
                    <?php echo nl2br(htmlspecialchars($row['uzenet_szovege'])); ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align: center; color: #888;">Még nincsenek üzenetek. Legyél te az első!</p>
    <?php endif; ?>
</div>




    </div>
</div>
<?php $conn->close(); ?>