<?php 

require_once getcwd()."/core/model.php";

class ClientModel extends Model
{
    private int $userId = 0;
    private string $username = "Guest";
    private string $firstname = "";
    private string $surname = "";
    private int $userRole = 0;
    private string $email = "";
    private string $gender = "";

    public function __construct($userId = 0)
    {
        parent::__construct();
    }


    public function mapProperties($userId)
    {

        $user = self::executeQuery("users", ["userId" => "1"]);

        $this->userId = $user["userId"];
        $this->username = $user["username"];
        $this->firstname = $user["firstname"];
        $this->surname = $user["surname"];
        $this->userRole = $user["userRole"];
        $this->email = $user["email"];
        $this->gender = $user["gender"];

    }

    public static function getUserById($userId)
    {
        $user = self::executeQuery("users", ["userId" => $userId]);
        
        return $user;
    }

    // * GETTERS
    public function getUserId()
    {
        return $this->userId;
    }

    public function getUsername()
    {
        return $this->username;
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