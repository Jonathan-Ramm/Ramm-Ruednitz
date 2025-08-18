# Ramm-Ruednitz

**Meine eigene Seite — verhältnisweise großes Projekt.**  
Dieses Repository enthält die PHP-basierte Website *Ramm-Ruednitz*, ein persönliches Webprojekt mit Content-Seiten, Benutzer-Authentifizierung, administrativen Prüfungen und einem kleinen interaktiven Feature.

---

## Kurzbeschreibung
Die Seite ist als klassisches, serverseitig gerendertes Webprojekt umgesetzt (PHP + CSS + JavaScript). Inhalte werden teilweise aus einer Datenbank geladen; es gibt Login/Logout-Funktionalität, eine Admin-Überprüfung, eine Fehlerseite und ein kleines interaktives Modul (`autoraten.php`).

---

## Hauptfunktionen / Features
- Mehrere Content-Seiten (z. B. `index.php`, `interessantes.php`)  
- Benutzer-Authentifizierung (Login / Logout — `anmelden.php`, `logout.php`)  
- Datenbankanbindung über `db.php` (z. B. Lesen/Schreiben von Einträgen)  
- Admin-Prüfungen / Zugriffskontrolle (`checkAdmin.php`)  
- Interaktive Komponente / kleines Spiel (`autoraten.php`)  
- Zentrales Styling (`styles.css`) und responsive Grundstruktur  
- Server-Schutz / Konfiguration via `.htaccess` und `.htpasswd`  
- Fehlerbehandlung / Fehlerseite (`fehlermeldungen.php`)  
- Konfigurationsdatei `einstellungen.php` und Hilfsdateien wie `Tabelle.php`

---

## Tech-Stack
- PHP (serverseitig)  
- MySQL / MariaDB (Datenbank, via `db.php`)  
- HTML / CSS (Frontend, `styles.css`)  
- JavaScript (kleine interaktive Teile)  
- Optional: Apache (für `.htaccess` / Verzeichnisschutz)
