<?php
require_once '../includes/header.php'; // Include the frontend header
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($_SESSION['error_message'])) : ?>
            <p class="error-message"><?= htmlspecialchars($_SESSION['error_message']) ?></p>
            <?php unset($_SESSION['error_message']); // Clear the error message after displaying it 
            ?>
        <?php endif; ?>
        <form action="../admin/authenticate_user.php" method="post">
            <label for="username">Användarnamn:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Lösenord:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Logga in">
        </form>
    </div>
</body>

</html>

<?php
require_once '../includes/footer.php'; // Include the frontend footer
?>