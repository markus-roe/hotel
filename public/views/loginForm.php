<?php

require_once getcwd()."/public/views/content.php";

class LoginForm extends Content
{
    function __construct()
    {
        parent::__construct();

        $loginTemplate = new View("login");
        $this->insert("content", $loginTemplate);
        
    }
}