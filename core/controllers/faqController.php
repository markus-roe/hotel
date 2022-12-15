<?php

require_once  getcwd()."/core/controller.php";
//DEPRECATED
class FaqController extends Controller
{
    public function init()
    {
        parent::init();

    }



    public function indexAction()
    {
        $this->getTemplate("/Pages/faqPage");
        $page = new FaqPage();
        $page->parse($this->userData);
        $page->render();
    }
}

/*
    /login
    /login/
*/