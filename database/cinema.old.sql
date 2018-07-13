-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Lug 12, 2018 alle 08:48
-- Versione del server: 10.1.34-MariaDB
-- Versione PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Attori`
--

CREATE TABLE `Attori` (
  `Nome` varchar(123) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Cognome` varchar(123) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Film`
--

CREATE TABLE `Film` (
  `Id` int(11) NOT NULL,
  `Titolo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Regista` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CasaProduzione` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Durata` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Prenotazioni`
--

CREATE TABLE `Prenotazioni` (
  `Utente` int(11) NOT NULL,
  `ProgrammazioneScelta` int(11) NOT NULL,
  `NumeroPostiPrenotati` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Programmazione`
--

CREATE TABLE `Programmazione` (
  `Id` int(11) NOT NULL,
  `Giorno` date NOT NULL,
  `Ora` time NOT NULL,
  `Sala` varchar(123) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Film` int(11) NOT NULL,
  `Prezzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Sale`
--

CREATE TABLE `Sale` (
  `Nome` varchar(123) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NumeroPosti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--

CREATE TABLE `Utenti` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Cognome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Salt` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Attori`
--
ALTER TABLE `Attori`
  ADD PRIMARY KEY (`Nome`,`Cognome`,`Film`),
  ADD KEY `Film` (`Film`);

--
-- Indici per le tabelle `Film`
--
ALTER TABLE `Film`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `Prenotazioni`
--
ALTER TABLE `Prenotazioni`
  ADD PRIMARY KEY (`Utente`,`ProgrammazioneScelta`),
  ADD KEY `Utente` (`Utente`),
  ADD KEY `ProgrammazioneScelta` (`ProgrammazioneScelta`);

--
-- Indici per le tabelle `Programmazione`
--
ALTER TABLE `Programmazione`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Sala` (`Sala`),
  ADD KEY `Film` (`Film`);

--
-- Indici per le tabelle `Sale`
--
ALTER TABLE `Sale`
  ADD PRIMARY KEY (`Nome`);

--
-- Indici per le tabelle `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Film`
--
ALTER TABLE `Film`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Programmazione`
--
ALTER TABLE `Programmazione`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Utenti`
--
ALTER TABLE `Utenti`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Attori`
--
ALTER TABLE `Attori`
  ADD CONSTRAINT `AttoriPrincipali` FOREIGN KEY (`Film`) REFERENCES `Film` (`Id`);

--
-- Limiti per la tabella `Prenotazioni`
--
ALTER TABLE `Prenotazioni`
  ADD CONSTRAINT `PrenotazioneProgrammazione` FOREIGN KEY (`ProgrammazioneScelta`) REFERENCES `Programmazione` (`Id`),
  ADD CONSTRAINT `PrenotazioneUtente` FOREIGN KEY (`Utente`) REFERENCES `Utenti` (`Id`);

--
-- Limiti per la tabella `Programmazione`
--
ALTER TABLE `Programmazione`
  ADD CONSTRAINT `FilmProgrammazione` FOREIGN KEY (`Film`) REFERENCES `Film` (`Id`),
  ADD CONSTRAINT `SalaProgrammazione` FOREIGN KEY (`Sala`) REFERENCES `Sale` (`Nome`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
