<?php
// =====================================================
// CRUD – Film kezelés (Create, Read, Update, Delete)
// =====================================================

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id     = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$msg    = "";
$msg_type = "success";

// ── CREATE (POST) ──────────────────────────────────
if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $cim     = trim($_POST['cim'] ?? '');
    $ev      = trim($_POST['ev'] ?? '');
    $rendezo = trim($_POST['rendezo'] ?? '');
    $mufaj   = trim($_POST['mufaj'] ?? '');

    if (!empty($cim) && !empty($ev) && !empty($rendezo) && !empty($mufaj)) {
        try {
            $stmt = $dbh->prepare("INSERT INTO film (cim, ev, rendezo, mufaj) VALUES (?, ?, ?, ?)");
            $stmt->execute([$cim, $ev, $rendezo, $mufaj]);
            header("Location: index.php?page=crud&msg=created");
            exit();
        } catch (PDOException $e) {
            $msg = "Hiba a mentés során!";
            $msg_type = "error";
        }
    } else {
        $msg = "Minden mező kitöltése kötelező!";
        $msg_type = "error";
    }
}

// ── UPDATE (POST) ──────────────────────────────────
if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST' && $id > 0) {
    $cim     = trim($_POST['cim'] ?? '');
    $ev      = trim($_POST['ev'] ?? '');
    $rendezo = trim($_POST['rendezo'] ?? '');
    $mufaj   = trim($_POST['mufaj'] ?? '');

    if (!empty($cim) && !empty($ev) && !empty($rendezo) && !empty($mufaj)) {
        try {
            $stmt = $dbh->prepare("UPDATE film SET cim=?, ev=?, rendezo=?, mufaj=? WHERE id=?");
            $stmt->execute([$cim, $ev, $rendezo, $mufaj, $id]);
            header("Location: index.php?page=crud&msg=updated");
            exit();
        } catch (PDOException $e) {
            $msg = "Hiba a módosítás során!";
            $msg_type = "error";
        }
    } else {
        $msg = "Minden mező kitöltése kötelező!";
        $msg_type = "error";
    }
}

// ── DELETE ─────────────────────────────────────────
if ($action === 'delete' && $id > 0) {
    try {
        $stmt = $dbh->prepare("DELETE FROM film WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: index.php?page=crud&msg=deleted");
        exit();
    } catch (PDOException $e) {
        $msg = "Hiba a törlés során!";
        $msg_type = "error";
    }
}

// ── Visszajelzés az átirányítás után ──────────────
if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'created') { $msg = "✅ Film sikeresen hozzáadva!"; }
    if ($_GET['msg'] === 'updated') { $msg = "✅ Film sikeresen módosítva!"; }
    if ($_GET['msg'] === 'deleted') { $msg = "✅ Film sikeresen törölve!"; }
}

// ── Szerkesztendő rekord betöltése ─────────────────
$edit_film = null;
if ($action === 'edit' && $id > 0 && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $stmt      = $dbh->prepare("SELECT * FROM film WHERE id = ?");
    $stmt->execute([$id]);
    $edit_film = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$edit_film) {
        header("Location: index.php?page=crud");
        exit();
    }
}

// ── Filmek listája ─────────────────────────────────
$stmt   = $dbh->query("SELECT * FROM film ORDER BY id DESC");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h2>🎬 Film kezelés (CRUD)</h2>

    <?php if ($msg): ?>
        <div class="alert alert-<?= $msg_type ?>"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <!-- ===== CREATE / EDIT FORM ===== -->
    <?php if ($action === 'create' || $action === 'edit'): ?>
        <div style="background: #2a2a2a; padding: 25px; border-radius: 10px; max-width: 500px; margin-bottom: 30px; border: 1px solid #333;">
            <h3 style="margin-top: 0; color: #e50914;">
                <?= $action === 'edit' ? '✏️ Film szerkesztése' : '➕ Új film hozzáadása' ?>
            </h3>

            <form method="post" action="index.php?page=crud&action=<?= $action ?><?= $action === 'edit' ? '&id=' . $id : '' ?>">
                <label>Film címe: <span style="color:#e50914">*</span></label>
                <input type="text" name="cim" required
                    value="<?= $edit_film ? htmlspecialchars($edit_film['cim']) : '' ?>">

                <label>Megjelenés éve: <span style="color:#e50914">*</span></label>
                <input type="number" name="ev" min="1888" max="2099" required
                    value="<?= $edit_film ? htmlspecialchars($edit_film['ev']) : '' ?>">

                <label>Rendező: <span style="color:#e50914">*</span></label>
                <input type="text" name="rendezo" required
                    value="<?= $edit_film ? htmlspecialchars($edit_film['rendezo']) : '' ?>">

                <label>Műfaj: <span style="color:#e50914">*</span></label>
                <input type="text" name="mufaj" required
                    value="<?= $edit_film ? htmlspecialchars($edit_film['mufaj']) : '' ?>">

                <div style="display: flex; gap: 10px; margin-top: 15px;">
                    <button type="submit">
                        <?= $action === 'edit' ? '💾 Mentés' : '➕ Hozzáadás' ?>
                    </button>
                    <a href="index.php?page=crud" class="btn btn-secondary">✖ Mégse</a>
                </div>
            </form>
        </div>

    <?php else: ?>
        <!-- Új film gomb -->
        <div style="margin-bottom: 20px;">
            <a href="index.php?page=crud&action=create" class="btn">➕ Új film hozzáadása</a>
        </div>
    <?php endif; ?>

    <!-- ===== FILMEK LISTÁJA (READ) ===== -->
    <h3 style="color: #e50914;">📋 Filmek listája (<?= count($movies) ?> db)</h3>

    <?php if (empty($movies)): ?>
        <div class="alert alert-info">Még nincs film az adatbázisban.</div>
    <?php else: ?>
        <div style="overflow-x: auto;">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Cím</th>
                    <th>Év</th>
                    <th>Rendező</th>
                    <th>Műfaj</th>
                    <th>Műveletek</th>
                </tr>
                <?php foreach ($movies as $f): ?>
                <tr>
                    <td style="color: #666;"><?= (int)$f['id'] ?></td>
                    <td><strong><?= htmlspecialchars($f['cim']) ?></strong></td>
                    <td><?= htmlspecialchars($f['ev']) ?></td>
                    <td><?= htmlspecialchars($f['rendezo']) ?></td>
                    <td>
                        <span style="background: #333; padding: 3px 8px; border-radius: 12px; font-size: 12px;">
                            <?= htmlspecialchars($f['mufaj']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <!-- UPDATE -->
                            <a href="index.php?page=crud&action=edit&id=<?= (int)$f['id'] ?>"
                               class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px;">✏️ Szerk.</a>
                            <!-- DELETE -->
                            <a href="index.php?page=crud&action=delete&id=<?= (int)$f['id'] ?>"
                               class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;"
                               onclick="return confirm('Biztosan törli ezt a filmet: <?= htmlspecialchars(addslashes($f['cim'])) ?>?')">
                               🗑️ Törlés
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
</div>
