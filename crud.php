<?php
// 1. Lekérjük a filmeket az adatbázisból
$sql = "SELECT * FROM film";
$stmt = $dbh->query($sql);
$filmek = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Filmek kezelése (CRUD)</h2>
<button style="background-color: #007bff; color: white; padding: 10px; border: none; border-radius: 5px; margin-bottom: 10px;">
    Új film hozzáadása
</button>

<table border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
    <tr style="background-color: #f2f2f2;">
        <th>ID</th>
        <th>Cím</th>
        <th>Év</th>
        <th>Rendező</th>
        <th>Műfaj</th>
        <th>Műveletek</th>
    </tr>
    <?php foreach($filmek as $film): ?>
    <tr>
        <td><?= $film['id'] ?></td>
        <td><strong><?= $film['cim'] ?></strong></td>
        <td><?= $film['ev'] ?></td>
        <td><?= $film['rendezo'] ?></td>
        <td><?= $film['mufaj'] ?></td>
        <td>
            <button style="background-color: #007bff; color: white; border: none; padding: 5px 10px; border-radius: 3px;">Szerkesztés</button>
            <button style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 3px;">Törlés</button>
        </td>
    </tr>
    <?php endforeach; ?>
</table>