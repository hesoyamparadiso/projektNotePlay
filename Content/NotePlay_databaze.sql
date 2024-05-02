-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Počítač: sql5.webzdarma.cz:3306
-- Vytvořeno: Čtv 31. bře 2022, 21:40
-- Verze serveru: 8.0.26-17
-- Verze PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `noteplayxfcz4450`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `autori`
--

CREATE TABLE `autori` (
  `id_i` int NOT NULL,
  `jmeno` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `prijmeni` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `ArtistName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `foto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `autori`
--

INSERT INTO `autori` (`id_i`, `jmeno`, `prijmeni`, `ArtistName`, `foto`) VALUES
(4, 'Adam', 'Chlpík', 'Rest', 'Rest.png'),
(5, 'Wolfgang Amadeus', 'Mozart', 'Mozart', 'Mozart.png'),
(7, 'Karel', 'Gott', 'Karel Gott', 'Gott.png');

-- --------------------------------------------------------

--
-- Struktura tabulky `komentare`
--

CREATE TABLE `komentare` (
  `id_k` int NOT NULL,
  `id_u` int NOT NULL,
  `id_s` int NOT NULL,
  `komentar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `komentare`
--

INSERT INTO `komentare` (`id_k`, `id_u`, `id_s`, `komentar`) VALUES
(74, 28, 7, '10/10'),
(75, 28, 7, 'Moje nejoblíbenější skladba!');

-- --------------------------------------------------------

--
-- Struktura tabulky `oblibene_skladby`
--

CREATE TABLE `oblibene_skladby` (
  `id_obl` int NOT NULL,
  `id_u` int NOT NULL,
  `id_s` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `oblibene_skladby`
--

INSERT INTO `oblibene_skladby` (`id_obl`, `id_u`, `id_s`) VALUES
(1, 24, 4),
(2, 24, 7),
(288, 28, 8),
(2411, 24, 11),
(2810, 28, 10),
(2811, 28, 11),
(2814, 28, 14),
(4611, 46, 11);

-- --------------------------------------------------------

--
-- Struktura tabulky `skladby`
--

CREATE TABLE `skladby` (
  `id_s` int NOT NULL,
  `nazev` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `obrazek` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL DEFAULT 'default_image.png',
  `zdroj` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `id_z` int NOT NULL,
  `id_i` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `skladby`
--

INSERT INTO `skladby` (`id_s`, `nazev`, `obrazek`, `zdroj`, `id_z`, `id_i`) VALUES
(4, 'Rest HROT420', 'Rest-HROT420.png', 'Rest-HROT420.mp3', 1, 4),
(7, 'Být stále mlád', 'gott_staleMlad.png', 'Karel-Gott-Být-stále-mlád(-Forever-Young)-(2000).mp3\r\n', 3, 7),
(8, 'Lady Carneval', 'Gott_carneval.png', 'Karel-Gott-Lady-Carneval.mp3', 3, 7),
(9, 'Trezor', 'Gott_trezor.png', 'KAREL-GOTT-TREZOR.mp3', 3, 7),
(10, 'Requiem', 'Mozart_requiem.png', 'Mozart-Requiem.mp3', 2, 5),
(11, 'Turkish March', 'Mozart_TurkisMarch.png', 'Turkish-March-Mozart-Rondo-Alla-Turca.mp3', 2, 5),
(12, 'Malá noční hudba', 'mozart_malaNocHud.png', 'W.A.MOZART-Malá-noční-hudba.mp3', 2, 5),
(14, 'Díky', 'Rest-diky.png', 'Rest-Díky.mp3', 1, 4),
(15, 'Terapie', 'Rest-terapie.png', 'Rest-Terapie-feat.-Idea.mp3', 1, 4),
(16, 'Mike Tyson', 'Rest-Tyson.png', 'Rest&DJWich-Mike-Tyson.mp3', 1, 4);

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `id_u` int NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `surname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `usrname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `mail` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `typ_uctu` int NOT NULL DEFAULT '1',
  `id_um` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`id_u`, `name`, `surname`, `usrname`, `mail`, `password`, `typ_uctu`, `id_um`) VALUES
(24, 'Pavel', 'Molnar', 'Pavel', 'pavel.molnar@seznam.cz', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, NULL),
(28, 'Luky', 'Pavelek', 'Luky420', 'luky.luk@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 3, NULL),
(29, 'Adam', 'Katan', 'Adam', 'a.katan.st@spseiostrava.cz', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 2, 5),
(46, 'Cinanek', 'Alan', 'parecky', 'chlebamaslo11@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 2, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `zanry`
--

CREATE TABLE `zanry` (
  `id_z` int NOT NULL,
  `nazev` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `barva` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `zanry`
--

INSERT INTO `zanry` (`id_z`, `nazev`, `barva`) VALUES
(1, 'Rap', '#FFFF00'),
(2, 'Klasická hudba', '#FF0000'),
(3, 'Zpěv', '#0000FF');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `autori`
--
ALTER TABLE `autori`
  ADD PRIMARY KEY (`id_i`);

--
-- Klíče pro tabulku `komentare`
--
ALTER TABLE `komentare`
  ADD PRIMARY KEY (`id_k`),
  ADD KEY `id_u` (`id_u`) USING BTREE,
  ADD KEY `id_s` (`id_s`) USING BTREE;

--
-- Klíče pro tabulku `oblibene_skladby`
--
ALTER TABLE `oblibene_skladby`
  ADD PRIMARY KEY (`id_obl`),
  ADD KEY `id_u` (`id_u`),
  ADD KEY `id_s` (`id_s`);

--
-- Klíče pro tabulku `skladby`
--
ALTER TABLE `skladby`
  ADD PRIMARY KEY (`id_s`),
  ADD KEY `id_z` (`id_z`),
  ADD KEY `id_i` (`id_i`);

--
-- Klíče pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`id_u`),
  ADD KEY `id_um` (`id_um`);

--
-- Klíče pro tabulku `zanry`
--
ALTER TABLE `zanry`
  ADD PRIMARY KEY (`id_z`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `autori`
--
ALTER TABLE `autori`
  MODIFY `id_i` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pro tabulku `komentare`
--
ALTER TABLE `komentare`
  MODIFY `id_k` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pro tabulku `skladby`
--
ALTER TABLE `skladby`
  MODIFY `id_s` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `id_u` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pro tabulku `zanry`
--
ALTER TABLE `zanry`
  MODIFY `id_z` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `oblibene_skladby`
--
ALTER TABLE `oblibene_skladby`
  ADD CONSTRAINT `oblibene_skladby_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `uzivatele` (`id_u`);

--
-- Omezení pro tabulku `skladby`
--
ALTER TABLE `skladby`
  ADD CONSTRAINT `skladby_ibfk_1` FOREIGN KEY (`id_z`) REFERENCES `zanry` (`id_z`) ON UPDATE CASCADE,
  ADD CONSTRAINT `skladby_ibfk_2` FOREIGN KEY (`id_i`) REFERENCES `autori` (`id_i`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
