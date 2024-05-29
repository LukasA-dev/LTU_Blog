<?php
require_once '../includes/db.php'; // Inkluderar filen för databaskoppling
require_once '../includes/header.php'; // Inkluderar gemensam header-fil

// Hämta alla bloggare från databasen
$query = "SELECT id, username, title, presentation FROM user"; // SQL-fråga för att hämta alla bloggare
$bloggers = db_select($db, $query); // Utför SQL-frågan och lagrar resultatet
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8"> <!-- Ställer in teckenkodningen till UTF-8 -->
    <title>Alla Bloggare</title> <!-- Titel för sidan -->
    <link rel="stylesheet" href="../css/style.css"> <!-- Inkluderar CSS-fil för styling -->
</head>

<body>
    <div class="container">
        <h1>Alla Bloggare</h1> <!-- Rubrik för sidan -->
        <ul>
            <!-- Loopar genom alla bloggare och visar deras information -->
            <?php foreach ($bloggers as $blogger) : ?>
                <li>
                    <!-- Länk till bloggarens profil, visning av bloggarens användarnamn -->
                    <h3><a href="blogger_profile.php?id=<?= $blogger['id'] ?>"><?= htmlspecialchars($blogger['username']) ?></a></h3>
                    <!-- Visar bloggarens presentation, undviker XSS -->
                    <p><?= htmlspecialchars($blogger['presentation']) ?></p>
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