<?php
// Elkapjuk a POST-tal küldött adatokat
$nev = $_POST['felhasznalonev'];
$uzenet = $_POST['uzenet'];

echo "<h2>Adat megérkezett a szerverre!</h2>";
echo "<b>Név:</b> " . $nev . "<br>";
echo "<b>Üzenet:</b> " . $uzenet . "<br>";

echo "<br><a href='index.php'>Vissza az űrlaphoz</a>";
?>