<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register_user.php" method="POST">
            <label for="username">Användarnamn:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Lösenord:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Registrera</button>
        </form>
    </div>
</body>

</html>