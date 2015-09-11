<?php   
    session_start();
    require_once("php/classes/Review.php");
    require_once("php/classes/Login.php");
    $login = new Login();

   if ($login->isUserLoggedIn() == true) {
        $photoId = $_POST["photo_id"];
        $comment = $_POST["comment"];
        $rating = $_POST["rating"];
        $userId = $_SESSION["user_id"];
        $review = new Review();
        if($review->existsReview($photoId,$userId) == false){  
            $review->saveNew($photoId, $comment, $rating, $userId);
            header( 'Location: photo.php?photoId='. $photoId );
        }
    }
?>