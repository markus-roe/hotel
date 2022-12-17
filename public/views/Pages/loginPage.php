<?php

require_once getcwd()."/public/views/Components/page.php";
class LoginPage extends Page
{
    function __construct()
    {
        parent::__construct();
        $this->requireTemplate("Content/loginContent");
        $loginContent = new Template("login", ["inputerror", "inputerrormsg", "registrationpath"=>"./registration/newuser"]);
        $this->changeContent($loginContent);
    }
}