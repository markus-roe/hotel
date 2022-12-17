<?php

class User
{
    public $username;
    public $firstname;
    public $surname;
    public $phone;
    public $email;
    public $gender;
    public $userRole;
    public $userId;
    public $profilepath;


    public function __construct()
    {
        $this->userId = @$_SESSION["userId"] ?? "";
        $this->username = @$_SESSION["username"] ?? "";
        $this->firstname = @$_SESSION["firstname"] ?? "";
        $this->surname = @$_SESSION["surname"] ?? "";
        $this->userRole = @$_SESSION["rolename"] ?? "guest";
        $this->email = @$_SESSION["email"] ?? "";
        $this->gender = @$_SESSION["gender"] ?? "";
        $this->phone = @$_SESSION["phone"] ?? "";
        $this->profilepath = @$_SESSION["profilepath"] ?? "./login/attempt";
    }
}