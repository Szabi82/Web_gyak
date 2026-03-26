<?php include('header.php'); ?>

<div class="content-block">
    <h1>Project Gallery</h1>
    <p>Visual progress of the High-End Streamer build.</p>

    <?php if(isset($_SESSION['user_id'])): ?>
        <div style="background: #252525; padding: 20px; border-radius: 8px; margin-bottom: 30px; border: 1px dashed #00adb5;">
            <h3>Upload New Photo</h3>
            <form action="upload_process.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="image_to_upload" required style="margin-bottom: 10px;">
                <br>
                <button type="submit" class="btn">Start Upload</button>
            </form>
        </div>
    <?php endif; ?>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">
        <?php
        $target_folder = "uploads/";
        // Get all image files from the folder
        $image_list = glob($target_folder . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

        if($image_list) {
            foreach($image_list as $file_path) {
                echo '<div style="border: 1px solid #333; border-radius: 5px; overflow: hidden; background: #000;">';
                echo '<img src="'.$file_path.'" style="width: 100%; height: 150px; object-fit: cover;" alt="Hardware Photo">';
                echo '</div>';
            }
        } else {
            echo "<p>No photos uploaded yet.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>