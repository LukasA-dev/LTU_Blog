<?php
require_once 'db_credentials.php';

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

// Global database connection
$db = db_connect();
