<?php
include('db.inc');

$pdo = db_connect();

if (!$pdo) {
    die("Database connection failed.");
}
$qury=$_GET['id'];

$query = "SELECT * FROM articles where id=:user";

$stmt = $pdo->prepare($query);
$stmt->bindValue(":user",$qury);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($result) > 0) {
    foreach ($result as $row) {
        echo "Author: " . $row['username'] . "<br>";
        echo "Title: " . $row['title'] . "<br>";
        echo "Description: " . $row['description'] . "<br>";
        echo "Keywords: " . $row['keywords'] . "<br>";
        echo "Body Text: " . $row['body_text'] . "<br>";
        echo "<img src='im/" . $row['image/video'] . "' alt='Uploaded Image'><br>";
        echo "<hr>";
    }
} else {
    echo "No found.";
}

?>