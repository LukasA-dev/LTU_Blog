<?php
require_once '../includes/db.php';
require_once '../includes/header.php'; // Include the frontend header

// Fetch the latest 3 posts from the database
$query_posts = "SELECT * FROM post ORDER BY created DESC LIMIT 3";
$posts = db_select($db, $query_posts);

// Fetch the 3 newest bloggers from the database
$query_bloggers = "SELECT username, created FROM user ORDER BY created DESC LIMIT 3";
$bloggers = db_select($db, $query_bloggers);

?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Welcome to Bloggstället</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1>Welcome to Bloggstället</h1>

        <h2>Latest Posts</h2>
        <ul>
            <?php foreach ($posts as $post) : ?>
                <li>
                    <a href="content.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="feed.php">View All Posts</a>


        <h2>Newest Bloggers</h2>
        <ul>
            <?php foreach ($bloggers as $blogger) : ?>
                <li>
                    <?= htmlspecialchars($blogger['username']) ?> - Joined on <?= htmlspecialchars($blogger['created']) ?>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</body>

</html>

<?php
db_disconnect($db);
require_once '../includes/footer.php'; // Include the frontend footer
?>