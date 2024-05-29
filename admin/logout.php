<?php
session_start(); // Startar en session för att kunna avsluta den

// Tömmer alla session variabler
session_unset(); // Rensar alla session variabler

// Förstör sessionen
session_destroy(); // Förstör sessionen för att logga ut användaren

// Omdirigerar användaren till inloggningssidan efter utloggning
header("Location: ../public/login.php"); // Omdirigerar till inloggningssidan
exit; // Avslutar skriptet
