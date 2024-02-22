<?php
require_once('header.php'); // Inkludera admin-header
require_once('../includes/session_check.php'); // Inkludera session-check
?>

<form action="save_post.php" method="post">
    <label for="title">Titel:</label>
    <input type="text" id="title" name="title" required>

    <label for="content">Innehåll:</label>
    <textarea id="content" name="content" required></textarea>

    <!-- Mall för att lägga till fler taggar -->
    <label for="category">Kategori:</label>
    <select id="category" name="category">
        <!-- Fyll select-elementet med kategorier från databasen -->
    </select>

    <input type="submit" value="Publicera">
</form>

<?php require_once('footer.php'); ?>