<?php
session_start();
require_once 'db.inc';

$pdo = db_connect();

if (!$pdo) {
    die("Database connection failed.");
}

$email = $_SESSION['email'];
$query = "SELECT * FROM Files";
$stmt = $pdo->prepare($query);
$stmt->execute();
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);


$selectUserQuery = "SELECT username FROM users WHERE email = ?";
$stmtUser = $pdo->prepare($selectUserQuery);
$stmtUser->execute([$email]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);
$userId = $user['username'];
echo '<h1> The Files </h1>';
if (!empty($files)) {
   
    foreach ($files as $file) {
        $filename = $file['photo'];
        $title = $file['titles'];
        $description = $file['descriptions'];
        $keywords = $file['keywords'];
        echo "<p>The User: $userId</p>";
        echo "<p>Description: $description</p>";
        echo "<p>titles: $title</p>";
        echo "<p>Keywords: $keywords</p>";
        echo "<a href='im/$filename' download>Download</a>";
        echo "<hr>";
    }
    echo " <a href='main.html'>Click here to back</a>.</br>";
} else {
    echo "No files uploaded yet.";
}

$pdo = null;
?>
