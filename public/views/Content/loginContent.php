<?php

require_once getcwd()."/public/views/Components/content.php";

class LoginContent extends Content
{
    function __construct()
    {
        // $this->requireView("Components/content");

        parent::__construct();

        $loginTemplate = new View("login");
        $this->insert("contentBody", $loginTemplate);
        
    }
}