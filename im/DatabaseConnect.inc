<?php
$db_host = "localhost";
$db_name = "c126_TAMER1";
$db_username = "c126_TAMER1";
$db_password = "comp334!";

try {
  $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "<p>Connection failed: " . $e->getMessage()."</p>";
  die();
}
?> 