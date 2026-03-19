<?php
$servername = "sql303.infinityfree.com";
$username = "if0_41428018";
$password = "IITiAvhArV";
$dbname = "if0_41428018_adatok";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

$vnev = $conn->real_escape_string($_POST['vnev']);
$unev = $conn->real_escape_string($_POST['unev']);
$login = $conn->real_escape_string($_POST['login']);
// Jelszó titkosítása
$jelszo = password_hash($_POST['jelszo'], PASSWORD_DEFAULT);

$sql = "INSERT INTO felhasznalok (csaladi_nev, uto_nev, bejelentkezes, jelszo) 
        VALUES ('$vnev', '$unev', '$login', '$jelszo')";

if ($conn->query($sql) === TRUE) {
    header("Location: login.php?siker=1");
} else {
    echo "Hiba: " . $conn->error;
}
$conn->close();
?>