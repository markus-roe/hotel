<?php

require_once  getcwd()."/core/controller.php";

class HomeController extends Controller
{
    public function init()
    {
        parent::init();

    }



    public function indexAction()
    {
        $this->getView("/Pages/homePage");
        $homePage = new HomePage();
        $homePage->parse($this->userData);
        $homePage->render();
    }
}

/*
    /login
    /login/
*/