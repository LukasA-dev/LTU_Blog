<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/header.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = db_escape($db, $_POST['title']);
    $content = db_escape($db, $_POST['content']);
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO post (title, content, userId) VALUES ('$title', '$content', '$user_id')";
    db_query($db, $query);
    header('Location: dashboard.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create New Post</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="container">
        <h2>Create New Post</h2>
        <form action="create_post.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="10" required></textarea>

            <button type="submit">Publish</button>
        </form>
    </div>
</body>

</html>