<?php
session_start(); // Starta en session för att kunna använda session variabler
require_once '../includes/db.php'; // Inkludera filen för databaskoppling
require_once '../includes/header.php'; // Inkludera en gemensam header-fil

// Kontrollera om användaren är inloggad
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php'); // Om inte inloggad, omdirigera till inloggningssidan
    exit; // Avsluta skriptet
}

// Kontrollera om begäran är av typen POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hämta och escapa titel och innehåll från POST-datan
    $title = db_escape($db, $_POST['title']);
    $content = db_escape($db, $_POST['content']);
    $user_id = $_SESSION['user_id']; // Hämta användar-ID från sessionen

    // Skapa en SQL-fråga för att infoga ett nytt inlägg i databasen
    $query = "INSERT INTO post (title, content, userId) VALUES ('$title', '$content', '$user_id')";
    db_query($db, $query); // Utför SQL-frågan
    header('Location: dashboard.php'); // Omdirigera användaren till dashboard-sidan
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"> <!-- Ställ in teckenkodningen till UTF-8 -->
    <title>Create New Post</title> <!-- Titel för sidan -->
    <link rel="stylesheet" href="../css/admin.css"> <!-- Inkludera admin-CSS-fil för styling -->
</head>

<body>
    <div class="container">
        <h2>Create New Post</h2> <!-- Rubrik för sidan -->
        <form action="create_post.php" method="POST"> <!-- Formulär för att skapa nytt inlägg -->
            <label for="title">Title:</label> <!-- Etikett för titel -->
            <input type="text" id="title" name="title" required> <!-- Inmatningsfält för titel -->

            <label for="content">Content:</label> <!-- Etikett för innehåll -->
            <textarea id="content" name="content" rows="10" required></textarea> <!-- Textarea för innehåll -->

            <button type="submit">Publish</button> <!-- Publiceringsknapp -->
        </form>
    </div>
</body>

</html>