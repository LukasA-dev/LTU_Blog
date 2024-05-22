<?php
session_start();
require_once '../includes/db.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$post_id = db_escape($db, $_GET['id']);
$query = "DELETE FROM post WHERE id = '$post_id' AND userId = '{$_SESSION['user_id']}'";
db_query($db, $query);

header('Location: dashboard.php');
exit;
