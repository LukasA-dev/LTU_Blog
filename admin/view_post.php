<?php
session_start(); // Startar en session för att möjliggöra användning av session variabler
require_once '../includes/db.php'; // Inkluderar filen för databaskoppling
require_once '../includes/header.php'; // Inkluderar gemensam header-fil

// Kontrollera om post-ID är tillhandahållet i URL:en
if (!isset($_GET['id'])) {
    header('Location: dashboard.php'); // Omdirigera till dashboard om inget post-ID tillhandahålls
    exit; // Avslutar skriptet
}

// Escapar post-ID från GET-parametern för att undvika SQL-injektion
$post_id = db_escape($db, $_GET['id']);

// Skapa SQL-fråga för att hämta inlägget från databasen
$query = "SELECT * FROM post WHERE id = '$post_id'";
$post = db_select($db, $query); // Utför SQL-frågan och lagrar resultatet

// Kontrollera om inlägget hittades
if (!$post) {
    die('Post not found.'); // Visar ett felmeddelande om inlägget inte hittades
}

// Hämta det första (och enda) inlägget från resultatet
$post = $post[0];
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8"> <!-- Ställer in teckenkodningen till UTF-8 -->
    <title><?= htmlspecialchars($post['title']) ?></title> <!-- Titel för sidan, undviker XSS -->
    <link rel="stylesheet" href="../css/admin.css"> <!-- Inkluderar CSS-fil för styling -->
</head>

<body>
    <div class="container">
        <h2><?= htmlspecialchars($post['title']) ?></h2> <!-- Visar postens titel, undviker XSS -->
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p> <!-- Visar postens innehåll med radbrytningar, undviker XSS -->
        <a href="dashboard.php">Tillbaka till Dashboard</a> <!-- Länk tillbaka till dashboard -->
    </div>
</body>

</html>

<?php
// Stänger databaskopplingen
db_disconnect($db);
?>