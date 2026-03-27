<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['message'];

    if (!empty($name) && !empty($email) && !empty($msg)) {
        $sql = "INSERT INTO uzenetek (nev, email, szoveg) VALUES (?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$name, $email, $msg]);
        echo "<div class='container'><h3>Message sent successfully!</h3></div>";
    } else {
        echo "<div class='container'><h3>Error: Fields cannot be empty!</h3></div>";
    }
}
?>