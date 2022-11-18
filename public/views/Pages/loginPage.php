<?php

require_once getcwd()."/public/views/Components/page.php";
class LoginPage extends Page
{
    function __construct()
    {
        parent::__construct();
        $this->requireView("Content/loginForm");
        $loginForm = new LoginForm();
        $this->insert("content", $loginForm);
    }
}