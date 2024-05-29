<?php
session_start();
require_once '../includes/db.php';
require_once 'header.php'; // Include the admin header

// Kontrollera om användaren är inloggad
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../public/login.php');
    exit;
}

// Hämta användarens nuvarande information
$user_id = db_escape($db, $_SESSION['user_id']);
$query = "SELECT username, title, presentation FROM user WHERE id = '$user_id'";
$user = db_select($db, $query);

if (empty($user)) {
    echo "Användaren hittades inte.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = db_escape($db, $_POST['title']);
    $presentation = db_escape($db, $_POST['presentation']);

    $query = "UPDATE user SET title = '$title', presentation = '$presentation' WHERE id = '$user_id'";
    db_query($db, $query);
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="container">
        <h2>Edit Profile</h2>
        <form action="edit_profile.php" method="post" class="edit-profile-form">
            <label for="title">Titel:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($user[0]['title']) ?>" required>

            <label for="presentation">Beskrivning:</label>
            <textarea id="presentation" name="presentation" rows="5" required><?= htmlspecialchars($user[0]['presentation']) ?></textarea>

            <input type="submit" value="Update">
        </form>
    </div>
</body>

</html>

<?php
db_disconnect($db);
require_once '../includes/footer.php'; // Include the admin footer
?>