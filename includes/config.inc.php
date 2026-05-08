<?php
// Adatbázis kapcsolat
try {
    $dbh = new PDO(
        'mysql:host=sql303.infinityfree.com;dbname=if0_41428018_mozi_adatbazis;charset=utf8',
        'if0_41428018',
        'IITiAvhArV',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    $db_error = "Adatbázis kapcsolat sikertelen.";
}

$ablakcim = array(
    'cim' => 'Cinema Project',
);

$fejlec = array(
    'kepforras' => 'logo.png',
    'kepalt'    => 'Cinema Project logo',
    'cim'       => 'Cinema Project',
    'motto'     => 'A legjobb filmek egy helyen'
);

$lablec = array(
    'copyright' => 'Copyright ' . date("Y") . '.',
    'ceg'       => 'Cinema Project – Web-programozás 1. beadandó'
);

$oldalak = array(
    '/'              => array('fajl' => 'cimlap',        'szoveg' => 'Főoldal',        'menun' => array(1,1)),
    'kepek'          => array('fajl' => 'kepek',         'szoveg' => 'Képek',          'menun' => array(1,1)),
    'kapcsolat'      => array('fajl' => 'kapcsolat',     'szoveg' => 'Kapcsolat',      'menun' => array(1,1)),
    'crud'           => array('fajl' => 'crud',          'szoveg' => 'FILM Lista',           'menun' => array(1,1)),
    'uzenetek'       => array('fajl' => 'uzenetek',      'szoveg' => 'Üzenetek',       'menun' => array(0,1)),
    'belepes'        => array('fajl' => 'belepes',       'szoveg' => 'Bejelentkezés',  'menun' => array(1,0)),
    'kilepes'        => array('fajl' => 'kilepes',       'szoveg' => 'Kilépés',        'menun' => array(0,1)),
    'belep'          => array('fajl' => 'belep',         'szoveg' => '',               'menun' => array(0,0)),
    'regisztral'     => array('fajl' => 'regisztral',    'szoveg' => '',               'menun' => array(0,0)),
    'kapcsolat_ment' => array('fajl' => 'kapcsolat_ment','szoveg' => '',               'menun' => array(0,0)),
);

$hiba_oldal = array('fajl' => '404', 'szoveg' => 'A keresett oldal nem található!');
?>
