<?php

require_once getcwd()."/public/views/Components/Page.php";
class LoginPage extends Page
{
    function __construct()
    {
        parent::__construct();
        $this->requireView("Content/loginContent");
        $loginContent = new LoginContent();
        $this->insert("content", $loginContent);
    }
}