# Login & Register System con Dashboard Admin

Sistema di autenticazione e gestione utenti per piattaforma social. Costruito in PHP puro con MySQL, segue il pattern MVC per separazione logica/modello/vista.

## 📁 Struttura del Progetto

```
├── index.html, register.html       # Form login e registrazione
├── login.php, register.php         # Controller autenticazione
├── logic/
│   ├── db.php                      # Connessione database
│   ├── account.php                 # CRUD account
│   ├── delete_account.php          # API eliminazione
│   └── update_account_type.php     # API modifica ruolo
├── views/
│   └── account.php                 # Vista stato account
└── protected/
    └── dashboard.php               # Dashboard admin (solo Admin)
```

## 🔑 Sicurezza

- **Password hashing**: `password_hash()` e `password_verify()`
- **SQL Injection**: Prepared Statements con `bind_param()`
- **XSS**: Sanitizzazione output con `htmlspecialchars()`
- **Controllo accessi**: Sistema ruoli User/Admin con verifica sessione

## 💾 Database

```sql
CREATE DATABASE social;
CREATE TABLE accounts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(40) NOT NULL,
    lname VARCHAR(40) NOT NULL,
    username VARCHAR(40) NOT NULL UNIQUE,
    passwd VARCHAR(255) NOT NULL,
    accountType VARCHAR(20) NOT NULL DEFAULT 'User'
);
```

## 🚀 Funzionalità

### Registrazione & Login
- Form HTML → Controller PHP → Verifica credenziali → Sessione
- Hashing automatico password
- Verifica unicità username

### Dashboard Admin
- Tabella con tutti gli utenti (ID, nome, cognome, username, ruolo)
- Modifica tipo account (User ↔ Admin) con dropdown
- Eliminazione utenti
- Protezione accesso: solo utenti con ruolo Admin