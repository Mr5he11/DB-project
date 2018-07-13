--
-- Struttura della tabella `Attori`
--

CREATE TABLE `Attori` (
  `Nome` varchar(123) NOT NULL,
  `Cognome` varchar(123) NOT NULL,
  `Film` int(11) NOT NULL
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Film`
--

CREATE TABLE `Film` (
  `Id` int(11) NOT NULL,
  `Titolo` varchar(255) NOT NULL,
  `Regista` varchar(255) NOT NULL,
  `CasaProduzione` varchar(255) NOT NULL,
  `Durata` int(11) NOT NULL
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Prenotazioni`
--

CREATE TABLE `Prenotazioni` (
  `Utente` int(11) NOT NULL,
  `ProgrammazioneScelta` int(11) NOT NULL,
  `NumeroPostiPrenotati` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Struttura della tabella `Programmazione`
--

CREATE TABLE `Programmazione` (
  `Id` int(11) NOT NULL,
  `Giorno` date NOT NULL,
  `Ora` time NOT NULL,
  `Sala` varchar(123) NOT NULL,
  `Film` int(11) NOT NULL,
  `Prezzo` int(11) NOT NULL
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Sale`
--

CREATE TABLE `Sale` (
  `Nome` varchar(123) NOT NULL,
  `NumeroPosti` int(11) NOT NULL
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--

CREATE TABLE `Utenti` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Cognome` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Salt` varchar(5) NOT NULL
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Indici
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
  
-- --------------------------------------------------------

--
-- AUTO_INCREMENT
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

-- --------------------------------------------------------
  
--
-- Limiti
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

-- --------------------------------------------------------
