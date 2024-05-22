<?php
require_once '../includes/db.php';
require_once '../includes/header.php';

// Fetch all bloggers
$query = "SELECT id, username, title, presentation FROM user";
$bloggers = db_select($db, $query);
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Alla Bloggare</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1>Alla Bloggare</h1>
        <ul>
            <?php foreach ($bloggers as $blogger) : ?>
                <li>
                    <h3><a href="blogger_profile.php?id=<?= $blogger['id'] ?>"><?= htmlspecialchars($blogger['username']) ?></a></h3>
                    <p><?= htmlspecialchars($blogger['presentation']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>

<?php
require_once '../includes/footer.php';
db_disconnect($db);
?>