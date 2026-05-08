<?php
$uzenet = "";
$ujra   = false;

if(isset($_POST['regisztracio'])) {
    $csn = trim($_POST['vezeteknev'] ?? '');
    $un  = trim($_POST['utonev']     ?? '');
    $u   = trim($_POST['felhasznalo'] ?? '');
    $j   = sha1($_POST['jelszo']     ?? '');

    if(!empty($csn) && !empty($un) && !empty($u) && !empty($_POST['jelszo'])) {
        try {
            $stmt = $dbh->prepare("INSERT INTO felhasznalok (csaladi_nev, utonev, bejelentkezes, jelszo) VALUES (?,?,?,?)");
            $stmt->execute([$csn, $un, $u, $j]);
            $uzenet = "✅ Sikeres regisztráció! Most már bejelentkezhet.";
            $ujra   = false;
        } catch(PDOException $e) {
            $uzenet = "❌ Hiba: A felhasználónév már foglalt!";
            $ujra   = true;
        }
    } else {
        $uzenet = "❌ Kérjük, töltse ki az összes mezőt!";
        $ujra   = true;
    }
}
?>
