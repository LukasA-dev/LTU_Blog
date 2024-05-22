<?php
require_once '../includes/db.php';
require_once '../includes/header.php'; // Include the frontend header

// Fetch all posts from the database along with the author's username
$query = "
    SELECT post.id, post.title, post.content, post.created, user.username 
    FROM post 
    JOIN user ON post.userId = user.id 
    ORDER BY post.created DESC";
$posts = db_select($db, $query);

?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Blog Feed</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h2>All Posts</h2>
        <ul>
            <?php foreach ($posts as $post) : ?>
                <li>
                    <a href="content.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
                    <p>Posted by: <?= htmlspecialchars($post['username']) ?> on <?= htmlspecialchars($post['created']) ?></p>
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