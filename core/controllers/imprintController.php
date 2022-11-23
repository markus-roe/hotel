<?php

require_once  getcwd()."/core/controller.php";

class ImprintController extends Controller
{

    public function indexAction()
    {
        $this->getView("/Pages/imprintPage");
        $page = new ImprintPage();
        $page->parse($this->userData);
        $page->render();
    }
}

/*
    /login
    /login/
*/