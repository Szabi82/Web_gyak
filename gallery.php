<?php
$upload_dir = "images/";
$message = "";

// 1. Feltöltés kezelése
if (isset($_POST['upload']) && isset($_SESSION['login'])) {
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $target_file = $upload_dir . basename($_FILES["fileToUpload"]["name"]);
    $ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed = array("jpg", "jpeg", "png", "gif");

    if (in_array($ext, $allowed)) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $message = "Sikeres feltöltés!";
        } else {
            $message = "Hiba: Nem sikerült a fájl mozgatása.";
        }
    } else {
        $message = "Hiba: Csak JPG, PNG és GIF fájlok engedélyezettek.";
    }
}
?>

<div class="container">
    <h2>Gallery</h2>
    
    <?php if ($message): ?>
        <p style="color: yellow; background: #444; padding: 10px; border-radius: 5px;">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <?php if (isset($_SESSION['login'])): ?>
        <div style="background: #333; padding: 20px; border-radius: 10px; margin-bottom: 30px;">
            <h3>Upload new image</h3>
            <form action="index.php?page=gallery" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" required style="margin-bottom: 10px; display: block;">
                <button type="submit" name="upload" style="background: #e50914; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                    Upload Image
                </button>
            </form>
        </div>
    <?php endif; ?>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
        <?php
        $files = glob($upload_dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
        if ($files):
            foreach($files as $file) {
    echo '<div style="background: #222; padding: 10px; border-radius: 8px; text-align: center; border: 1px solid #333;">';
    // Az útvonal elé teszünk egy ./ jelet, hogy az aktuális mappából induljon
    echo '<img src="./' . htmlspecialchars($file) . '" style="width: 100%; height: 180px; object-fit: cover; border-radius: 5px;">';
    echo '<p style="font-size: 12px; color: #aaa; margin-top: 10px;">' . basename($file) . '</p>';
    echo '</div>';
}
        else: ?>
            <p>No images yet.</p>
        <?php endif; ?>
    </div>
</div>