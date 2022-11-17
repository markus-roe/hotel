<?php

require_once getcwd()."/public/views/page.php";

class LoginPage extends Page
{
    function __construct()
    {
        parent::__construct();

        $this->requireView("loginForm");
        $loginForm = new LoginForm();
        $this->insert("content", $loginForm);
    }
}