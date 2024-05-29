<?php
require_once '../includes/db.php'; // Inkluderar filen för databaskoppling
require_once '../includes/header.php'; // Inkluderar gemensam header-fil

// Hämta de senaste inläggen och deras författare från databasen
$query = "SELECT post.*, user.username FROM post JOIN user ON post.userId = user.id ORDER BY post.created DESC LIMIT 3"; // SQL-fråga för att hämta de senaste tre inläggen och deras författare, sorterade efter skapelsedatum i fallande ordning
$latest_posts = db_select($db, $query); // Utför SQL-frågan och lagrar resultaten

// Hämta de senaste bloggarna från databasen
$query = "SELECT id, username, title, presentation FROM user ORDER BY id DESC LIMIT 3"; // SQL-fråga för att hämta de senaste tre bloggarna, sorterade efter användar-ID i fallande ordning
$latest_bloggers = db_select($db, $query); // Utför SQL-frågan och lagrar resultaten
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8"> <!-- Ställer in teckenkodningen till UTF-8 -->
    <title>Welcome to Blogstället</title> <!-- Titel för sidan -->
    <link rel="stylesheet" href="../css/style.css"> <!-- Inkluderar CSS-fil för styling -->
</head>

<body>
    <div class="container">
        <h1>Välkommen till Bloggstället</h1> <!-- Rubrik för sidan -->

        <div class="latest-posts">
            <h2>Senaste Inläggen</h2> <!-- Rubrik för sektionen med de senaste inläggen -->
            <ul>
                <!-- Loopar genom de senaste inläggen och visar dem -->
                <?php foreach ($latest_posts as $post) : ?>
                    <li>
                        <!-- Länk till det specifika inlägget, visar inläggets titel -->
                        <a href="content.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
                        <!-- Visar en kort förhandsvisning av inläggets innehåll, undviker XSS -->
                        <p><?= htmlspecialchars(substr($post['content'], 0, 100)) ?>...</p>
                        <!-- Visar bloggarens användarnamn med länk till deras profil -->
                        <p>Bloggare: <a href="blogger_profile.php?id=<?= $post['userId'] ?>"><?= htmlspecialchars($post['username']) ?></a></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <h2>Senaste Bloggare</h2> <!-- Rubrik för sektionen med de senaste bloggarna -->
        <ul>
            <!-- Loopar genom de senaste bloggarna och visar deras information -->
            <?php foreach ($latest_bloggers as $blogger) : ?>
                <li>
                    <!-- Länk till bloggarens profil, visning av bloggarens användarnamn -->
                    <h3><a href="blogger_profile.php?id=<?= $blogger['id'] ?>"><?= htmlspecialchars($blogger['username']) ?></a></h3>
                    <!-- Visar bloggarens presentation, undviker XSS -->
                    <p><?= htmlspecialchars($blogger['presentation']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>

        <button onclick="window.location.href='all_bloggers.php'">Visa Alla Bloggare</button> <!-- Knapp för att visa alla bloggare -->
    </div>
</body>

</html>

<?php
require_once '../includes/footer.php'; // Inkluderar gemensam footer-fil
db_disconnect($db); // Kopplar från databasen
?>