<?php
// Ensure the session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <header>
        <nav>
            <ul class="nav-links">
                <li><a href="../public/index.php">Home</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="new_post.php">Skapa Inlägg</a></li>
                <li><a href="manage_posts.php">Hantera Inlägg</a></li>
                <li><a href="logout.php">Logga ut</a></li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                    <li class="logged-in-info"><a href="../public/blogger_profile.php?id=<?= $_SESSION['user_id'] ?>" class="button">Inloggad som: <?= htmlspecialchars($_SESSION['username']) ?></a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>

</html>