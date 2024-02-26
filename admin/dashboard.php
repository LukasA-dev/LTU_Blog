<?php
require_once('../includes/session_check.php'); // Inkludera session-check
require_once('../includes/db.php'); // Inkludera databasanslutning

// Hämta användarens inlägg från databasen
$user_id = $_SESSION['user_id']; // ID från den inloggade användaren
$posts = db_select($db, "SELECT * FROM posts WHERE user_id = '{$user_id}' ORDER BY created_at DESC");

require_once('header.php'); // Inkludera admin-header
?>

<h1>Dashboard</h1>

<!-- Visa användarens inlägg -->
<section>
    <?php if (!empty($posts)) : ?>
        <ul>
            <?php foreach ($posts as $post) : ?>
                <li>
                    <h2><?= htmlspecialchars($post['title']) ?></h2>
                    <p><?= htmlspecialchars(substr($post['content'], 0, 100)) ?>...</p>
                    <a href="edit_post.php?id=<?= $post['id'] ?>">Redigera</a> |
                    <a href="delete_post.php?id=<?= $post['id'] ?>">Ta bort</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Inga inlägg att visa.</p>
    <?php endif; ?>
</section>

<a href="create_post.php">Skapa nytt inlägg</a>

<?php
require_once('footer.php'); // Inkludera admin-footer
?>