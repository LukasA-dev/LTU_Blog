<?php
require_once '../includes/db.php';
require_once '../includes/header.php';

// Fetch blogger's details
$blogger_id = db_escape($db, $_GET['id']);
$query = "SELECT username, title, presentation FROM user WHERE id = '$blogger_id'";
$blogger = db_select($db, $query);

// Fetch blogger's posts
$query = "SELECT id, title, content, created FROM post WHERE userId = '$blogger_id' ORDER BY created DESC";
$posts = db_select($db, $query);
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($blogger[0]['username']) ?>'s Profil</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1><?= htmlspecialchars($blogger[0]['username']) ?>'s Profil</h1>
        <h2><?= htmlspecialchars($blogger[0]['title']) ?></h2>
        <p><?= htmlspecialchars($blogger[0]['presentation']) ?></p>

        <h2>Inlägg</h2>
        <ul>
            <?php foreach ($posts as $post) : ?>
                <li>
                    <h3><a href="content.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h3>
                    <p><?= htmlspecialchars($post['created']) ?></p>
                    <p><?= htmlspecialchars($post['content']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>

<?php
require_once '../includes/footer.php';
db_disconnect($db);
?>