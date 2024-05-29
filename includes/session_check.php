<?php
session_start(); // Startar en session för att möjliggöra användning av session variabler

// Kontrollera om användaren är inloggad
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Om användaren inte är inloggad, omdirigera till inloggningssidan
    exit; // Avslutar skriptet för att säkerställa att ingen ytterligare kod körs
}
