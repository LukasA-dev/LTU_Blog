<?php
session_start();
require_once '../includes/db.php'; // Inkludera databasanslutning

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hämta användarinput
    $username = db_escape($db, $_POST['username']);
    $password = $_POST['password'];

    // Skapa SQL-fråga för att hämta användaren med det angivna användarnamnet
    $query = "SELECT id, username, password FROM users WHERE username = '$username'";
    $user = db_select($db, $query);

    if ($user && password_verify($password, $user[0]['password'])) {
        // Lösenordet är korrekt, sätt sessionsvariabler
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user[0]['username'];
        $_SESSION['user_id'] = $user[0]['id'];

        // Omdirigera till användarens dashboard eller startsidan
        header("Location: dashboard.php");
    } else {
        // Fel användarnamn eller lösenord
        echo "Fel användarnamn eller lösenord.";
    }

    // Stäng databaskopplingen
    db_disconnect($db);
}
