<?php

class User
{
    public $firstName;
    public $surName;
    public $phone;
    public $email;
    public $gender;

    public function __construct($userData)
    {
        $user = $userData;

        $this->userId = $user["userId"];
        $this->username = $user["username"];
        $this->firstname = $user["firstname"];
        $this->surname = $user["surname"];
        $this->userRole = $user["userRole"];
        $this->email = $user["email"];
        $this->gender = $user["gender"];
    }
    
}