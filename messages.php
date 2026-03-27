<?php
if (!isset($_SESSION['login'])) { die("Access denied!"); }

$stmt = $dbh->query("SELECT * FROM uzenetek ORDER BY datum DESC");
$msgs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <h2>Inbound Messages</h2>
    <table>
        <tr><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>
        <?php foreach($msgs as $m): ?>
        <tr>
            <td><?= htmlspecialchars($m['nev']) ?></td>
            <td><?= htmlspecialchars($m['email']) ?></td>
            <td><?= nl2br(htmlspecialchars($m['szoveg'])) ?></td>
            <td><?= $m['datum'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>