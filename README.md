# Login & Register System (social platform)

Questo progetto implementa un sistema di gestione degli accessi e registrazione utente per una piattaforma social. È costruito su architettura PHP pura e utilizza il database MySQL per la persistenza dei dati, aderendo ai principi di separazione dei compiti (Logica, Modello, Vista) per garantire manutenibilità e sicurezza.

## ⚙️ Architettura del Progetto

Il progetto segue una struttura di file chiara, separando la logica di business, l'accesso ai dati e la presentazione (Model-View-Controller leggero).

| Directory / File | Ruolo | Descrizione |
| :--- | :--- | :--- |
| `index.html` | Vista (Login) | Frontend per l'accesso utente. Invia i dati a `login.php`. |
| `register.html` | Vista (Registrazione) | Frontend per la registrazione. Invia i dati a `register.php`. |
| `login.php` | Controller/Logica | Gestisce la richiesta di Login, verifica l'account e la password. |
| `register.php` | Controller/Logica | Gestisce la richiesta di Registrazione, verifica l'unicità dell'Username e inserisce il nuovo utente nel DB. |
| `views/account.php` | Vista | Visualizza lo stato dell'account dopo l'accesso o la registrazione (successo/errore). |
| `logic/account.php` | Modello/Logica DB | Contiene le funzioni di accesso al database (`check_account`, `validate_account`, `insert_data`). |
| `db.php` | Modello/Configurazione | Contiene la funzione per stabilire la connessione MySQL. |
| `style.css` / `account.css` | Stile | Fogli di stile per la formattazione dei moduli e della pagina account. |

## 🔑 Caratteristiche di Sicurezza

La sicurezza è gestita implementando standard fondamentali per le applicazioni web che trattano dati sensibili.

### 1\. Hashing delle Password

Le password non vengono mai memorizzate in chiaro.

  * **Registrazione:** La password inviata dal form viene processata con la funzione `password_hash()` in `register.php`.
  * **Accesso:** La password viene verificata contro l'hash memorizzato nel database utilizzando la funzione nativa di PHP `password_verify()` in `logic/account.php`.

### 2\. Prevenzione SQL Injection

Tutte le interazioni con il database MySQL avvengono tramite **Prepared Statements**. Questo garantisce che gli input dell'utente siano trattati come dati e mai come codice SQL eseguibile, neutralizzando il rischio di attacchi di SQL Injection.

### 3\. Sanitizzazione dell'Output

I dati utente (`fname`, `lname`, `username`, `sessionId`) visualizzati nella vista `views/account.php` sono sanitizzati utilizzando `htmlspecialchars()` per prevenire attacchi di Cross-Site Scripting (XSS).

## 💾 Schema del Database

Il database, denominato `social`, è costituito da una singola tabella per la gestione degli utenti.

### Tabella `accounts`

| Colonna | Tipo di Dato | Vincoli | Ruolo |
| :--- | :--- | :--- | :--- |
| `id` | `INT` | `PRIMARY KEY`, `AUTO_INCREMENT` | Identificativo univoco dell'utente (utilizzato per simulare la Session ID). |
| `fname` | `VARCHAR(40)` | `NOT NULL` | Nome dell'utente. |
| `lname` | `VARCHAR(40)` | `NOT NULL` | Cognome dell'utente. |
| `username` | `VARCHAR(40)` | `NOT NULL`, `UNIQUE` | Nome utente per il login. Deve essere univoco. |
| `passwd` | `VARCHAR(255)` | `NOT NULL` | Hash della password (lunghezza 255 per supportare l'hash generato da `PASSWORD_DEFAULT`). |

**Query di Creazione:**

```sql
CREATE DATABASE social;
CREATE TABLE accounts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(40) NOT NULL,
    lname VARCHAR(40) NOT NULL,
    username VARCHAR(40) NOT NULL UNIQUE,
    passwd VARCHAR(255) NOT NULL
);
```