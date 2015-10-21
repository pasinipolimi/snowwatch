<?php   
    session_start();
    require_once("php/classes/Review.class.php");
    require_once("php/classes/Login.class.php");

    $redirectUrl = "index.php";
    $login = new Login();

    if ($login->isUserLoggedIn() == true) {
        if (isset($_POST["photo_id"]) and isset($_POST["comment"]) and isset($_POST["rating"]) and isset($_SESSION["user_id"])){
            $photoId = $_POST["photo_id"];
            $comment = $_POST["comment"];
            $rating = $_POST["rating"];
            $userId = $_SESSION["user_id"];

            $review = new Review();

            if($review->exists($photoId,$userId) == false){
                $review->saveNew($photoId, $comment, $rating, $userId);
                $redirectUrl = "photo.php?photoId=".$photoId;
            }
        }
    }
    header('Location: '. $redirectUrl);
?>