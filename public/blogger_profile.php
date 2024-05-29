<?php
require_once '../includes/db.php'; // Inkluderar filen för databaskoppling
require_once '../includes/header.php'; // Inkluderar gemensam header-fil

// Hämta bloggarens detaljer
$blogger_id = db_escape($db, $_GET['id']); // Escapar bloggarens ID från GET-parametern för att undvika SQL-injektion
$query = "SELECT username, title, presentation FROM user WHERE id = '$blogger_id'"; // SQL-fråga för att hämta bloggarens detaljer
$blogger = db_select($db, $query); // Utför SQL-frågan och lagrar resultatet

// Hämta bloggarens inlägg
$query = "SELECT id, title, content, created FROM post WHERE userId = '$blogger_id' ORDER BY created DESC"; // SQL-fråga för att hämta bloggarens inlägg, sorterade efter skapelsedatum i fallande ordning
$posts = db_select($db, $query); // Utför SQL-frågan och lagrar resultaten
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8"> <!-- Ställer in teckenkodningen till UTF-8 -->
    <title><?= htmlspecialchars($blogger[0]['username']) ?>'s Profil</title> <!-- Titel för sidan, undviker XSS -->
    <link rel="stylesheet" href="../css/style.css"> <!-- Inkluderar CSS-fil för styling -->
</head>

<body>
    <div class="container">
        <h1><?= htmlspecialchars($blogger[0]['username']) ?>'s Profil</h1> <!-- Visar bloggarens användarnamn som rubrik, undviker XSS -->
        <h2><?= htmlspecialchars($blogger[0]['title']) ?></h2> <!-- Visar bloggarens titel, undviker XSS -->
        <p><?= htmlspecialchars($blogger[0]['presentation']) ?></p> <!-- Visar bloggarens presentation, undviker XSS -->

        <h2>Inlägg</h2> <!-- Rubrik för inläggssektionen -->
        <ul>
            <!-- Loopar genom alla bloggarens inlägg och visar dem -->
            <?php foreach ($posts as $post) : ?>
                <li>
                    <!-- Länk till det specifika inlägget, visar inläggets titel -->
                    <h3><a href="content.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h3>
                    <!-- Visar inläggets skapelsedatum -->
                    <p><?= htmlspecialchars($post['created']) ?></p>
                    <!-- Visar inläggets innehåll, undviker XSS -->
                    <p><?= htmlspecialchars($post['content']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>

<?php
require_once '../includes/footer.php'; // Inkluderar gemensam footer-fil
db_disconnect($db); // Kopplar från databasen
?>