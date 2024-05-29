<?php
// Säkerställ att sessionen är startad
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Startar en session om ingen session är aktiv
}
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8"> <!-- Ställer in teckenkodningen till UTF-8 -->
    <title>Admin Dashboard</title> <!-- Titel för sidan -->
    <link rel="stylesheet" href="../css/admin.css"> <!-- Inkluderar CSS-fil för styling -->
</head>

<body>
    <header>
        <nav>
            <ul class="nav-links">
                <li><a href="../public/index.php">Home</a></li> <!-- Länk till startsidan -->
                <li><a href="dashboard.php">Dashboard</a></li> <!-- Länk till dashboard-sidan -->
                <li><a href="new_post.php">Skapa Inlägg</a></li> <!-- Länk till sidan för att skapa nya inlägg -->
                <li><a href="manage_posts.php">Hantera Inlägg</a></li> <!-- Länk till sidan för att hantera inlägg -->
                <li><a href="logout.php">Logga ut</a></li> <!-- Länk för att logga ut -->

                <!-- Visar användarinformation om användaren är inloggad -->
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                    <li class="logged-in-info"><a href="../public/blogger_profile.php?id=<?= $_SESSION['user_id'] ?>" class="button">Inloggad som: <?= htmlspecialchars($_SESSION['username']) ?></a></li> <!-- Länk till användarens profil -->
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>

</html>