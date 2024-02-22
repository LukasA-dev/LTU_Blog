<?php
require_once('includes/session_check.php'); // Inkludera session-check
require_once('includes/db.php'); // Inkludera databasanslutning

$post_id = $_GET['id'] ?? null; // Hämta post ID från URL
if ($post_id) {
    $post = db_select($db, "SELECT * FROM posts WHERE id = '$post_id' AND user_id = '{$_SESSION['user_id']}' LIMIT 1");
    if (empty($post)) {
        die('Inlägget finns inte eller så har du inte behörighet att redigera det.');
    }
    $post = $post[0];
}
?>
<?php require_once('header.php'); ?>

<form action="update_post.php" method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($post['id']) ?>">

    <label for="title">Titel:</label>
    <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>

    <label for="content">Innehåll:</label>
    <textarea id="content" name="content" required><?= htmlspecialchars($post['content']) ?></textarea>

    <input type="submit" value="Uppdatera">
</form>

<?php require_once('footer.php'); ?>