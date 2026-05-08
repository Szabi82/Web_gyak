<?php
if(isset($_POST['belepes'])) {
    $felhasznalo = $_POST['felhasznalo'];
    $jelszo      = sha1($_POST['jelszo']);

    $stmt = $dbh->prepare("SELECT * FROM felhasznalok WHERE bejelentkezes=? AND jelszo=?");
    $stmt->execute([$felhasznalo, $jelszo]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row) {
        $_SESSION['login'] = $row['bejelentkezes'];
        $_SESSION['csn']   = $row['csaladi_nev'];
        $_SESSION['un']    = $row['utonev'];
    }
}
?>
