<?php

require_once 'db.inc';
$pdo = db_connect();

if (!$pdo) {
    die("Database connection failed.");
}


$query = "SELECT * FROM articles";

$stmt = $pdo->prepare($query);

$stmt->execute();


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<h1> The Articles </h1>';
if (count($results) > 0) {
  foreach ($results as $row) {
    echo "Author: " . $row['username'] . "<br>";
    echo "Title: " . $row['title'] . "<br>";
    echo "Description: " . $row['description'] . "<br>";
    echo "Keywords: " . $row['keywords'] . "<br>";
    echo "Body Text: " . $row['body_text'] . "<br>";
    echo "<img src='im/" . $row['image/video'] . "' alt='Uploaded Image'><br>";
    echo "<hr>";
  }
  echo " <a href='main.html'>Click here to back</a>.</br>";
} else {
  echo "No articles found.";
}

$stmt = null;
$pdo = null;
?>
