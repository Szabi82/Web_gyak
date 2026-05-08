<?php
if (!isset($_SESSION['login'])) {
    header("Location: belepes");
    exit();
}
$stmt = $dbh->query("SELECT * FROM uzenetek ORDER BY datum DESC");
$msgs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
