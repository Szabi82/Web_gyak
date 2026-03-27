<?php
session_start();

// Security check: Only logged-in users can access this script
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image_to_upload'])) {
    $upload_dir = "uploads/";
    
    // File metadata
    $file_extension = strtolower(pathinfo($_FILES["image_to_upload"]["name"], PATHINFO_EXTENSION));
    $unique_name = uniqid("IMG_") . "." . $file_extension;
    $destination = $upload_dir . $unique_name;
    
    $is_valid = true;

    // Validate if it's a real image
    $check_image = getimagesize($_FILES["image_to_upload"]["tmp_name"]);
    if($check_image === false) {
        die("Error: File is not an image.");
    }

    // Limit size (5MB max)
    if ($_FILES["image_to_upload"]["size"] > 5000000) {
        die("Error: File is too large.");
    }

    // Allowed formats
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if(!in_array($file_extension, $allowed_types)) {
        die("Error: Only JPG, JPEG, PNG & GIF allowed.");
    }

    // Execute upload
    if (move_uploaded_file($_FILES["image_to_upload"]["tmp_name"], $destination)) {
        // Sikeres feltöltés után visszairányítunk a galériába
        header("Location: picture.php?success=upload");
        exit();
    } else {
        die("Hiba történt a fájl mozgatása közben. Ellenőrizd az uploads mappa jogosultságait!");
    }
}






}
?>