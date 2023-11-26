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
    $bodyText = $_POST['body_text'];
   
    if(isset($_POST['move'])){
        $filecv = $_FILES['photo']['name'];
        $tempcv = $_FILES['photo']['tmp_name'];
        if(isset($filecv)){
            if(!empty($filecv)){
                    $locationq = "im/";
                    if(move_uploaded_file( $tempcv ,  $locationq.$filecv)){
                           
                    }
            }
        }
    }

    $selectUserQuery = "SELECT id FROM users WHERE email = ?";
    $stmtUser = $pdo->prepare($selectUserQuery);
    $stmtUser->execute([$email]);
    $user = $stmtUser->fetch(PDO::FETCH_ASSOC);
    $userId = $user['id'];

    $selectUserQueryd = "SELECT username FROM users WHERE email = ?";
    $stmtUserd = $pdo->prepare($selectUserQueryd);
    $stmtUserd->execute([$email]);
    $userd = $stmtUserd->fetch(PDO::FETCH_ASSOC);
    $userIdd = $userd['username'];





    $insertQuery = "INSERT INTO articles (user_id, username,title, description, keywords, body_text, `image/video`) VALUES (?, ?, ?, ?, ?,?,?)";
    $stmt = $pdo->prepare($insertQuery);

    if ($stmt->execute([ $userId ,$userIdd,$title, $description, $keywords, $bodyText, $filecv])) {
        echo "Article created successfully.";
        header("Location: view_article.php");
    } else {
        $errorMessage = "Error creating article: " . $stmt->errorInfo()[2];
    }

?>