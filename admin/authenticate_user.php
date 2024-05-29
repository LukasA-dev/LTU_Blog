<?php
require_once '../includes/db.php'; // Inkludera filen för databaskoppling

session_start(); // Starta en session för att kunna använda session variabler

// Kontrollera om begäran är av typen POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hämta och escapa användarnamnet från POST-datan
    $username = db_escape($db, $_POST['username']);
    $password = $_POST['password']; // Hämta lösenordet från POST-datan

    // Skapa en SQL-fråga för att hämta användaren med det specificerade användarnamnet
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = db_select($db, $query); // Utför SQL-frågan och lagra resultatet

    // Kontrollera om det finns ett resultat och om lösenordet är korrekt
    if ($result && password_verify($password, $result[0]['password'])) {
        // Sätt session variabler för att markera att användaren är inloggad
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $result[0]['username'];
        $_SESSION['user_id'] = $result[0]['id'];
        // Omdirigera användaren till dashboard-sidan
        header("Location: dashboard.php");
        exit; // Avsluta skriptet
    } else {
        // Sätt ett felmeddelande i sessionen om autentiseringen misslyckas
        $_SESSION['error_message'] = "Felaktigt användarnamn eller lösenord. Försök igen.";
        // Omdirigera användaren tillbaka till inloggningssidan
        header("Location: ../public/login.php");
        exit; // Avsluta skriptet
    }
}
