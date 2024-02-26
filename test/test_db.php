<?php
require_once 'test_db_credentials.php';

// Kopplar upp mot databasen
function db_connect()
{
    $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    return $connection;
}

// Stänger kopplingen mot databasen
function db_disconnect($connection)
{
    if (isset($connection)) {
        $connection->close();
    }
}

// Säkra upp värden för att undvika SQL-injektioner
function db_escape($connection, $str)
{
    return $connection->real_escape_string($str);
}

// Kör en SQL-fråga mot databasen
function db_query($connection, $query)
{
    $result = $connection->query($query);
    if (!$result) {
        die("SQL query failed: " . $connection->error);
    }
    return $result;
}

// Hämtar data från databasen
function db_select($connection, $query)
{
    $result = db_query($connection, $query);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $result->free();
    return $data;
}

// Importerar tabeller till databasen
function db_import($connection, $filename, $dropOldTables = FALSE)
{
    // Läser in SQL-filen
    $sql = file_get_contents($filename);
    if ($dropOldTables) {
        // Lägg till logik för att ta bort gamla tabeller här
    }
    // Kör SQL-kommandona från filen
    if ($connection->multi_query($sql)) {
        do {
            // Använd next_result för att hantera flera SQL-kommandon i en fil
            if ($result = $connection->store_result()) {
                $result->free();
            }
        } while ($connection->more_results() && $connection->next_result());
    }
}
