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
        $query = "
        select * from users u
        join roles r on r.userRoleId=u.userRole
        where u.userId = ?;";
        $stmt = self::$connection->prepare($query1);
        $stmt->bind_param("d", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_array(MYSQLI_ASSOC);

        return $user;
    }

    public function loginUser($username, $password)
    {


        $query = "SELECT * FROM users u
        JOIN roles r ON r.userRoleId=u.userRole
        WHERE u.userName = ?;";

        $stmt = self::$connection->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if($row)
        {
            if(password_verify($password, $row["password"])) 
            {

                $_SESSION["userId"] = $row["userId"];
                $_SESSION["username"] = $row["username"];;
                $_SESSION["loggedIn"] = true;
                $_SESSION["firstname"] = $row["firstname"];
                $_SESSION["surname"] = $row["surname"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["gender"] = $row["gender"];
                $_SESSION["rolename"] = $row["roleName"];
                $_SESSION["phone"] = $row["phone"];
                $_SESSION["profilepath"] = "./client/profile/index";
                $this->user = new User();
    
                return true;
            }
        }
        session_unset();

        return false;
    }

    public function logoutUser()
    {
        session_destroy();
        header("Location: ../home/index");
    }

    public function registerNewUser($firstname, $surname, $username, $password1, $gender, $email, $phone)
    {
        try {
         
        $query = "INSERT INTO users
        (firstname, surname, username, password, gender, email, phone)
        VALUES (?,?,?,?,?,?,?);";

            $stmt = self::$connection->prepare($query);
            $stmt->bind_param("sssssss", $firstname, $surname, $username, $password1, $gender, $email, $phone);
            $stmt->execute();
            $result1 = $stmt->get_result();
            
            return true;

        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function updateUserData($firstname, $surname, $email, $phone, $password, $confirmpassword, $userId)
    {
        try 
        {

            // If password was changed
            if($password)
            {
                if($password == $confirmpassword)
                {
                    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
                }

                $query = "UPDATE users SET firstname = ? ,surname = ? ,email = ?, phone = ?, password = ? WHERE userid = ?";

                $user = $this->executeQuery($query, "sssssd", [$firstname, $surname, $email, $phone, $hashedpassword, $userId]);
    
                $_SESSION["firstname"] = $firstname;
                $_SESSION["surname"] = $surname;
                $_SESSION["email"] = $email;
                $_SESSION["phone"] = $phone;
    
                return $user;
            }

            $query = "UPDATE users SET firstname = ? ,surname = ? ,email = ?, phone = ? WHERE userid = ?";

            $user = $this->executeQuery($query, "ssssd", [$firstname, $surname, $email, $phone, $userId]);

            $_SESSION["firstname"] = $firstname;
            $_SESSION["surname"] = $surname;
            $_SESSION["email"] = $email;
            $_SESSION["phone"] = $phone;

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
