<?php
include('db.inc');

$pdo = db_connect();

if (!$pdo) {
    die("Database connection failed.");
}

$title = $_GET['query'] ?? '';



$query = "SELECT * FROM articles WHERE title LIKE :query OR keywords LIKE :query  OR username LIKE :query";

$stmt = $pdo->prepare($query);


$stmt->bindValue(':query', "%$title%", PDO::PARAM_STR);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($results) > 0) {
    echo "<h2>Search Results:</h2>";
    echo "<table border=1>";
    echo "<tr><th>Title</th><th>Author</th><th>Description</th></tr>";
    
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td><a href='getArtical.php?id={$row['id']}'>{$row['title']}</a></td>";
        echo "<td>{$row['username']}</td>";
        echo "<td>{$row['description']}</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo " <a href='main.html'>Click here to back</a>.</br>";
} else {
    echo "No articles found.";
}
$stmt = null;
$pdo = null;
?>





