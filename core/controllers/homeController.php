<?php

require_once  getcwd()."/core/controller.php";

class HomeController extends Controller
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
        // authentifizieren, model zeugs etc.
        $this->redirect("/home/index");
    }

    public function index()
    {
        $this->getView("/Pages/homePage");
        $homePage = new HomePage();
        $homePage->parse();
        $homePage->render();
    }
}

/*
    /login
    /login/
*/