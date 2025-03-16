<?php
require_once "../config.php";
$artist_id = $_POST['artist_id'];
$user_id = $_POST['user_id'];
$pending = 'PENDING';

$stmt = $db->prepare(
    "INSERT INTO subscription VALUES (?,?,?)"
);

if ($stmt) {
    $stmt->bind_param("iis", $artist_id, $user_id, $pending);
    if ($stmt->execute()) {
    } else {
        echo $db->error;  
    }
} else {
    echo $db->error;
}

header("location: ../premium-artists.php");
?>