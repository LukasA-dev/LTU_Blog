<?php
require_once '../includes/db.php';
require_once '../includes/header.php';

// Fetch all posts and their authors
$query = "SELECT post.*, user.username FROM post JOIN user ON post.userId = user.id ORDER BY post.created DESC";
$posts = db_select($db, $query);
?>

<div class="container">
    <h2>Alla inlägg</h2>
    <ul>
        <?php foreach ($posts as $post) : ?>
            <li>
                <a href="content.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
                <p><?= htmlspecialchars(substr($post['content'], 0, 100)) ?>...</p>
                <p>Bloggare: <a href="blogger_profile.php?id=<?= $post['userId'] ?>"><?= htmlspecialchars($post['username']) ?></a></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php
require_once '../includes/footer.php';
?>