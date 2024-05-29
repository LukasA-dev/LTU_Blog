<?php
require_once '../includes/db.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$post_id = db_escape($db, $_GET['id']);
$query = "
    SELECT post.id, post.title, post.content, post.created, post.image, user.username, user.id as userId
    FROM post 
    JOIN user ON post.userId = user.id 
    WHERE post.id = '$post_id'";
$post = db_select($db, $query);

if (!$post) {
    die('Post not found.');
}

$post = $post[0]; // Since db_select returns an array of results
require_once '../includes/header.php'; // Include the frontend header
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <p>Posted by: <a href="blogger_profile.php?id=<?= $post['userId'] ?>"><?= htmlspecialchars($post['username']) ?></a> on <?= htmlspecialchars($post['created']) ?></p>
        <?php if ($post['image']) : ?>
            <img src="../uploads/<?= htmlspecialchars($post['image']) ?>" alt="Post Image" class="post-image">
        <?php endif; ?>
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        <a href="index.php">Back to Home</a>
    </div>
</body>

</html>

<?php
db_disconnect($db);
require_once '../includes/footer.php'; // Include the frontend footer
?>