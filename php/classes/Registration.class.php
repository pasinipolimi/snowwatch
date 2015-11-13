<?php
require_once("php/classes/User.class.php");
require_once("php/classes/Login.class.php");

/**
 * Class registration
 * handles the user registration
 */
class Registration{

    public $error = NULL;

    /**
     * @var boolean $successful Result of registration
     */
    public $successful = false;

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function registerNewUser()
    {
        if (empty($_POST['user_name'])) {
            $this->error = "USERNAME_EMPTY";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->error = "PASSWORD_EMPTY";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->error = "PASSWORDS_NOT_MATCH";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $this->error = "PASSWORD_HELP";
        } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $this->error = "USERNAME_INVALID_SIZE";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $this->error = "USERNAME_HELP";
        } elseif (empty($_POST['user_email'])) {
            $this->error = "EMAIL_EMPTY";
        } elseif (strlen($_POST['user_email']) > 64) {
            $this->error = "EMAIL_INVALID_SIZE";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = "EMAIL_INVALID_FORMAT";
        } else {
            // escaping, additionally removing everything that could be (html/javascript-) code
            $user_name = $_POST['user_name'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password_new'];

            $user = new User();

            $query_check_user_name = $user->search($user_name, $user_email);
            if ($query_check_user_name->num_rows == 1){
                $this->error = "REGISTRATION_EXISTENT_USER";
            } else {                
                $query_new_user_insert = $user->register($user_name, $user_password, $user_email);
                if ($query_new_user_insert) {
                    $this->successful = true;
                    $login = new Login();
                    $login->doLogin($user_name,$user_password);
                } else {
                    $this->error = "REGISTRATION_FAILURE";
                }
            }
        }
    }
}
?>