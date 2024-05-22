<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = db_escape($db, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT id, username, password FROM user WHERE username = '$username'";
    $user = db_select($db, $query);

    if ($user && password_verify($password, $user[0]['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user[0]['username'];
        $_SESSION['user_id'] = $user[0]['id'];
        header("Location: dashboard.php");
    } else {
        $error_message = "Incorrect username or password.";
    }

    db_disconnect($db);
}
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/admin.css?v=1.0">
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($error_message)) : ?>
            <div class="error"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <label for="username">Användarnamn:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Lösenord:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Logga in</button>
        </form>
        <div class="register-link">
            <p>Har du inget konto? <a href="register.php">Registrera här</a>.</p>
        </div>
    </div>
</body>

</html>