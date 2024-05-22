<?php
require_once '../includes/db.php'; // Inkludera databasanslutning

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hämta användarinput
    $username = db_escape($db, $_POST['username']);
    $password = $_POST['password'];

    // Kryptera lösenordet
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";

    // Kör SQL-frågan
    $result = db_query($db, $query);

    if ($result) {
        header("Location: login.php");
    } else {
        echo "Ett fel uppstod. Försök igen.";
    }

    // Stäng databaskopplingen
    db_disconnect($db);
}
