<?php
$upload_dir = "./images/gallery/";
$message  = "";
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
