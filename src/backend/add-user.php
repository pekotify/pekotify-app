<?php
require_once "../config.php";
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$zero = 0;

$stmt = $db->prepare(
    "INSERT INTO user VALUES (?,?,?,?,?,?)"
);

if ($stmt) {
    $stmt->bind_param("issssi", $zero, $email, $password, $username, $name, $zero);
    if ($stmt->execute()) {
    } else {
        echo $db->error;  
    }
} else {
    echo $db->error;
}

header("location: ../login.php");
?>