<?php
session_start();
require_once '../includes/db.php';
require_once 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$post_id = db_escape($db, $_GET['id']);
$query = "SELECT * FROM post WHERE id = '$post_id' AND userId = '{$_SESSION['user_id']}'";
$post = db_select($db, $query);

if (!$post) {
    die('Post not found or access denied.');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = db_escape($db, $_POST['title']);
    $content = db_escape($db, $_POST['content']);

    $query = "UPDATE post SET title = '$title', content = '$content' WHERE id = '$post_id' AND userId = '{$_SESSION['user_id']}'";
    db_query($db, $query);
    header('Location: dashboard.php');
}

$post = $post[0];
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="container">
        <h2>Edit Post</h2>
        <form action="edit_post.php?id=<?= $post_id ?>" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>

            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="10" required><?= htmlspecialchars($post['content']) ?></textarea>

            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>