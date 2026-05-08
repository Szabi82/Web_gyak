<?php
$crud_action   = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : 'list');
$crud_id       = isset($_GET['id']) ? (int)$_GET['id'] : (isset($_POST['id']) ? (int)$_POST['id'] : 0);
$crud_msg      = "";
$crud_msg_type = "success";
$edit_film     = null;

// CREATE
if ($crud_action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $cim = trim($_POST['cim'] ?? ''); $ev = trim($_POST['ev'] ?? '');
    $rendezo = trim($_POST['rendezo'] ?? ''); $mufaj = trim($_POST['mufaj'] ?? '');
    if (!empty($cim) && !empty($ev) && !empty($rendezo) && !empty($mufaj)) {
        try {
            $dbh->prepare("INSERT INTO film (cim, ev, rendezo, mufaj) VALUES (?,?,?,?)")->execute([$cim,$ev,$rendezo,$mufaj]);
            header("Location: crud?msg=created"); exit();
        } catch (PDOException $e) { $crud_msg = "Hiba a mentés során!"; $crud_msg_type = "error"; }
    } else { $crud_msg = "Minden mező kitöltése kötelező!"; $crud_msg_type = "error"; }
}

// UPDATE
if ($crud_action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST' && $crud_id > 0) {
    $cim = trim($_POST['cim'] ?? ''); $ev = trim($_POST['ev'] ?? '');
    $rendezo = trim($_POST['rendezo'] ?? ''); $mufaj = trim($_POST['mufaj'] ?? '');
    if (!empty($cim) && !empty($ev) && !empty($rendezo) && !empty($mufaj)) {
        try {
            $dbh->prepare("UPDATE film SET cim=?,ev=?,rendezo=?,mufaj=? WHERE id=?")->execute([$cim,$ev,$rendezo,$mufaj,$crud_id]);
            header("Location: crud?msg=updated"); exit();
        } catch (PDOException $e) { $crud_msg = "Hiba a módosítás során!"; $crud_msg_type = "error"; }
    } else { $crud_msg = "Minden mező kitöltése kötelező!"; $crud_msg_type = "error"; }
}

// DELETE
if ($crud_action === 'delete' && $crud_id > 0) {
    try {
        $dbh->prepare("DELETE FROM film WHERE id=?")->execute([$crud_id]);
        header("Location: crud?msg=deleted"); exit();
    } catch (PDOException $e) { $crud_msg = "Hiba a törlés során!"; $crud_msg_type = "error"; }
}

// Visszajelzés
if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'created') { $crud_msg = "✅ Film sikeresen hozzáadva!"; }
    if ($_GET['msg'] === 'updated') { $crud_msg = "✅ Film sikeresen módosítva!"; }
    if ($_GET['msg'] === 'deleted') { $crud_msg = "✅ Film sikeresen törölve!"; }
}

// Edit betöltés
if ($crud_action === 'edit' && $crud_id > 0 && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $stmt = $dbh->prepare("SELECT * FROM film WHERE id=?");
    $stmt->execute([$crud_id]);
    $edit_film = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$edit_film) { header("Location: crud"); exit(); }
}

// Lista
$stmt  = $dbh->query("SELECT * FROM film ORDER BY id DESC");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
