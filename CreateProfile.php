<?php

session_start();
include('db.inc');
$pdo = db_connect();


if (!$pdo) {
    
    error_message(sql_error());
}

if (!isset($_SESSION['email'])) {
    
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $bio = $_POST['bio'];
    $areaOfExperience = $_POST['experience_area'];
    $levelOfExperience = $_POST['experience_level'];
    $areaOfInterest = $_POST['area_of_interest'];
    
   

  

    if(isset($_POST['move'])){
        $mohammad = $_FILES['photo']['name'];
        $mohammadtmp = $_FILES['photo']['tmp_name'];
        if(isset($mohammad)){
            if(!empty($mohammad)){
                    $location = "im/";
                    if(move_uploaded_file( $mohammadtmp ,  $location.$mohammad)){
                           
                    }
            }
        }
    }

    


    if(isset($_POST['move']) && isset($_FILES['cv'])) {

        $filecv = $_FILES['cv']['name'];
        $tempcv = $_FILES['cv']['tmp_name'];
        $locationq = 'im/'.$filecv;
        move_uploaded_file($tempcv, $locationq);
     
    }
    


    $email = $_SESSION['email'];
 
 
   $updateQuery = "UPDATE users SET  bio = ?,  experience_area = ?, experience_level = ?, interest_area = ? ,cv = ? ,photo = ? WHERE email = ?";
   $stmt = $pdo->prepare($updateQuery);

   if ($stmt->execute([ $bio, $areaOfExperience, $levelOfExperience, $areaOfInterest,$filecv ,$mohammad ,$email])) {
       
       $successMessage = "Profile updated successfully!";
       echo $successMessage;
       echo " <a href='main.html'>Click here to back</a>.</br>";
   } else {
  
       $errorMessage = "Error updating profile: " . $stmt->errorInfo()[2];
   }
}

?>
