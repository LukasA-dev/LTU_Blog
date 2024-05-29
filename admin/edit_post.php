<?php
session_start(); // Startar en session för att möjliggöra användning av session variabler
require_once '../includes/db.php'; // Inkluderar filen för databaskoppling
require_once 'header.php'; // Inkluderar admin header-filen

// Kontrollera om användaren är inloggad
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../public/login.php'); // Om användaren inte är inloggad, omdirigera till inloggningssidan
    exit; // Avslutar skriptet
}

// Hämta inläggsdetaljerna
$post_id = db_escape($db, $_GET['id']); // Escapar post-ID från GET-parametern för att undvika SQL-injektion
$query = "SELECT title, content, image FROM post WHERE id = '$post_id' AND userId = '{$_SESSION['user_id']}'"; // SQL-fråga för att hämta specifikt inlägg
$post = db_select($db, $query); // Utför SQL-frågan och lagrar resultatet

// Kontrollera om inlägget finns och om användaren har behörighet att redigera det
if (empty($post)) {
    echo "No post found or you do not have permission to edit this post."; // Meddelande om inlägget inte hittas eller om användaren saknar behörighet
    exit; // Avslutar skriptet
}

// Kontrollera om begäran är av typen POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escapar titel och innehåll från POST-datan för att undvika SQL-injektion
    $title = db_escape($db, $_POST['title']);
    $content = db_escape($db, $_POST['content']);
    $image = $post[0]['image']; // Behåller den nuvarande bilden

    // Hanterar bilduppladdning
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = basename($_FILES['image']['name']);
        $image_path = '../uploads/' . $image_name; // Anger sökvägen för att spara bilden

        // Flyttar uppladdad bild till den specificerade sökvägen
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $image = $image_name; // Uppdaterar bildnamnet
        } else {
            echo "Bilduppladdningen misslyckades. Försök igen."; // Felmeddelande vid misslyckad bilduppladdning
            exit; // Avslutar skriptet
        }
    }

    // SQL-fråga för att uppdatera inlägget med nya data
    $query = "UPDATE post SET title = '$title', content = '$content', image = '$image' WHERE id = '$post_id' AND userId = '{$_SESSION['user_id']}'";
    db_query($db, $query); // Utför SQL-frågan
    header('Location: dashboard.php'); // Omdirigerar användaren till dashboard-sidan
    exit; // Avslutar skriptet
}
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8"> <!-- Ställer in teckenkodningen till UTF-8 -->
    <title>Edit Post</title> <!-- Titel för sidan -->
    <link rel="stylesheet" href="../css/admin.css"> <!-- Inkluderar CSS-fil för styling -->
</head>

<body>
    <div class="container">
        <h2>Edit Post</h2> <!-- Rubrik för sidan -->
        <form action="edit_post.php?id=<?= $post_id ?>" method="post" enctype="multipart/form-data" class="edit-post-form"> <!-- Formulär för att redigera inlägg -->
            <label for="title">Title:</label> <!-- Etikett för titel -->
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($post[0]['title']) ?>" required> <!-- Inmatningsfält för titel -->

            <label for="content">Content:</label> <!-- Etikett för innehåll -->
            <textarea id="content" name="content" rows="10" required><?= htmlspecialchars($post[0]['content']) ?></textarea> <!-- Textarea för innehåll -->

            <label for="image">Image:</label> <!-- Etikett för bild -->
            <input type="file" id="image" name="image" accept="image/*"> <!-- Inmatningsfält för bild -->
            <?php if ($post[0]['image']) : ?> <!-- Kontrollera om det finns en nuvarande bild -->
                <p>Current Image:</p> <!-- Visar nuvarande bild -->
                <img src="../uploads/<?= htmlspecialchars($post[0]['image']) ?>" alt="Current Image" class="post-image"> <!-- Bildvisning -->
            <?php endif; ?>

            <input type="submit" value="Update"> <!-- Knapp för att uppdatera inlägget -->
        </form>
    </div>
</body>

</html>

<?php
db_disconnect($db); // Kopplar från databasen
require_once '../includes/footer.php'; // Inkluderar admin footer-filen
?>