<?php
// Inkludera db.php för att kunna använda dess funktioner
require 'test_db.php';

// Anslut till databasen
$db = db_connect();

// Skriv en enkel SQL-fråga för att hämta data
$query = "SELECT * FROM test_users"; // Använd testtabell
$result = db_select($db, $query); // Använder db_select-funktionen från db.php

// Kontrollera om vi fick något resultat
if ($result) {
    echo "<h1>Testanvändare från databasen:</h1>";
    foreach ($result as $row) {
        echo "<p>ID: " . htmlspecialchars($row['id']) . " - Användarnamn: " . htmlspecialchars($row['username']) . "</p>";
    }
} else {
    echo "<p>Inga användare hittades.</p>";
}

// Stäng databaskopplingen
db_disconnect($db);
