<?php
require_once("php/classes/User.class.php");
require_once("php/classes/Login.class.php");

/**
 * Class registration
 * handles the user registration
 */
class Registration
{
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();

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
            $this->errors[] = "Empty Username";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->errors[] = "Empty Password";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->errors[] = "REGISTRATION_DIFFERENT_PASSWORDS";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $this->errors[] = "Password has a minimum length of 6 characters";
        } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        } elseif (empty($_POST['user_email'])) {
            $this->errors[] = "Email cannot be empty";
        } elseif (strlen($_POST['user_email']) > 64) {
            $this->errors[] = "Email cannot be longer than 64 characters";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Your email address is not in a valid email format";
        } else {
            // escaping, additionally removing everything that could be (html/javascript-) code
            $user_name = $_POST['user_name'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password_new'];

            $user = new User();

            $query_check_user_name = $user->search($user_name, $user_email);
            if ($query_check_user_name->num_rows == 1){
                $this->errors[] = "REGISTRATION_EXISTENT_USER";
            } else {                
                $query_new_user_insert = $user->register($user_name, $user_password, $user_email);
                if ($query_new_user_insert) {
                    $this->successful = true;
                    $login = new Login();
                    $login->doLogin($user_name,$user_password);
                } else {
                    $this->errors[] = "REGISTRATION_FAILURE";
                }
            }
        }
    }
}
?>