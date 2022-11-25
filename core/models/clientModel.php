<?php 

require_once getcwd()."/core/model.php";
require_once getcwd()."/core/user.php";

class ClientModel extends Model
{
    public $user;
    private $isLoggedIn = false;

    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }


    public function getUserById($userId)
    {
        $query1 = "
        select * from users u
        join roles r on r.userRoleId=u.userRole
        where u.userId = ?;";
        $stm1 = self::$connection->prepare($query1);
        $stm1->bind_param("d", $userId);
        $stm1->execute();
        $result1 = $stm1->get_result();
        $user = $result1->fetch_array(MYSQLI_ASSOC);
        
        return $user;
    }

    public function loginUser()
    {
        if (!isset($_POST["password"]) || !isset($_POST["username"]))
        {
            return false;
        }

        $pwdInput = $_POST["password"];
        $userNameInput = $_POST["username"];

        $query1 = "
        select * from users u
        join roles r on r.userRoleId=u.userRole
        where u.userName = ? and
        u.password = ?;";

        $stm1 = self::$connection->prepare($query1);
        $stm1->bind_param("ss", $userNameInput, $pwdInput);
        $stm1->execute();
        $result1 = $stm1->get_result();
        $row = $result1->fetch_array(MYSQLI_ASSOC);

        if ($row)
        {
            $_SESSION["userId"] = $row["userId"];
            $_SESSION["username"] = $row["firstname"]." ". $row["surname"];
            $_SESSION["loggedIn"] = true;
            $_SESSION["firstname"] = $row["firstname"];
            $_SESSION["surname"] = $row["surname"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["gender"] = $row["gender"];
            $_SESSION["rolename"] = $row["roleName"];
            $_SESSION["telephone"] = $row["telephone"];
            $_SESSION["profilepath"] = "./profile/user/index";
            $this->user = new User();

            // TODO alle daten für user in session vars speichern
            
            return true;
        }

        // session_unset();

        
        return false;
    }

    public function logoutUser()
    {
        session_destroy();
        header("Location: ../home/index");
    }

    public function registerNewUser()
    {
        if (
        !isset($_POST["gender"]) ||
        !isset($_POST["firstname"]) ||
        !isset($_POST["surname"]) ||
        !isset($_POST["username"]) ||
        !isset($_POST["password"]) ||
        !isset($_POST["password2"]))
        {
            return ErrorCode::MISSING_INPUT;
        }

        if ($_POST["password"] != $_POST["password2"])
        {
            return ErrorCode::PASSWORDS_NOT_MATCHING;
        }

        if (strlen($_POST["password"]) > 50)
        {
            return ErrorCode::PASSWORD_TOO_LONG;
        }
        // TODO sanitize Input
        // TODO hash password
        $query = "
        insert into users
        (firstname, surname, username, email, password, gender, telephone)
        values
        (?,?,?,?,?,?,?);";

        $stm1 = self::$connection->prepare($query);
        $stm1->bind_param("sssssss", $_POST["firstname"], $_POST["surname"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["gender"], $_POST["telephone"]);
        $stm1->execute();
        $result1 = $stm1->get_result();
        $row = $result1->fetch_array(MYSQLI_ASSOC);
        var_dump($row);
    }

    public function authenticate()
    {
        
        if (isset($_SESSION["userId"]) && isset($_SESSION["username"]))
        {
            $this->user = new User();
            return true;
        }

        // $this->user->profilepath = "./hotel/login/attempt/index";
        return false;
    }

    // protected function getUserData()
    // {
        
    // }

    public function getUserName()
    {
        return $this->user->firstName." ".$this->user->surName;
    }

    // * GETTERS
    public function getUserId()
    {
        return $this->userId;
    }


    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getUserRole()
    {
        return $this->userRole;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setFirstname()
    {
        $userId = 1;
        $firstname = 'max';

        $sql = "UPDATE users SET firstname = ? WHERE userId = " .  $userId;
        
        $stmt = self::$connection->prepare($sql);
        $stmt->bind_param("s", $firstname);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    
}