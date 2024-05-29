<?php
require_once '../includes/db.php'; // Inkluderar filen för databaskoppling
require_once '../includes/header.php'; // Inkluderar gemensam header-fil

// Hämta alla inlägg och deras författare från databasen
$query = "SELECT post.*, user.username FROM post JOIN user ON post.userId = user.id ORDER BY post.created DESC"; // SQL-fråga för att hämta alla inlägg och deras författare, sorterade efter skapelsedatum i fallande ordning
$posts = db_select($db, $query); // Utför SQL-frågan och lagrar resultaten
?>

<div class="container">
    <h2>Alla inlägg</h2> <!-- Rubrik för sidan -->
    <ul>
        <!-- Loopar genom alla inlägg och visar dem -->
        <?php foreach ($posts as $post) : ?>
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

<?php
require_once '../includes/footer.php'; // Inkluderar gemensam footer-fil
?>