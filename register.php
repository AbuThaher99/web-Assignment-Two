<?php

include('db.inc');

$email = $_POST['email'];
$password = $_POST['password'];
$usernaem = $_POST['username'];

$pdo = db_connect();

if (!$pdo) {
    error_message(sql_error());
}

$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "Email is already registered.</br>";
  
    echo " <a href='login.html'>Click here to login</a>.</br>";

} else {

    $sql = "INSERT INTO users (email, password ,username) VALUES (:email, :password,:username)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':username', $usernaem);

    if ($stmt->execute()) {
       
        header("Location: login.html");
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>