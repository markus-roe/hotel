<?php 

require_once  getcwd()."/core/model.php";

class ClientModel extends Model
{
    public int $userId;
    protected int $userRole;
    protected string $username;
    protected string $firstname;
    protected string $surname;
    protected string $email;
    protected string $gender;
    protected string $password;


    public function __construct()
    {

        // * get and set Userdata

        $this->connection = parent::connect();
        // $this->getUsername(1);
    }

    public function getUsername()
    {
      return $this->username;   
    }

    // * GETTER

    public function getUserRole()
    {
        return $this->userRole;
    }

    // public function getUsername()
    // {
    //     return $this->username;
    // }

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // * SETTER

    public function setUserRole($role)
    {
        $this->userRole = $role;
    }

    public function setFirstName($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastName($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getClientbyUserId($userId)
    {
        try
        {

            $result = $this->connection->query("SELECT username from users where userId = " . $userId);

            $row = $result -> fetch_array(MYSQLI_ASSOC);

            echo $row["username"];

        }
        catch(Exception $e)
        {
            throw $e; 	
        }
    }
/*
    public function loadAllUsers()
    {
        try
        {	
            $this->open_db();
            $query=$this->condb->prepare("SELECT * users from user");
            $query->execute();
            $res = $query->get_result();
            $last_id=$this->condb->insert_id;
            $query->close();
            $this->close_db();
            return $last_id;
        }
        catch (Exception $e) 
        {
            $this->close_db();	
            throw $e;
        }
    }
    */

    /*
    // insert User
    public function insertUser($user)
    {
        try
        {	
            $this->open_db();
            $query=$this->condb->prepare("INSERT INTO user (userId, username) VALUES ($user->userId, $user->username)");
            $query->bind_param("is",$user->userId,$user->username);
            $query->execute();
            $res = $query->get_result();
            $last_id=$this->condb->insert_id;
            $query->close();
            $this->close_db();
            return $last_id;
        }
        catch (Exception $e) 
        {
            $this->close_db();	
            echo $e;
            throw $e;
        }
    }
    */

}