<?php

require_once getcwd() . "/core/model.php";
require_once getcwd() . "/core/user.php";

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

    public function loginUser($username, $password)
    {


        $query1 = "
        select * from users u
        join roles r on r.userRoleId=u.userRole
        where u.userName = ? and
        u.password = ?;";

        $stm1 = self::$connection->prepare($query1);
        $stm1->bind_param("ss", $username, $password);
        $stm1->execute();
        $result1 = $stm1->get_result();
        $row = $result1->fetch_array(MYSQLI_ASSOC);

        if ($row) {
            $_SESSION["userId"] = $row["userId"];
            $_SESSION["username"] = $row["firstname"] . " " . $row["surname"];
            $_SESSION["loggedIn"] = true;
            $_SESSION["firstname"] = $row["firstname"];
            $_SESSION["surname"] = $row["surname"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["gender"] = $row["gender"];
            $_SESSION["rolename"] = $row["roleName"];
            $_SESSION["telephone"] = $row["telephone"];
            $_SESSION["profilepath"] = "./profile/" . $_SESSION["rolename"] . "/index";
            $this->user = new User();

            // TODO alle daten für user in session vars speichern

            return true;
        }
        session_unset();

        return false;
    }

    public function logoutUser()
    {
        session_destroy();
        header("Location: ../home/index");
    }

    public function registerNewUser($firstname, $surname, $username, $password1, $gender, $email)
    {
        try {
            // TODO sanitize Input
            // TODO hash password
            $query = "
        insert into users
        (firstname, surname, username, password, gender, email)
        values
        (?,?,?,?,?,?);";

            $stm1 = self::$connection->prepare($query);
            $stm1->bind_param("ssssss", $firstname,$surname, $username, $password1, $gender, $email);
            $stm1->execute();
            $result1 = $stm1->get_result();
            return true;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function changeUserData($firstname, $surname, $email, $userId)
    {
        try 
        {
            $query = "UPDATE users SET firstname = ? ,surname = ? ,email = ? WHERE userid = ?";

            $user = $this->executeQuery($query, "sssd", [$firstname, $surname, $email, $userId]);

            $_SESSION["firstname"] = $firstname;
            $_SESSION["surname"] = $surname;
            $_SESSION["email"] = $email;

    
            // * returns pictureID
            return $user;

        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function executeQuery($query, $paramString = "", $paramsArray = [])
    {        
        try
        {
            $rows = [];
            $params = array();
  
            // * push params to bind in array
            foreach ($paramsArray as $key => $value)
            {
                array_push($params, $value);
            }
            
            // * execute sql with parent model connection
            $stmt = self::$connection->prepare($query);

            if(count($paramsArray))
            {
                $stmt->bind_param($paramString, ...$params);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if(str_contains($query, "SELECT"))
            {
                while($row = $result->fetch_assoc())
            {
                $rows[] = $row;
            }
            return $rows;
            }
            return self::$connection->insert_id;

        } 
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function authenticate()
    {

        if (isset($_SESSION["userId"]) && isset($_SESSION["username"])) {
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
        return $this->user->firstName . " " . $this->user->surName;
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
