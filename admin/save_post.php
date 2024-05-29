<?php
require_once('includes/session_check.php'); // Inkluderar filen för sessionskontroll för att säkerställa att användaren är inloggad
require_once('includes/db.php'); // Inkluderar filen för databaskoppling

// Kontrollera om begäran är av typen POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Hämta användarinput och escapa för att undvika SQL-injektion
    $title = db_escape($db, $_POST['title']);
    $content = db_escape($db, $_POST['content']);

    // Antag att vi kommer att lägga till hantering för kategorier eller taggar här senare

    // Hämta användar-ID från sessionen
    $user_id = $_SESSION['user_id']; // Förutsätter att user_id sparas i sessionen

    // Skapa SQL-fråga för att infoga det nya inlägget i databasen
    $query = "INSERT INTO posts (title, content, user_id) VALUES ('$title', '$content', '$user_id')";

    // Kör SQL-frågan
    db_query($db, $query);

    // Omdirigera användaren till dashboard-sidan efter att inlägget har sparats
    header('Location: dashboard.php');
    exit; // Avsluta skriptet för att säkerställa att ingen ytterligare kod körs
}
