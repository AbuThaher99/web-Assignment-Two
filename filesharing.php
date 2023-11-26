<?php
session_start();
include('db.inc');

$pdo = db_connect();


if (!$pdo) {
    die("Database connection failed.");
}

$email = $_SESSION['email'];
$title = $_POST['title'];
$description = $_POST['description'];
$keywords = $_POST['keywords'];


if(isset($_POST['submit']) && isset($_FILES['my_image'])) {

    $img_name = $_FILES['my_image']['name'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $img_upload_path = 'im/'.$img_name;
    move_uploaded_file($tmp_name, $img_upload_path);
 
}


$selectUserQuery = "SELECT id FROM users WHERE email = ?";
$stmtUser = $pdo->prepare($selectUserQuery);
$stmtUser->execute([$email]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);
$userId = $user['id'];




        $query = "INSERT INTO Files (user_id,titles, descriptions, keywords, photo) VALUES (?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        
        if ($stmt->execute([ $userId , $title, $description , $keywords , $img_name])) {
            echo "File uploaded successfully.";
            header("Location: viewFiles.php");
        } else {
            
          echo "inserting file details into the database: " . $stmt->errorInfo()[2];
        }
    
$pdo = null;
?>
