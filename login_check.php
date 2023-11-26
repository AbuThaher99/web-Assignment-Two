<?php

session_start();
include('db.inc');

$email = $_POST['email'];
$password = $_POST['password'];

$pdo = db_connect();

if (!$pdo) {
    error_message(sql_error());
}

$sql = "SELECT * FROM users WHERE email = :email AND password = :password";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':password', $password);

$stmt->execute();

if ($stmt->rowCount() == 1) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['email'] = $user['email']; 
   
    header("Location: main.html");
    exit();
} else {
   
   echo "<script>alert('Invalid email or password.');</script>";
  
}

$pdo = null;
?>
