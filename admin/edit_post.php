<?php
session_start();
require_once '../includes/db.php';
require_once 'header.php'; // Include the admin header

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../public/login.php');
    exit;
}

// Fetch the post details
$post_id = db_escape($db, $_GET['id']);
$query = "SELECT title, content, image FROM post WHERE id = '$post_id' AND userId = '{$_SESSION['user_id']}'";
$post = db_select($db, $query);

if (empty($post)) {
    echo "No post found or you do not have permission to edit this post.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = db_escape($db, $_POST['title']);
    $content = db_escape($db, $_POST['content']);
    $image = $post[0]['image'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = basename($_FILES['image']['name']);
        $image_path = '../uploads/' . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $image = $image_name;
        } else {
            echo "Bilduppladdningen misslyckades. Försök igen.";
            exit;
        }
    }

    $query = "UPDATE post SET title = '$title', content = '$content', image = '$image' WHERE id = '$post_id' AND userId = '{$_SESSION['user_id']}'";
    db_query($db, $query);
    header('Location: dashboard.php');
    exit;
}
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
        <form action="edit_post.php?id=<?= $post_id ?>" method="post" enctype="multipart/form-data" class="edit-post-form">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($post[0]['title']) ?>" required>

            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="10" required><?= htmlspecialchars($post[0]['content']) ?></textarea>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
            <?php if ($post[0]['image']) : ?>
                <p>Current Image:</p>
                <img src="../uploads/<?= htmlspecialchars($post[0]['image']) ?>" alt="Current Image" class="post-image">
            <?php endif; ?>

            <input type="submit" value="Update">
        </form>
    </div>
</body>

</html>

<?php
db_disconnect($db);
require_once '../includes/footer.php'; // Include the admin footer
?>