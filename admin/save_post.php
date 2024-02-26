<?php
require_once('includes/session_check.php'); // Inkludera session-check
require_once('includes/db.php'); // Inkludera databasanslutning

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = db_escape($db, $_POST['title']);
    $content = db_escape($db, $_POST['content']);
    // Lägg till hantering för kategorier eller taggar
    $user_id = $_SESSION['user_id']; // Antag att vi sparar user_id i session

    $query = "INSERT INTO posts (title, content, user_id) VALUES ('$title', '$content', '$user_id')";
    db_query($db, $query);

    header('Location: dashboard.php'); // Återgå till dashboard efter sparande
}
