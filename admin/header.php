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
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="new_post.php">Skapa Inlägg</a></li>
                <li><a href="manage_posts.php">Hantera Inlägg</a></li>
                <li><a href="logout.php">Logga ut</a></li>
            </ul>
        </nav>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
            <p>Inloggad som: <?= htmlspecialchars($_SESSION['username']) ?></p>
        <?php endif; ?>
    </header>
    <!-- Resten av sidans innehåll följer... -->
</body>

</html>