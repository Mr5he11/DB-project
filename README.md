# DB-PROJECT
Small dynamical website project written in `PHP` and `SQL`.
The project specifictions are written above (in italian, I didn't have the will to translate them :P).
Don't worry about this project however, this is just a silly project for a university database project course.
## PRENOTAZIONE CINEMA MULTI-SALA (2-4)
### Tabelle `DB`
##### `film` 
`titolo`, `regista`, `casa_di_produzione`, `attori_principali`, `durata`
##### `sale` 
`nome`, `numero_di_posti`
##### `programmazione` 
`giorno`, `ora`, `sala`, `film`, `prezzo`
##### `utenti_registrati`
`nome`, `cognome`, `indirizzo_login`, `password`, `salt`
##### `prenotazioni`
`programmazione_scelta`, `utente`, `numero di posti prenotati`
### Funzionalita`
**Accesso senza login:**
- Visualizzazione dei film e della programmazione. 
- Registrazione di un utente.

**Accesso con login:**
- Prenotazione (bisogna controllare che non si superi il numero di posti).

**Accesso con login di amministratore:**
- Inserimento e modifica dei dati, degli utenti e delle prenotazioni.
