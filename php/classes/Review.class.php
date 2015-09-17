<?php      
// include class to get the database connection
require_once("php/classes/Database.class.php");

/**
 * Class review
 */
class Review{

    public function getList($photoId){
        $db = Database::getInstance();
        $db_connection = $db->getConnection();

        $photoId = $db_connection->real_escape_string(strip_tags($photoId, ENT_QUOTES));

        $sql = "SELECT *
                FROM reviews
                INNER JOIN users on (reviews.user_id= users.user_id)
                WHERE photo_id = '" . $photoId . "';";
        $result = $db_connection->query($sql);
        return $result;    
    }

    public function saveNew($photoId, $comment, $rating, $userId){
        $db = Database::getInstance();
        $db_connection = $db->getConnection();

        $photoId = $db_connection->real_escape_string(strip_tags($photoId, ENT_QUOTES));
        $comment = $db_connection->real_escape_string(strip_tags($comment, ENT_QUOTES));
        $rating = $db_connection->real_escape_string(strip_tags($rating, ENT_QUOTES));
        $userId = $db_connection->real_escape_string(strip_tags($userId, ENT_QUOTES));

        $sql = "INSERT INTO reviews (photo_id, review_comment, review_rating, user_id)
                VALUES ('" . $photoId . "', '" . $comment . "', '" . $rating . "', '" . $userId ."');";

        $result=$db_connection->query($sql);
        
        return $result;
    }

    public function getAverageRating($photoId){
        $db = Database::getInstance();
        $db_connection = $db->getConnection();

        $photoId = $db_connection->real_escape_string(strip_tags($photoId, ENT_QUOTES));

        $sql = "SELECT ROUND(AVG(review_rating),1)
                FROM reviews 
                WHERE photo_id='" . $photoId . "';";

        $result = $db_connection->query($sql);
        $average= $result->fetch_row()[0];
        if ($average == NULL){
            $average=0;
        }
        return $average;
    }

    public function exists($photoId, $userId){
        $db = Database::getInstance();
        $db_connection = $db->getConnection();

        $photoId = $db_connection->real_escape_string(strip_tags($photoId, ENT_QUOTES));
        $userId = $db_connection->real_escape_string(strip_tags($userId, ENT_QUOTES));

        $sql = "SELECT COUNT(*)
                FROM reviews 
                WHERE photo_id='" . $photoId . "' and user_id='" . $userId . "';";
        $result = $db_connection->query($sql);
        $result_row= $result->fetch_row()[0];
        return $result_row > 0;
    }
}
?>