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

    

    public function loginrequestAction()
    {
        if ($this->clientModel->loginUser())
        {
            header("Location: ../home/index");
        }

        header("Location: ../home/index");
    }

    public function indexAction()
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