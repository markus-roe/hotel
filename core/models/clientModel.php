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
            $userId = $row["userId"];
            $_SESSION["username"] = $row["firstname"]." ". $row["surname"];
            $_SESSION["userId"] = $userId;
            $_SESSION["loggedIn"] = true;
            $this->user->setUserData($row);
            
            return true;
        }

        // session_unset();

        
        return false;
    }

    public function authenticate()
    {
        
        if (isset($_SESSION["userId"]) && isset($_SESSION["username"]))
        {
            $this->user->setUserData($this->getUserById($_SESSION["userId"]));

            return true;
        }

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