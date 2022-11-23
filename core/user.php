<?php

class User
{
    public $firstName;
    public $surName;
    public $phone;
    public $email;
    public $gender;
    public $userRole = "guest";
    public $userId;

    public function __construct()
    {

    }

    public function setUserData($userData)
    {
        $user = $userData;

        $this->userId = $user["userId"] ?? "";
        $this->username = $user["username"] ?? "";
        $this->firstname = $user["firstname"] ?? "";
        $this->surname = $user["surname"] ?? "";
        $this->userRole = $user["roleName"] ?? "";
        $this->email = $user["email"] ?? "";
        $this->gender = $user["gender"] ?? "";
    }
    
}