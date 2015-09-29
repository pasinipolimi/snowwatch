<?php
require_once("php/classes/User.class.php");
// include password hashing functions
require_once("libs/password_compatibility_library.php");

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{
    /**
     * @var array Collection of error messages
     */
    public $errors = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct() {

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        // check login form contents
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Username field was empty.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Password field was empty.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {
            $user_name = $_POST['user_name'];
            $password = $_POST['user_password'];
            $this->doLogin($user_name, $password);
        }
    }

    /**
     * perform the login
     */
    public function doLogin($user_name, $password){
        $user = new User();
        $result_of_login_check = $user->search($user_name, $user_name);

        // if this user exists
        if ($result_of_login_check->num_rows == 1) {

            // get result row (as an object)
            $result_row = $result_of_login_check->fetch_object();

            // using PHP 5.5's password_verify() function to check if the provided password fits
            // the hash of that user's password
            if (password_verify($password, $result_row->user_password_hash)) {

                // write user data into PHP SESSION (a file on your server)
                $_SESSION['user_id'] = $result_row->user_id;
                $_SESSION['swp_user_id'] = $result_row->swp_user_id;
                $_SESSION['user_name'] = $result_row->user_name;
                $_SESSION['user_email'] = $result_row->user_email;
                $_SESSION['user_login_status'] = 1;

            } else {
                $this->errors[] = "Wrong password. Try again.";
            }
        } else {
            $this->errors[] = "This user does not exist.";
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        session_unset();
        $_SESSION = array();
        session_destroy();
    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
}
?>