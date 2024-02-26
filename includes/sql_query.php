<?php
function getUserNames($connection)
{
    $sql = "SELECT id, username FROM user ORDER BY created";
    $result = $connection->query($sql);
    $usernames = [];
    while ($row = $result->fetch_assoc()) {
        $usernames[$row['id']] = $row['username'];
    }
    return $usernames;
}
