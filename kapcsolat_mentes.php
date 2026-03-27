<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nev = $_POST['nev'];
    $email = $_POST['email'];
    $szoveg = $_POST['szoveg'];

    // Szerveroldali ellenőrzés [cite: 36]
    if (empty($nev) || empty($email) || empty($szoveg)) {
        die("Hiba: Üres mezők!");
    }

    // Mentés az adatbázisba [cite: 35]
    $sql = "INSERT INTO uzenetek (nev, email, szoveg) VALUES (?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nev, $email, $szoveg]);

    echo "Köszönjük az üzenetet! Az adatait elmentettük.";
}
?>