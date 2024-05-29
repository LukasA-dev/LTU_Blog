<?php
session_start(); // Startar en session för att möjliggöra användning av session variabler
require_once '../includes/db.php'; // Inkluderar filen för databaskoppling
require_once 'header.php'; // Inkluderar admin header-filen

// Kontrollera om användaren är inloggad
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../public/login.php'); // Om användaren inte är inloggad, omdirigera till inloggningssidan
    exit; // Avslutar skriptet
}

// Hämta användarens inlägg från databasen
$user_id = $_SESSION['user_id']; // Hämtar användar-ID från sessionen
$query = "SELECT * FROM post WHERE userId = '$user_id'"; // SQL-fråga för att hämta användarens inlägg
$posts = db_select($db, $query); // Utför SQL-frågan och lagrar resultaten
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8"> <!-- Ställer in teckenkodningen till UTF-8 -->
    <title>Manage Posts</title> <!-- Titel för sidan -->
    <link rel="stylesheet" href="../css/admin.css"> <!-- Inkluderar CSS-fil för styling -->
</head>

<body>
    <div class="container">
        <h2>Hantera Inlägg</h2> <!-- Rubrik för sidan -->
        <ul>
            <!-- Loopar genom alla användarens inlägg -->
            <?php foreach ($posts as $post) : ?>
                <li>
                    <!-- Länk till att visa specifikt inlägg -->
                    <a href="../public/content.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
                    <!-- Länk till att redigera inlägg -->
                    <a href="edit_post.php?id=<?= $post['id'] ?>" class="icon"><img src="../images/edit.png" alt="Edit"></a>
                    <!-- Länk till att radera inlägg med bekräftelse -->
                    <a href="delete_post.php?id=<?= $post['id'] ?>" class="icon" onclick="return confirm('Är du säker på att du vill radera detta inlägg?')"><img src="../images/trash.png" alt="Delete"></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>

<?php
db_disconnect($db); // Kopplar från databasen
require_once '../includes/footer.php'; // Inkluderar admin footer-filen
?>