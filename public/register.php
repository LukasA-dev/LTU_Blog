<?php
require_once '../includes/header.php'; // Inkluderar gemensam header-fil för frontend
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8"> <!-- Ställer in teckenkodningen till UTF-8 -->
    <title>Register</title> <!-- Titel för sidan -->
    <link rel="stylesheet" href="../css/style.css"> <!-- Inkluderar CSS-fil för styling -->
</head>

<body>
    <div class="container">
        <h2>Register</h2> <!-- Rubrik för sidan -->

        <!-- Formulär för att registrera en ny användare -->
        <form action="../admin/register_user.php" method="post">
            <label for="username">Användarnamn:</label> <!-- Etikett för användarnamn -->
            <input type="text" id="username" name="username" required> <!-- Inmatningsfält för användarnamn -->
            <label for="password">Lösenord:</label> <!-- Etikett för lösenord -->
            <input type="password" id="password" name="password" required minlength="6"> <!-- Inmatningsfält för lösenord med minsta längd -->
            <input type="submit" value="Registrera"> <!-- Registreringsknapp -->
        </form>
    </div>
</body>

</html>

<?php
require_once '../includes/footer.php'; // Inkluderar gemensam footer-fil för frontend
?>