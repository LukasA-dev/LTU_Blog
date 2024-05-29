<?php
// Kontrollera om sessionen inte redan är startad, starta den annars
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Startar en session för att möjliggöra användning av session variabler
}
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8"> <!-- Ställer in teckenkodningen till UTF-8 -->
    <title>Bloggstället</title> <!-- Titel för sidan -->
    <link rel="stylesheet" href="../css/style.css"> <!-- Inkluderar CSS-fil för styling -->
</head>

<body>
    <header>
        <nav>
            <ul class="nav-links">
                <li><a href="../public/index.php">Home</a></li> <!-- Länk till hemsidan -->
                <li><a href="../public/feed.php">Feed</a></li> <!-- Länk till feed-sidan -->
                <li><a href="../public/all_bloggers.php">All Bloggers</a></li> <!-- Länk till sidan med alla bloggare -->

                <!-- Kontrollera om användaren är inloggad -->
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                    <!-- Visa administratörslänk om användaren är inloggad -->
                    <li><a href="../admin/dashboard.php" class="admin-link">Admin Dashboard</a></li>
                    <!-- Visa användarinformation om användaren är inloggad -->
                    <li class="logged-in-info"><a href="../public/blogger_profile.php?id=<?= $_SESSION['user_id'] ?>">Inloggad som: <?= htmlspecialchars($_SESSION['username']) ?></a></li>
                <?php else : ?>
                    <!-- Visa inloggnings- och registreringslänkar om användaren inte är inloggad -->
                    <li><a href="../public/login.php">Login</a></li>
                    <li><a href="../public/register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>

</html>