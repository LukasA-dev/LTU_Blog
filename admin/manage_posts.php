<?php
session_start();
require_once '../includes/db.php';
require_once 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Fetch user's posts from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM post WHERE userId = '$user_id'";
$posts = db_select($db, $query);

?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Hantera Inlägg</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="container">
        <h2>Hantera Inlägg</h2>
        <a href="new_post.php">Skapa Inlägg</a>
        <h3>Dina Inlägg</h3>
        <ul>
            <?php foreach ($posts as $post) : ?>
                <li>
                    <a href="view_post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
                    <a href="edit_post.php?id=<?= $post['id'] ?>">Redigera</a>
                    <a href="delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('Är du säker på att du vill radera detta inlägg?')">Radera</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>

<?php
// Close the database connection
db_disconnect($db);
?>