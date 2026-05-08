<?php if(isset($row)): ?>
    <?php if($row): ?>
        <div class="alert alert-success">
            <h2 style="margin:0 0 10px;">✅ Sikeres bejelentkezés!</h2>
            Név: <strong><?= htmlspecialchars($row['csaladi_nev']." ".$row['uto_nev']) ?></strong>
        </div>
    <?php else: ?>
        <div class="alert alert-error">
            <h2 style="margin:0 0 10px;">❌ A bejelentkezés nem sikerült!</h2>
            <a href="belepes">Próbálja újra!</a>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php if(isset($errormessage)): ?>
    <div class="alert alert-error"><?= htmlspecialchars($errormessage) ?></div>
<?php endif; ?>
