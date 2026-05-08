<div class="alert alert-info">
    <h2 style="margin:0 0 10px;">👋 Sikeresen kilépett!</h2>
    <?php if(isset($data)): ?>
        <strong><?= htmlspecialchars($data['csn']." ".$data['un']." (".$data['login'].")") ?></strong>
    <?php endif; ?>
</div>
<p><a href=".">← Vissza a főoldalra</a></p>
