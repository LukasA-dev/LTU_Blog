<?php
require_once '../includes/db.php'; // Include database connection

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = db_escape($db, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = db_select($db, $query);

    if ($result && password_verify($password, $result[0]['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $result[0]['username'];
        $_SESSION['user_id'] = $result[0]['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Felaktigt användarnamn eller lösenord. Försök igen.";
        header("Location: ../public/login.php");
        exit;
    }

    db_disconnect($db);
}
