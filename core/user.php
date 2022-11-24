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
        $this->userId = @$_SESSION["userId"] ?? "";
        $this->username = @$_SESSION["username"] ?? "";
        $this->firstname = @$_SESSION["firstname"] ?? "";
        $this->surname = @$_SESSION["surname"] ?? "";
        $this->userRole = @$_SESSION["rolename"] ?? "guest";
        $this->email = @$_SESSION["email"] ?? "";
        $this->gender = @$_SESSION["gender"] ?? "";
        $this->phone = @$_SESSION["telephone"] ?? "";
    }
    
}