# Pokémon Management App (PHP)

---

## 🇭🇺 Magyar / 🇬🇧 English

- [🇭🇺 Magyar leírás](#-magyar-leírás)
- [🇬🇧 English documentation](#-english-documentation)

---

# 🇭🇺 Magyar leírás

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

- `indexLogin.php` – belépési oldal  
- `login.php` – bejelentkezés  
- `logout.php` – kijelentkezés  
- `register.php` – regisztráció  

- `admin.php` – admin felület  
- `details.php` – Pokémon részletek  

- `pokemon_data.json` – Pokémon adatok  
- `users.json` – felhasználók  

- `styles/` – CSS fájlok  

---

## ⚙️ Futtatás

1. Helyezd a projektet egy PHP-t támogató szerverre (pl. XAMPP)

2. Indítsd el a szervert

3. Nyisd meg böngészőben:

```
http://localhost/your-project-folder
```

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

---

# 🇬🇧 English documentation

## 📌 Overview

This project is a PHP-based web application that allows users to view and manage Pokémon data with user authentication.

The goal of the system is to implement a simple yet functional web application with backend logic and user management.

---

## 🚀 Main features

- User registration and login
- Logout functionality
- Display Pokémon list
- View detailed Pokémon pages
- Admin panel
- User management

---

## 🧠 Key solutions

- Session-based authentication
- JSON-based data storage (instead of a database)
- Role-based access control (admin vs user)
- Simple CRUD logic

---

## 🛠 Technologies used

- PHP
- HTML
- CSS
- JSON (data storage)

---

## 📁 Project structure

- `indexLogin.php` – login page  
- `login.php` – authentication  
- `logout.php` – logout  
- `register.php` – registration  

- `admin.php` – admin panel  
- `details.php` – Pokémon details  

- `pokemon_data.json` – Pokémon data  
- `users.json` – users  

- `styles/` – CSS files  

---

## ⚙️ Running the project

1. Place the project into a PHP-supported server environment (e.g., XAMPP)

2. Start the server

3. Open in your browser:

```
http://localhost/your-project-folder
```

---

## 🔐 Roles

Guest:
- registration
- login

User:
- view Pokémon data

Admin:
- full access to admin panel

---

## 📄 Notes

The project uses JSON files instead of a database, so no database setup is required.

---

## 🎯 Possible improvements

- Replace JSON with a database (MySQL)
- Improve password hashing
- Introduce a REST API
- Modernize the frontend
