<h2>🖼️ Képgaléria</h2>

<?php if (isset($message)): ?>
    <div class="alert alert-<?= $msg_type ?>"><?= $message ?></div>
<?php endif; ?>

<!-- Feltöltés – csak bejelentkezett felhasználónak -->
<?php if (isset($_SESSION['login'])): ?>
    <div style="background: #2a2a2a; padding: 20px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #333;">
        <h3 style="margin-top: 0;">📤 Új kép feltöltése</h3>
        <form action="kepek" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" accept=".jpg,.jpeg,.png,.gif" required
                style="margin-bottom: 12px; display: block; color: #ddd;">
            <p style="font-size: 12px; color: #777; margin: 0 0 10px;">
                Engedélyezett: JPG, PNG, GIF | Max. méret: 5MB
            </p>
            <button type="submit" name="upload">⬆️ Feltöltés</button>
        </form>
    </div>
<?php else: ?>
    <div class="alert alert-info" style="margin-bottom: 20px;">
        ℹ️ Képek feltöltéséhez <a href="belepes">jelentkezz be</a>!
    </div>
<?php endif; ?>

<!-- Képek megjelenítése -->
<div class="gallery-grid">
    <?php
    $upload_dir = "./images/gallery/";
    $files = glob($upload_dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
    if ($files && count($files) > 0):
        usort($files, function($a, $b) { return filemtime($b) - filemtime($a); });
        foreach ($files as $file): ?>
            <div class="gallery-item">
                <img src="<?= htmlspecialchars($file) ?>"
                     alt="<?= htmlspecialchars(basename($file)) ?>"
                     loading="lazy">
                <p><?= htmlspecialchars(basename($file)) ?></p>
            </div>
        <?php endforeach;
    else: ?>
        <p style="color: #666; grid-column: 1/-1; text-align: center; padding: 40px 0;">
            Még nincs feltöltött kép.
        </p>
    <?php endif; ?>
</div>
