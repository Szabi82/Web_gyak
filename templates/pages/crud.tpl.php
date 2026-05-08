<?php if (!isset($_SESSION['login'])): ?>
    <div class="alert alert-error">
        ❌ A CRUD oldal csak bejelentkezett felhasználóknak érhető el!
        <br><a href="belepes">→ Bejelentkezés</a>
    </div>
<?php else: ?>

<h2>🎬 Film kezelés (CRUD)</h2>

<?php if ($crud_msg): ?>
    <div class="alert alert-<?= $crud_msg_type ?>"><?= htmlspecialchars($crud_msg) ?></div>
<?php endif; ?>

<!-- CREATE / EDIT FORM -->
<?php if ($crud_action === 'create' || $crud_action === 'edit'): ?>
    <div style="background: #2a2a2a; padding: 25px; border-radius: 10px; max-width: 500px; margin-bottom: 30px; border: 1px solid #333;">
        <h3 style="margin-top: 0;">
            <?= $crud_action === 'edit' ? '✏️ Film szerkesztése' : '➕ Új film hozzáadása' ?>
        </h3>
        <form method="post" action="index.php?crud">
            <input type="hidden" name="action" value="<?= $crud_action ?>">
            <?php if ($crud_action === 'edit'): ?>
                <input type="hidden" name="id" value="<?= $crud_id ?>">
            <?php endif; ?>

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
                <button type="submit"><?= $crud_action === 'edit' ? '💾 Mentés' : '➕ Hozzáadás' ?></button>
                <a href="crud" class="btn btn-secondary">✖ Mégse</a>
            </div>
        </form>
    </div>
<?php else: ?>
    <div style="margin-bottom: 20px;">
        <a href="index.php?crud&action=create">➕ Új film hozzáadása</a>
    </div>
<?php endif; ?>

<!-- FILMEK LISTÁJA -->
<h3>📋 Filmek listája (<?= count($movies) ?> db)</h3>

<?php if (empty($movies)): ?>
    <div class="alert alert-info">Még nincs film az adatbázisban.</div>
<?php else: ?>
    <div style="overflow-x: auto;">
        <table>
            <tr>
                <th>ID</th><th>Cím</th><th>Év</th><th>Rendező</th><th>Műfaj</th><th>Műveletek</th>
            </tr>
            <?php foreach ($movies as $f): ?>
            <tr>
                <td style="color:#666;"><?= (int)$f['id'] ?></td>
                <td><strong><?= htmlspecialchars($f['cim']) ?></strong></td>
                <td><?= htmlspecialchars($f['ev']) ?></td>
                <td><?= htmlspecialchars($f['rendezo']) ?></td>
                <td><span style="background:#333;padding:3px 8px;border-radius:12px;font-size:12px;"><?= htmlspecialchars($f['mufaj']) ?></span></td>
                <td>
                    <div class="action-btns">
                        <a href="index.php?crud&action=edit&id=<?= (int)$f['id'] ?>" class="btn btn-secondary" style="padding:6px 12px;font-size:12px;">✏️ Szerk.</a>
                        <a href="index.php?crud&action=delete&id=<?= (int)$f['id'] ?>" class="btn btn-danger" style="padding:6px 12px;font-size:12px;"
                           onclick="return confirm('Biztosan törli: <?= htmlspecialchars(addslashes($f['cim'])) ?>?')">🗑️ Törlés</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>
<?php endif; ?>
