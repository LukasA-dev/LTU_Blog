<?php
session_start();
require_once '../includes/db.php';
require_once 'header.php'; // Include the admin header

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../public/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = db_escape($db, $_POST['title']);
    $content = db_escape($db, $_POST['content']);
    $user_id = $_SESSION['user_id'];

    // Handle image upload
    $image = null;
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

    $query = "INSERT INTO post (title, content, userId, image) VALUES ('$title', '$content', '$user_id', '$image')";
    db_query($db, $query);
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Create New Post</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="container">
        <h2>Create New Post</h2>
        <form action="new_post.php" method="post" enctype="multipart/form-data" class="new-post-form">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="10" required></textarea>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*">

            <input type="submit" value="Publish">
        </form>
    </div>
</body>

</html>

<?php
db_disconnect($db);
require_once '../includes/footer.php'; // Include the admin footer
?>