<?php
require_once "../config.php";
$creator_id = $_POST['creator_id'];
$subscriber_id = $_POST['subscriber_id'];
$status = $_POST['status'];
$zero = 0;

$stmt = $db->prepare(
    "UPDATE subscription SET status = ? WHERE creator_id = ? AND subscriber_id = ?"
);

if ($stmt) {
    $stmt->bind_param("sii", $status, $creator_id, $subscriber_id);
    if ($stmt->execute()) {        
    } else {
        echo $db->error;  
    }
} else {
    echo $db->error;
}

?>