<?php

require_once  getcwd()."/core/controller.php";

class HomeController extends Controller
{
    public function init()
    {
        $this->getView("homePage");
        $homePage = new HomePage();
        $homePage->parse();
        $homePage->render();
    }
}