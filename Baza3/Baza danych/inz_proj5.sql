-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Maj 2017, 12:25
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
(2, 1, 6, 'GRAFIK', 1),
(3, 1, 7, 'SPRZEDAWCA', 0),
(5, 1, 8, 'PROGRAMISTA PHP', 0),
(10, 30, 6, 'GRAFIK', 0),
(12, 31, 6, 'PROGRAMISTA PHP', 0),
(13, 32, 6, 'PROGRAMISTA JAVA', 0),
(23, 30, 9, 'SZEF', 1),
(24, 1, 9, 'KURIER', 0),
(27, 1, 10, 'CIEŚLA', 1),
(30, 30, 10, 'MURARZ', 0),
(31, 1, 11, 'MURARZ', 1);

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
(31, 'ziomek', '1234567890'),
(32, 'koksu', 'tojesthaslo');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projekty`
--

CREATE TABLE `projekty` (
  `id_projektu` int(11) NOT NULL,
  `nazwa` longtext COLLATE utf8_polish_ci NOT NULL,
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
(8, 'projekt inzynierski', '2017-05-10', '2017-05-19', 'asdf'),
(9, 'Projekt X', '2017-05-29', '2017-05-31', ''),
(10, 'Projekt XYZ', '2017-05-29', '2017-05-31', ''),
(11, 'Projekt jakis tam XDDD', '2017-05-30', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE `role` (
  `id_roli` int(11) NOT NULL,
  `rola` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `role`
--

INSERT INTO `role` (`id_roli`, `rola`) VALUES
(1, 'GRAFIK'),
(4, 'KUCHARZ'),
(5, 'LEKARZ'),
(7, 'BIBLOTEKARZ'),
(8, 'KURIER'),
(13, 'GRAFIK'),
(14, 'PROGRAMISTA PHP'),
(15, 'PROGRAMISTA JAVA'),
(16, 'KURIER'),
(18, 'CIEŚLA'),
(19, 'MURARZ');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sprinty`
--

CREATE TABLE `sprinty` (
  `id_sprintu` int(11) NOT NULL,
  `id_projektu` int(11) NOT NULL,
  `sprint` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `poczatek` date NOT NULL,
  `koniec` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `sprinty`
--

INSERT INTO `sprinty` (`id_sprintu`, `id_projektu`, `sprint`, `poczatek`, `koniec`) VALUES
(4, 9, 'asd', '2017-05-30', '2017-05-31'),
(5, 9, 'xyz', '2017-06-01', '2017-06-29'),
(12, 10, 'asdf', '2017-05-03', '2017-05-09'),
(13, 10, 'zxcv', '2017-05-16', '2017-05-24'),
(14, 10, 'hgjkgh', '2017-05-30', '2017-05-31'),
(15, 11, 'asdf', '2017-05-30', '0000-00-00'),
(16, 11, 'xyz', '2017-05-31', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadania`
--

CREATE TABLE `zadania` (
  `id_zadania` int(11) NOT NULL,
  `id_sprintu` int(11) NOT NULL,
  `ktore_zadanie` int(11) NOT NULL,
  `tresc_zadania` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `poczatek_zad` date NOT NULL,
  `koniec_zad` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

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
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_roli`);

--
-- Indexes for table `sprinty`
--
ALTER TABLE `sprinty`
  ADD PRIMARY KEY (`id_sprintu`),
  ADD KEY `id_projektu` (`id_projektu`);

--
-- Indexes for table `zadania`
--
ALTER TABLE `zadania`
  ADD PRIMARY KEY (`id_zadania`),
  ADD KEY `id_sprintu` (`id_sprintu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `dostepy`
--
ALTER TABLE `dostepy`
  MODIFY `id_dostepu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT dla tabeli `osoby`
--
ALTER TABLE `osoby`
  MODIFY `id_osoby` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT dla tabeli `projekty`
--
ALTER TABLE `projekty`
  MODIFY `id_projektu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT dla tabeli `role`
--
ALTER TABLE `role`
  MODIFY `id_roli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT dla tabeli `sprinty`
--
ALTER TABLE `sprinty`
  MODIFY `id_sprintu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT dla tabeli `zadania`
--
ALTER TABLE `zadania`
  MODIFY `id_zadania` int(11) NOT NULL AUTO_INCREMENT;
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
-- Ograniczenia dla tabeli `sprinty`
--
ALTER TABLE `sprinty`
  ADD CONSTRAINT `sprinty_ibfk_1` FOREIGN KEY (`id_projektu`) REFERENCES `projekty` (`id_projektu`);

--
-- Ograniczenia dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD CONSTRAINT `zadania_ibfk_1` FOREIGN KEY (`id_sprintu`) REFERENCES `sprinty` (`id_sprintu`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
