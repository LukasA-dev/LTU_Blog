<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Bloggstället</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <nav>
            <ul class="nav-links">
                <li><a href="../public/index.php">Home</a></li>
                <li><a href="../public/feed.php">Feed</a></li>
                <li><a href="../public/all_bloggers.php">All Bloggers</a></li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                    <li><a href="../admin/dashboard.php" class="admin-link">Admin Dashboard</a></li>
                    <li class="logged-in-info"><a href="../public/blogger_profile.php?id=<?= $_SESSION['user_id'] ?>">Inloggad som: <?= htmlspecialchars($_SESSION['username']) ?></a></li>
                <?php else : ?>
                    <li><a href="../public/login.php">Login</a></li>
                    <li><a href="../public/register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>

</html>