<?php

require_once  getcwd()."/core/controller.php";

class FaqController extends Controller
{
    public function init()
    {
        parent::init();

    }



    public function indexAction()
    {
        $this->getView("/Pages/faqPage");
        $page = new FaqPage();
        $page->parse($this->userData);
        $page->render();
    }
}

/*
    /login
    /login/
*/