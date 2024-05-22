<?php
require_once '../includes/db.php';
require_once '../includes/header.php';

// Fetch the latest posts
$query = "SELECT post.id, post.title, post.content, post.created, user.username FROM post JOIN user ON post.userId = user.id ORDER BY post.created DESC LIMIT 3";
$latest_posts = db_select($db, $query);

// Fetch the latest bloggers
$query = "SELECT id, username, title, presentation FROM user ORDER BY id DESC LIMIT 3";
$latest_bloggers = db_select($db, $query);
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Welcome to Din Blogg</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1>Välkommen till Din Blogg</h1>

        <h2>Senaste Inlägg</h2>
        <ul>
            <?php foreach ($latest_posts as $post) : ?>
                <li>
                    <h3><a href="content.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h3>
                    <p>by <?= htmlspecialchars($post['username']) ?> on <?= $post['created'] ?></p>
                    <p><?= htmlspecialchars($post['content']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>

        <h2>Senaste Bloggare</h2>
        <ul>
            <?php foreach ($latest_bloggers as $blogger) : ?>
                <li>
                    <h3><a href="blogger_profile.php?id=<?= $blogger['id'] ?>"><?= htmlspecialchars($blogger['username']) ?></a></h3>
                    <p><?= htmlspecialchars($blogger['presentation']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>

        <button onclick="window.location.href='all_bloggers.php'">Visa Alla Bloggare</button>
    </div>
</body>

</html>

<?php
require_once '../includes/footer.php';
db_disconnect($db);
?>