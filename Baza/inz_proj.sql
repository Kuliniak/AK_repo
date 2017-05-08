-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Maj 2017, 17:43
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `inz_proj`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dostepy`
--

CREATE TABLE `dostepy` (
  `id_dostepu` int(11) NOT NULL,
  `id_osoby` int(11) NOT NULL,
  `id_projektu` int(11) NOT NULL,
  `rola` text COLLATE utf8_polish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `dostepy`
--

INSERT INTO `dostepy` (`id_dostepu`, `id_osoby`, `id_projektu`, `rola`, `admin`) VALUES
(2, 1, 6, 'Grafik', 0),
(3, 1, 7, 'Sprzedawca', 0),
(5, 1, 8, 'programista php', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoby`
--

CREATE TABLE `osoby` (
  `id_osoby` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `osoby`
--

INSERT INTO `osoby` (`id_osoby`, `login`, `haslo`) VALUES
(1, 'damian', 'qwerty'),
(30, 'liksen', 'asdfghjk'),
(31, 'ziomek', '1234567890');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projekty`
--

CREATE TABLE `projekty` (
  `id_projektu` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `start_proj` date NOT NULL,
  `koniec_proj` date NOT NULL,
  `komentarze` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `projekty`
--

INSERT INTO `projekty` (`id_projektu`, `nazwa`, `start_proj`, `koniec_proj`, `komentarze`) VALUES
(1, 'przykładowy', '2017-05-05', '2017-05-10', 'dla super ważnej firmy'),
(3, 'jakis tam', '2017-05-05', '2017-05-19', 'dobry koment'),
(5, 'tajny projekt', '2017-05-20', '2017-05-26', 'Dobr komentarz'),
(6, 'nazwa ktorej na pewno nie ma', '2017-05-10', '2017-05-20', 'asfasfasd'),
(7, 'Kolejny dobry projekt', '2017-05-18', '2017-05-27', 'asdfasdfasdf'),
(8, 'projekt inzynierski', '2017-05-10', '2017-05-19', 'asdf');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadania`
--

CREATE TABLE `zadania` (
  `id_zadania` int(11) NOT NULL,
  `id_projektu` int(11) NOT NULL,
  `ktore_zadanie` int(11) NOT NULL,
  `tresc_zadania` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `poczatek_zad` date NOT NULL,
  `koniec_zad` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `zadania`
--

INSERT INTO `zadania` (`id_zadania`, `id_projektu`, `ktore_zadanie`, `tresc_zadania`, `poczatek_zad`, `koniec_zad`) VALUES
(1, 8, 0, 'zebrac ekipe', '2017-05-11', '2017-05-16'),
(2, 8, 1, 'zrobic to', '2017-05-27', '2017-05-30');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `dostepy`
--
ALTER TABLE `dostepy`
  ADD PRIMARY KEY (`id_dostepu`),
  ADD KEY `id_osoby` (`id_osoby`),
  ADD KEY `id_projektu` (`id_projektu`);

--
-- Indexes for table `osoby`
--
ALTER TABLE `osoby`
  ADD PRIMARY KEY (`id_osoby`);

--
-- Indexes for table `projekty`
--
ALTER TABLE `projekty`
  ADD PRIMARY KEY (`id_projektu`);

--
-- Indexes for table `zadania`
--
ALTER TABLE `zadania`
  ADD PRIMARY KEY (`id_zadania`),
  ADD KEY `id_projektu` (`id_projektu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `dostepy`
--
ALTER TABLE `dostepy`
  MODIFY `id_dostepu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `osoby`
--
ALTER TABLE `osoby`
  MODIFY `id_osoby` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT dla tabeli `projekty`
--
ALTER TABLE `projekty`
  MODIFY `id_projektu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT dla tabeli `zadania`
--
ALTER TABLE `zadania`
  MODIFY `id_zadania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `dostepy`
--
ALTER TABLE `dostepy`
  ADD CONSTRAINT `dostepy_ibfk_1` FOREIGN KEY (`id_osoby`) REFERENCES `osoby` (`id_osoby`),
  ADD CONSTRAINT `dostepy_ibfk_2` FOREIGN KEY (`id_projektu`) REFERENCES `projekty` (`id_projektu`);

--
-- Ograniczenia dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD CONSTRAINT `zadania_ibfk_1` FOREIGN KEY (`id_projektu`) REFERENCES `projekty` (`id_projektu`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
