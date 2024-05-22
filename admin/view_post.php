<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/header.php';

// Check if the post ID is provided in the URL
if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$post_id = db_escape($db, $_GET['id']);
$query = "SELECT * FROM post WHERE id = '$post_id'";
$post = db_select($db, $query);

if (!$post) {
    die('Post not found.');
}

$post = $post[0];
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?></title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="container">
        <h2><?= htmlspecialchars($post['title']) ?></h2>
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        <a href="dashboard.php">Tillbaka till Dashboard</a>
    </div>
</body>

</html>

<?php
// Close the database connection
db_disconnect($db);
?>