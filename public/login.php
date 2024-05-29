<?php
require_once '../includes/header.php'; // Inkluderar gemensam header-fil för frontend
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8"> <!-- Ställer in teckenkodningen till UTF-8 -->
    <title>Login</title> <!-- Titel för sidan -->
    <link rel="stylesheet" href="../css/style.css"> <!-- Inkluderar CSS-fil för styling -->
</head>

<body>
    <div class="container">
        <h2>Login</h2> <!-- Rubrik för sidan -->

        <!-- Kontrollera om det finns ett felmeddelande att visa -->
        <?php if (isset($_SESSION['error_message'])) : ?>
            <p class="error-message"><?= htmlspecialchars($_SESSION['error_message']) ?></p> <!-- Visar felmeddelandet, undviker XSS -->
            <?php unset($_SESSION['error_message']); // Rensar felmeddelandet efter att ha visat det 
            ?>
        <?php endif; ?>

        <!-- Formulär för att logga in användaren -->
        <form action="../admin/authenticate_user.php" method="post">
            <label for="username">Användarnamn:</label> <!-- Etikett för användarnamn -->
            <input type="text" id="username" name="username" required> <!-- Inmatningsfält för användarnamn -->
            <label for="password">Lösenord:</label> <!-- Etikett för lösenord -->
            <input type="password" id="password" name="password" required> <!-- Inmatningsfält för lösenord -->
            <input type="submit" value="Logga in"> <!-- Inloggningsknapp -->
        </form>
    </div>
</body>

</html>

<?php
require_once '../includes/footer.php'; // Inkluderar gemensam footer-fil för frontend
?>