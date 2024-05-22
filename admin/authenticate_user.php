<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = db_escape($db, $_POST['username']);
    $password = $_POST['password'];

    // Create SQL query to fetch the user with the given username
    $query = "SELECT id, username, password FROM user WHERE username = '$username'";
    $user = db_select($db, $query);

    if ($user && password_verify($password, $user[0]['password'])) {
        // Password is correct, set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user[0]['username'];
        $_SESSION['user_id'] = $user[0]['id'];

        // Redirect to user's dashboard or homepage
        header("Location: dashboard.php");
    } else {
        // Incorrect username or password
        echo "Incorrect username or password.";
    }

    // Close the database connection
    db_disconnect($db);
}
