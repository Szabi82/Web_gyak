<?php
$upload_dir = "images/";
$message = "";
$msg_type = "info";

if (isset($_POST['upload'])) {
    if (!isset($_SESSION['login'])) {
        $message  = "Képet csak bejelentkezett felhasználó tölthet fel!";
        $msg_type = "error";
    } else {
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $allowed = ["jpg", "jpeg", "png", "gif"];
        $ext     = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            $message  = "Hiba: Csak JPG, PNG és GIF fájlok engedélyezettek!";
            $msg_type = "error";
        } elseif ($_FILES["fileToUpload"]["size"] > 5 * 1024 * 1024) {
            $message  = "Hiba: A fájl mérete nem lehet nagyobb 5MB-nál!";
            $msg_type = "error";
        } else {
            // Biztonságos fájlnév
            $safe_name   = time() . "_" . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($_FILES["fileToUpload"]["name"]));
            $target_file = $upload_dir . $safe_name;

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $message  = "✅ Sikeres feltöltés: " . htmlspecialchars($safe_name);
                $msg_type = "success";
            } else {
                $message  = "Hiba: Nem sikerült a fájl feltöltése.";
                $msg_type = "error";
            }
        }
    }
}
?>

<div class="container">
    <h2>🖼️ Képgaléria</h2>

    <?php if ($message): ?>
        <div class="alert alert-<?= $msg_type ?>"><?= $message ?></div>
    <?php endif; ?>

    <!-- Feltöltés – csak bejelentkezett felhasználónak -->
    <?php if (isset($_SESSION['login'])): ?>
        <div style="background: #2a2a2a; padding: 20px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #333;">
            <h3 style="margin-top: 0; color: #e50914;">📤 Új kép feltöltése</h3>
            <form action="index.php?page=gallery" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" accept=".jpg,.jpeg,.png,.gif" required
                    style="margin-bottom: 12px; display: block; color: #ddd;">
                <p style="font-size: 12px; color: #777; margin: 0 0 10px;">
                    Engedélyezett formátumok: JPG, PNG, GIF | Max. méret: 5MB
                </p>
                <button type="submit" name="upload">⬆️ Feltöltés</button>
            </form>
        </div>
    <?php else: ?>
        <div class="alert alert-info" style="margin-bottom: 20px;">
            ℹ️ Képek feltöltéséhez <a href="index.php?page=login" style="color: #e50914;">jelentkezz be</a>!
        </div>
    <?php endif; ?>

    <!-- Képek megjelenítése -->
    <div class="gallery-grid">
        <?php
        $files = glob($upload_dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
        if ($files && count($files) > 0):
            // Legújabb elöl
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
</div>
