<?php
$stmt = $dbh->query("SELECT * FROM film");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <h2>Movie Management (CRUD)</h2>
    <table>
        <tr><th>ID</th><th>Title</th><th>Year</th><th>Director</th><th>Genre</th></tr>
        <?php foreach($movies as $f): ?>
        <tr>
            <td><?= $f['id'] ?></td>
            <td><?= $f['cim'] ?></td>
            <td><?= $f['ev'] ?></td>
            <td><?= $f['rendezo'] ?></td>
            <td><?= $f['mufaj'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
