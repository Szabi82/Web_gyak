<?php if(isset($uzenet)): ?>
    <div class="alert <?= $ujra ? 'alert-error' : 'alert-success' ?>">
        <h2 style="margin:0 0 10px;"><?= htmlspecialchars($uzenet) ?></h2>
        <?php if($ujra): ?>
            <a href="belepes">Próbálja újra!</a>
        <?php else: ?>
            <a href="belepes">Bejelentkezés</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
