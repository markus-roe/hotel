<?php

require_once  getcwd()."/core/controller.php";

class HomeController extends Controller
{
    public function init()
    {
        $this->getView("loginPage");
        $homePage = new LoginPage();
        $homePage->parse();
        $homePage->render();
    }
}