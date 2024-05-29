<?php
session_start(); // Startar en session för att möjliggöra användning av session variabler
require_once '../includes/db.php'; // Inkluderar filen för databaskoppling
require_once 'header.php'; // Inkluderar admin header-filen

// Kontrollera om användaren är inloggad
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../public/login.php'); // Om användaren inte är inloggad, omdirigera till inloggningssidan
    exit; // Avslutar skriptet
}

// Hämta användarens nuvarande information från databasen
$user_id = db_escape($db, $_SESSION['user_id']); // Escapar användar-ID från sessionen för att undvika SQL-injektion
$query = "SELECT username, title, presentation FROM user WHERE id = '$user_id'"; // SQL-fråga för att hämta användarens information
$user = db_select($db, $query); // Utför SQL-frågan och lagrar resultatet

// Kontrollera om användaren hittades i databasen
if (empty($user)) {
    echo "Användaren hittades inte."; // Meddelande om användaren inte hittas
    exit; // Avslutar skriptet
}

// Kontrollera om begäran är av typen POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escapar titel och beskrivning från POST-datan för att undvika SQL-injektion
    $title = db_escape($db, $_POST['title']);
    $presentation = db_escape($db, $_POST['presentation']);

    // SQL-fråga för att uppdatera användarens information
    $query = "UPDATE user SET title = '$title', presentation = '$presentation' WHERE id = '$user_id'";
    db_query($db, $query); // Utför SQL-frågan
    header('Location: dashboard.php'); // Omdirigerar användaren till dashboard-sidan
    exit; // Avslutar skriptet
}
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8"> <!-- Ställer in teckenkodningen till UTF-8 -->
    <title>Edit Profile</title> <!-- Titel för sidan -->
    <link rel="stylesheet" href="../css/admin.css"> <!-- Inkluderar CSS-fil för styling -->
</head>

<body>
    <div class="container">
        <h2>Edit Profile</h2> <!-- Rubrik för sidan -->
        <form action="edit_profile.php" method="post" class="edit-profile-form"> <!-- Formulär för att redigera profil -->
            <label for="title">Titel:</label> <!-- Etikett för titel -->
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($user[0]['title']) ?>" required> <!-- Inmatningsfält för titel -->

            <label for="presentation">Beskrivning:</label> <!-- Etikett för presentation -->
            <textarea id="presentation" name="presentation" rows="5" required><?= htmlspecialchars($user[0]['presentation']) ?></textarea> <!-- Textarea för presentation -->

            <input type="submit" value="Update"> <!-- Knapp för att uppdatera profilen -->
        </form>
    </div>
</body>

</html>

<?php
db_disconnect($db); // Kopplar från databasen
require_once '../includes/footer.php'; // Inkluderar admin footer-filen
?>