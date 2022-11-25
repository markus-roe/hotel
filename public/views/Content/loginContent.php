<?php

require_once getcwd()."/public/views/Components/content.php";

class LoginContent extends Content
{
    function __construct()
    {
        // $this->requireTemplate("Components/content");

        parent::__construct();

        $loginTemplate = new Template("login");
        $this->insert("contentBody", $loginTemplate);
        
    }
}