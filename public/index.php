<?php
require_once '../includes/db.php';
require_once '../includes/header.php';

// Fetch the latest posts and their authors
$query = "SELECT post.*, user.username FROM post JOIN user ON post.userId = user.id ORDER BY post.created DESC LIMIT 3";
$latest_posts = db_select($db, $query);

// Fetch the latest bloggers
$query = "SELECT id, username, title, presentation FROM user ORDER BY id DESC LIMIT 3";
$latest_bloggers = db_select($db, $query);
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Welcome to Blogstället</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1>Välkommen till Bloggstället</h1>

        <div class="latest-posts">
            <h2>Senaste Inläggen</h2>
            <ul>
                <?php foreach ($latest_posts as $post) : ?>
                    <li>
                        <a href="content.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
                        <p><?= htmlspecialchars(substr($post['content'], 0, 100)) ?>...</p>
                        <p>Bloggare: <a href="blogger_profile.php?id=<?= $post['userId'] ?>"><?= htmlspecialchars($post['username']) ?></a></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

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