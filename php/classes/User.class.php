<?php      
require_once("php/classes/Database.class.php");
// include password hashing functions
require_once("libs/password_compatibility_library.php");

/**
 * Class user
 */
class User{

    public function search($user_name, $user_email){
        $db = Database::getInstance();
        $db_connection = $db->getConnection();

        $user_name = $db_connection->real_escape_string(strip_tags($user_name, ENT_QUOTES));
        $user_email = $db_connection->real_escape_string(strip_tags($user_email, ENT_QUOTES));

        $sql = "SELECT *
                FROM users
                WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";

        $result = $db_connection->query($sql);
        return $result;
    }

    public function register($user_name, $user_password, $user_email){
        $db = Database::getInstance();
        $db_connection = $db->getConnection();

        // escaping, additionally removing everything that could be (html/javascript-) code
        $user_name = $db_connection->real_escape_string(strip_tags($user_name, ENT_QUOTES));
        $user_password = $db_connection->real_escape_string(strip_tags($user_password, ENT_QUOTES));
        $user_email = $db_connection->real_escape_string(strip_tags($user_email, ENT_QUOTES));

        // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
        // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
        // PHP 5.3/5.4, by the password hashing compatibility library
        $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

        // generate snow watch user's id
        $swp_user_id='SWP'.$user_name;

        // write new user's data into database
        $sql = "INSERT INTO users (swp_user_id, user_name, user_password_hash, user_email)
                VALUES('" . $swp_user_id . "', '" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "');";
        $result = $db_connection->query($sql);

        return $result;
    }    
}
?>