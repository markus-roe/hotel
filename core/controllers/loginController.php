<?php

require_once  getcwd()."/core/controller.php";

class LoginController extends Controller
{
    public function init()
    {
        parent::init();

    }

    protected function handlePostRequest()
    {
        
    }

    protected function handleGetRequest()
    {
        
    }

    

    public function authenticate()
    {
        if 
    }

    public function index()
    {
        $this->getView("/Pages/loginPage");
        $loginPage = new LoginPage();
        $loginPage->parse();
        $loginPage->render();
    }
}

/*
    /login
    /login/
*/