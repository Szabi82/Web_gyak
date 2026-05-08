<h2>📩 Beérkezett üzenetek</h2>

<?php if (empty($msgs)): ?>
    <div class="alert alert-info">Még nem érkezett üzenet.</div>
<?php else: ?>
    <p style="color:#aaa;font-size:14px;">Összesen <?= count($msgs) ?> üzenet – legfrissebb elöl.</p>
    <div style="overflow-x:auto;">
        <table>
            <tr>
                <th>Küldő</th><th>Név (űrlapból)</th><th>Email</th><th>Üzenet</th><th>Dátum</th>
            </tr>
            <?php foreach ($msgs as $m): ?>
            <tr>
                <td><?= htmlspecialchars(!empty($m['kuldo']) ? $m['kuldo'] : 'Vendég') ?></td>
                <td><?= htmlspecialchars($m['nev']) ?></td>
                <td><?= htmlspecialchars($m['email']) ?></td>
                <td><?= nl2br(htmlspecialchars($m['szoveg'])) ?></td>
                <td style="white-space:nowrap;color:#aaa;font-size:12px;"><?= htmlspecialchars($m['datum']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>
