-- =====================================================
-- Cinema Project – Teljes adatbázis
-- Futtasd le phpMyAdmin-ban!
-- =====================================================

-- Felhasználók tábla (eredeti struktúra megtartva)
CREATE TABLE IF NOT EXISTS `felhasznalok` (
    `id`            int(10) unsigned NOT NULL AUTO_INCREMENT,
    `csaladi_nev`   varchar(45) NOT NULL DEFAULT '',
    `uto_nev`       varchar(45) NOT NULL DEFAULT '',
    `bejelentkezes` varchar(12) NOT NULL DEFAULT '',
    `jelszo`        varchar(40) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Film tábla (CRUD-hoz)
CREATE TABLE IF NOT EXISTS `film` (
    `id`      int(10) unsigned NOT NULL AUTO_INCREMENT,
    `cim`     varchar(100) NOT NULL,
    `ev`      int(4) NOT NULL,
    `rendezo` varchar(100) NOT NULL,
    `mufaj`   varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Üzenetek tábla (kapcsolat űrlaphoz)
CREATE TABLE IF NOT EXISTS `uzenetek` (
    `id`    int(10) unsigned NOT NULL AUTO_INCREMENT,
    `nev`   varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `szoveg` text NOT NULL,
    `kuldo` varchar(150) DEFAULT 'Vendég',
    `datum` datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Teszt filmek
INSERT INTO `film` (`cim`, `ev`, `rendezo`, `mufaj`) VALUES
('Pulp Fiction', 1994, 'Quentin Tarantino', 'Krimi'),
('The Dark Knight', 2008, 'Christopher Nolan', 'Akció'),
('Schindler listája', 1993, 'Steven Spielberg', 'Dráma');
