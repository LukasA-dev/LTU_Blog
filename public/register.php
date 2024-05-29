<?php
require_once '../includes/header.php'; // Include the frontend header
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form action="../admin/register_user.php" method="post">
            <label for="username">Användarnamn:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Lösenord:</label>
            <input type="password" id="password" name="password" required minlength="6">
            <input type="submit" value="Registrera">
        </form>
    </div>
</body>

</html>

<?php
require_once '../includes/footer.php'; // Include the frontend footer
?>