<?php
require_once '../includes/db.php'; // Inkluderar filen för databaskoppling

// Kontrollera om post-ID är tillhandahållet i URL:en
if (!isset($_GET['id'])) {
    header('Location: index.php'); // Omdirigera till indexsidan om inget post-ID tillhandahålls
    exit; // Avslutar skriptet
}

// Escapar post-ID från GET-parametern för att undvika SQL-injektion
$post_id = db_escape($db, $_GET['id']);

// Skapa SQL-fråga för att hämta inlägget och användarinformation från databasen
$query = "
    SELECT post.id, post.title, post.content, post.created, post.image, user.username, user.id as userId
    FROM post 
    JOIN user ON post.userId = user.id 
    WHERE post.id = '$post_id'";
$post = db_select($db, $query); // Utför SQL-frågan och lagrar resultatet

// Kontrollera om inlägget hittades
if (!$post) {
    die('Post not found.'); // Visar ett felmeddelande om inlägget inte hittades
}

// Hämta det första (och enda) inlägget från resultatet
$post = $post[0]; // Eftersom db_select returnerar en array av resultat
require_once '../includes/header.php'; // Inkluderar gemensam header-fil för frontend
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8"> <!-- Ställer in teckenkodningen till UTF-8 -->
    <title><?= htmlspecialchars($post['title']) ?></title> <!-- Titel för sidan, undviker XSS -->
    <link rel="stylesheet" href="../css/style.css"> <!-- Inkluderar CSS-fil för styling -->
</head>

<body>
    <div class="container">
        <h1><?= htmlspecialchars($post['title']) ?></h1> <!-- Visar postens titel, undviker XSS -->
        <p>Posted by: <a href="blogger_profile.php?id=<?= $post['userId'] ?>"><?= htmlspecialchars($post['username']) ?></a> on <?= htmlspecialchars($post['created']) ?></p> <!-- Visar postens författare och datum, undviker XSS -->
        <?php if ($post['image']) : ?> <!-- Kontrollera om inlägget har en bild -->
            <img src="../uploads/<?= htmlspecialchars($post['image']) ?>" alt="Post Image" class="post-image"> <!-- Visar postens bild, undviker XSS -->
        <?php endif; ?>
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p> <!-- Visar postens innehåll med radbrytningar, undviker XSS -->
        <a href="index.php">Back to Home</a> <!-- Länk tillbaka till startsidan -->
    </div>
</body>

</html>

<?php
db_disconnect($db); // Kopplar från databasen
require_once '../includes/footer.php'; // Inkluderar gemensam footer-fil för frontend
?>