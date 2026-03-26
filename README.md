# Pokémon Webalkalmazás (PHP)

## 📌 Áttekintés

Ez a projekt egy PHP alapú webalkalmazás, amely lehetővé teszi Pokémon adatok megjelenítését és kezelését felhasználói hitelesítéssel.

A rendszer célja egy egyszerű, mégis működő webes alkalmazás megvalósítása backend logikával és felhasználókezeléssel.

---

## 🚀 Fő funkciók

- Felhasználói regisztráció és bejelentkezés
- Kijelentkezés
- Pokémon lista megjelenítése
- Részletes adatlap megtekintése
- Admin felület
- Felhasználói adatok kezelése

---

## 🧠 Kiemelt megoldások

- Session alapú autentikáció
- JSON alapú adatkezelés (adatbázis helyett)
- Jogosultság alapú hozzáférés (admin vs user)
- Egyszerű CRUD logika

---

## 🛠 Használt technológiák

- PHP
- HTML
- CSS
- JSON (adat tárolás)

---

## 📁 Projekt struktúra

indexLogin.php – belépési oldal  
login.php – bejelentkezés  
logout.php – kijelentkezés  
register.php – regisztráció  

admin.php – admin felület  
details.php – Pokémon részletek  

pokemon_data.json – Pokémon adatok  
users.json – felhasználók  

styles/ – CSS fájlok  

---

## ⚙️ Futtatás

1. Helyezd a projektet egy PHP-t támogató szerverre (pl. XAMPP)

2. Indítsd el a szervert

3. Nyisd meg böngészőben:


---

## 🔐 Jogosultságok

Vendég:
- regisztráció
- bejelentkezés

Felhasználó:
- Pokémon adatok megtekintése

Admin:
- teljes hozzáférés az admin felülethez

---

## 📄 Megjegyzés

A projekt JSON fájlokat használ adatbázis helyett, ezért nem igényel külön adatbázis telepítést.

---

## 🎯 Fejlesztési lehetőségek

- Adatbázis (MySQL) használata JSON helyett
- Jelszó titkosítás fejlesztése
- REST API kialakítása
- Frontend modernizálása
