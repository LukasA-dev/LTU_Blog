<?php
session_start(); // Startar en session för att möjliggöra användning av session variabler
require_once '../includes/db.php'; // Inkluderar filen för databaskoppling

// Kontrollera om användaren är inloggad
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php'); // Om användaren inte är inloggad, omdirigera till inloggningssidan
    exit; // Avslutar skriptet
}

// Escapar post-ID från GET-parametern för att undvika SQL-injektion
$post_id = db_escape($db, $_GET['id']);

// SQL-fråga för att radera inlägget där id matchar och användar-ID matchar den inloggade användaren
$query = "DELETE FROM post WHERE id = '$post_id' AND userId = '{$_SESSION['user_id']}'";
db_query($db, $query); // Utför SQL-frågan för att radera inlägget

// Omdirigera användaren tillbaka till dashboard-sidan efter att inlägget har raderats
header('Location: dashboard.php');
exit; // Avslutar skriptet
