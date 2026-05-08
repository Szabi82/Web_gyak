<h2>📨 Üzenet elküldve</h2>

<?php if (!empty($errors)): ?>
    <div class="alert alert-error">
        <strong>❌ Hibák az űrlapon:</strong>
        <ul style="margin: 8px 0 0 20px;">
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <p><a href="kapcsolat" class="btn btn-secondary">← Vissza az űrlaphoz</a></p>

<?php elseif ($success): ?>
    <div class="alert alert-success">✅ Az üzenetet sikeresen elküldtük!</div>

    <div style="background: #222; border: 1px solid #333; border-radius: 8px; padding: 25px; max-width: 500px; margin-top: 20px;">
        <h3 style="margin-top: 0;">Az elküldött üzenet adatai:</h3>
        <table style="width: 100%; margin-top: 10px;">
            <tr><th style="width:30%;">Név:</th><td><?= htmlspecialchars($k_name) ?></td></tr>
            <tr><th>Email:</th><td><?= htmlspecialchars($k_email) ?></td></tr>
            <tr><th>Üzenet:</th><td><?= nl2br(htmlspecialchars($k_msg)) ?></td></tr>
            <tr><th>Küldés ideje:</th><td><?= date('Y-m-d H:i:s') ?></td></tr>
        </table>
    </div>

    <p style="margin-top: 20px;">
        <a href="." class="btn">🏠 Főoldal</a>
        <a href="kapcsolat" class="btn btn-secondary" style="margin-left: 10px;">✉️ Új üzenet</a>
    </p>

<?php else: ?>
    <div class="alert alert-error">❌ Érvénytelen kérés.</div>
    <p><a href="kapcsolat" class="btn btn-secondary">← Vissza az űrlaphoz</a></p>
<?php endif; ?>
