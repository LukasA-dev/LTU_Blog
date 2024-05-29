<?php
session_start(); // Startar en session för att möjliggöra användning av session variabler
require_once '../includes/db.php'; // Inkluderar filen för databaskoppling
require_once 'header.php'; // Inkluderar admin header-filen

// Kontrollera om användaren är inloggad
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../public/login.php'); // Om användaren inte är inloggad, omdirigera till inloggningssidan
    exit; // Avslutar skriptet
}

// Kontrollera om begäran är av typen POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escapar titel och innehåll från POST-datan för att undvika SQL-injektion
    $title = db_escape($db, $_POST['title']);
    $content = db_escape($db, $_POST['content']);
    $user_id = $_SESSION['user_id']; // Hämtar användar-ID från sessionen

    // Hanterar bilduppladdning
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = basename($_FILES['image']['name']); // Hämtar bildens namn
        $image_path = '../uploads/' . $image_name; // Anger sökvägen för att spara bilden

        // Flyttar uppladdad bild till den specificerade sökvägen
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $image = $image_name; // Uppdaterar bildnamnet
        } else {
            echo "Bilduppladdningen misslyckades. Försök igen."; // Felmeddelande vid misslyckad bilduppladdning
            exit; // Avslutar skriptet
        }
    }

    // SQL-fråga för att infoga ett nytt inlägg i databasen
    $query = "INSERT INTO post (title, content, userId, image) VALUES ('$title', '$content', '$user_id', '$image')";
    db_query($db, $query); // Utför SQL-frågan
    header('Location: dashboard.php'); // Omdirigerar användaren till dashboard-sidan
    exit; // Avslutar skriptet
}
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8"> <!-- Ställer in teckenkodningen till UTF-8 -->
    <title>Create New Post</title> <!-- Titel för sidan -->
    <link rel="stylesheet" href="../css/admin.css"> <!-- Inkluderar CSS-fil för styling -->
</head>

<body>
    <div class="container">
        <h2>Create New Post</h2> <!-- Rubrik för sidan -->
        <form action="new_post.php" method="post" enctype="multipart/form-data" class="new-post-form"> <!-- Formulär för att skapa nytt inlägg -->
            <label for="title">Title:</label> <!-- Etikett för titel -->
            <input type="text" id="title" name="title" required> <!-- Inmatningsfält för titel -->

            <label for="content">Content:</label> <!-- Etikett för innehåll -->
            <textarea id="content" name="content" rows="10" required></textarea> <!-- Textarea för innehåll -->

            <label for="image">Image:</label> <!-- Etikett för bild -->
            <input type="file" id="image" name="image" accept="image/*"> <!-- Inmatningsfält för bild -->

            <input type="submit" value="Publish"> <!-- Knapp för att publicera inlägget -->
        </form>
    </div>
</body>

</html>

<?php
db_disconnect($db); // Kopplar från databasen
require_once '../includes/footer.php'; // Inkluderar admin footer-filen
?>