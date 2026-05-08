<?php session_start(); ?>
<?php if(file_exists('./logicals/'.$keres['fajl'].'.php')) { include("./logicals/{$keres['fajl']}.php"); } ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $ablakcim['cim'] ?><?= (!empty($fejlec['motto'])) ? (' | ' . $fejlec['motto']) : '' ?></title>
    <link rel="stylesheet" href="./styles/stilus.css" type="text/css">
    <?php if(file_exists('./styles/'.$keres['fajl'].'.css')) { ?>
        <link rel="stylesheet" href="./styles/<?= $keres['fajl'] ?>.css" type="text/css">
    <?php } ?>
</head>
<body>

<header>
    <div class="header-top">
        <div class="logo">
            <img src="./images/<?= $fejlec['kepforras'] ?>" alt="<?= $fejlec['kepalt'] ?>">
            🎬 <?= $fejlec['cim'] ?>
        </div>
        <?php if(isset($_SESSION['login'])) { ?>
            <div class="user-info">
                Bejelentkezett: <strong><?= htmlspecialchars($_SESSION['csn']." ".$_SESSION['un']." (".$_SESSION['login'].")") ?></strong>
            </div>
        <?php } ?>
        <button class="hamburger" id="hamburgerBtn">&#9776;</button>
    </div>
    <nav>
        <ul id="navMenu">
            <?php foreach ($oldalak as $url => $oldal) { ?>
                <?php if(!isset($_SESSION['login']) && $oldal['menun'][0] || isset($_SESSION['login']) && $oldal['menun'][1]) { ?>
                    <?php if($oldal['szoveg'] != '') { ?>
                        <li<?= (($oldal == $keres) ? ' class="active"' : '') ?>>
                            <a href="<?= ($url == '/') ? '.' : $url ?>">
                                <?= $oldal['szoveg'] ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </ul>
    </nav>
</header>

<main>
    <div class="container">
        <?php include("./templates/pages/{$keres['fajl']}.tpl.php"); ?>
    </div>
</main>

<footer>
    <?php if(isset($lablec['copyright'])) { ?>&copy;&nbsp;<?= $lablec['copyright'] ?><?php } ?>
    &nbsp;
    <?php if(isset($lablec['ceg'])) { ?><?= $lablec['ceg'] ?><?php } ?>
</footer>

<script>
document.getElementById('hamburgerBtn').addEventListener('click', function() {
    document.getElementById('navMenu').classList.toggle('open');
});
</script>

</body>
</html>
