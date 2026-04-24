<?php
// Ellenőrizzük, hogy az index.php-ban létrehozott kapcsolat elérhető-e
if (!isset($dbh)) {
    echo "<div style='color:red; padding:20px; background:#222;'>
            Hiba: Az adatbázis kapcsolat ($dbh) nem található. 
            Ellenőrizd az index.php fájlt!
          </div>";
    return; // Megállítjuk a fájl további futását
}

// 1. Műveletek kezelése (Csak bejelentkezve)
if (isset($_SESSION['login'])) {
    
   // TÖRLÉS
  // TÖRLÉS - crud.php
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        // ELŐSZÖR töröljük az előadásokat, amik erre a filmre hivatkoznak
        $sql1 = "DELETE FROM eloadas WHERE filmid = :id";
        $stmt1 = $dbh->prepare($sql1);
        $stmt1->execute(['id' => $id]);

        // UTÁNA törölhetjük magát a filmet
        $sql2 = "DELETE FROM film WHERE id = :id";
        $stmt2 = $dbh->prepare($sql2);
        $stmt2->execute(['id' => $id]);
        
        echo '<script>window.location.href="index.php?page=crud";</script>';
        exit();
    } catch (PDOException $e) {
        die("Hiba a törlésnél: " . $e->getMessage());
    }
}

    // HOZZÁADÁS
    if (isset($_POST['add_movie'])) {
    try {
        // Itt átírtam 'kiadasi_ev'-ről sima 'ev'-re. 
        // Ha nálad más (pl. 'year'), írd át arra!
        $sql = "INSERT INTO film (cim, ev, rendezo, mufaj) VALUES (?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            $_POST['cim'], 
            (int)$_POST['ev'], // A formból jövő adat
            $_POST['rendezo'], 
            $_POST['mufaj']
        ]);
        echo '<script>window.location.href="index.php?page=crud";</script>';
        exit();
    } catch (PDOException $e) {
        die("Hiba a mentésnél: " . $e->getMessage());
    }
}
}

// 2. Adatok lekérése a táblázathoz
$query = $dbh->query("SELECT * FROM film"); 
$movies = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container" style="padding: 20px;">
    <h2 style="color: white; border-bottom: 2px solid #e50914; padding-bottom: 10px;">Movie Management (CRUD)</h2>

    <?php if (isset($_SESSION['login'])): ?>
        <div style="background: #333; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px solid #444;">
            <h3 style="margin-top:0;">Add New Movie</h3>
            <form action="index.php?page=crud" method="post" style="display: flex; gap: 10px; flex-wrap: wrap;">
                <input type="text" name="cim" placeholder="Title" required style="padding: 8px; flex: 1;">
                <input type="number" name="ev" placeholder="Year" required style="padding: 8px; width: 100px;">
                <input type="text" name="rendezo" placeholder="Director" required style="padding: 8px; flex: 1;">
                <input type="text" name="mufaj" placeholder="Genre" required style="padding: 8px; flex: 1;">
                <button type="submit" name="add_movie" style="background: #e50914; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold;">
                    Save Movie
                </button>
            </form>
        </div>
    <?php endif; ?>

    <table style="width: 100%; border-collapse: collapse; background: #222; color: white; margin-top: 20px;">
        <thead>
            <tr style="background: #444; text-align: left;">
                <th style="padding: 12px; border: 1px solid #555;">ID</th>
                <th style="padding: 12px; border: 1px solid #555;">Title</th>
                <th style="padding: 12px; border: 1px solid #555;">Year</th>
                <th style="padding: 12px; border: 1px solid #555;">Director</th>
                <th style="padding: 12px; border: 1px solid #555;">Genre</th>
                <?php if (isset($_SESSION['login'])): ?>
                    <th style="padding: 12px; border: 1px solid #555; text-align: center;">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if ($movies): ?>
                <?php foreach ($movies as $movie): ?>
                    <tr style="border-bottom: 1px solid #333;">
                        <td style="padding: 10px;"><?= $movie['id'] ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($movie['cim']) ?></td>
                        <td style="padding: 10px;"><?= $movie['ev'] ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($movie['rendezo']) ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($movie['mufaj']) ?></td>
                        <?php if (isset($_SESSION['login'])): ?>
                            <td style="padding: 10px; text-align: center;">
                                <a href="index.php?page=crud&delete=<?= $movie['id'] ?>" 
                                   onclick="return confirm('Biztosan törlöd?')" 
                                   style="color: #ff4d4d; text-decoration: none; font-weight: bold; border: 1px solid #ff4d4d; padding: 2px 8px; border-radius: 4px;">
                                   Delete
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" style="padding: 20px; text-align: center;">Nincsenek adatok a táblában.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>